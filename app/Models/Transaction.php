<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'transaction_code',
        'user_id',
        'shift_id',
        'subtotal',
        'tax',
        'discount',
        'total',
        'payment_method',
        'paid_amount',
        'change_amount',
        'customer_notes',
        'status',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'change_amount' => 'decimal:2',
    ];

    /**
     * Boot method to generate transaction code.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $transaction->transaction_code = self::generateTransactionCode();
        });

        static::created(function ($transaction) {
            // Update shift sales after transaction is created
            $transaction->shift->calculateTotalSales();
        });
    }

    /**
     * Generate unique transaction code.
     */
    public static function generateTransactionCode()
    {
        $prefix = 'TRX';
        $date = now()->format('Ymd');
        $lastTransaction = self::whereDate('created_at', today())->latest()->first();
        
        $number = $lastTransaction ? 
            intval(substr($lastTransaction->transaction_code, -4)) + 1 : 1;
        
        return $prefix . $date . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Get the user that owns the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the shift that owns the transaction.
     */
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    /**
     * Get all transaction items for this transaction.
     */
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    /**
     * Calculate subtotal from items.
     */
    public function calculateSubtotal()
    {
        return $this->items->sum('total_price');
    }

    /**
     * Calculate total after tax and discount.
     */
    public function calculateTotal()
    {
        $subtotal = $this->calculateSubtotal();
        $this->subtotal = $subtotal;
        $this->total = $subtotal + $this->tax - $this->discount;
        $this->save();
        
        return $this->total;
    }

    /**
     * Calculate change amount.
     */
    public function calculateChange()
    {
        $this->change_amount = $this->paid_amount - $this->total;
        $this->save();
        
        return $this->change_amount;
    }

    /**
     * Scope a query to only include completed transactions.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Check if transaction is cash payment.
     */
    public function isCashPayment()
    {
        return $this->payment_method === 'cash';
    }

    /**
     * Check if transaction is QRIS payment.
     */
    public function isQrisPayment()
    {
        return $this->payment_method === 'qris';
    }
}