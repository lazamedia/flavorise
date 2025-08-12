<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'transaction_id',
        'menu_id',
        'quantity',
        'unit_price',
        'total_price',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    /**
     * Boot method to calculate total price and update stock.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $item->total_price = $item->quantity * $item->unit_price;
        });

        static::created(function ($item) {
            // Reduce menu stock
            $item->menu->reduceStock($item->quantity);
            
            // Update transaction total
            $item->transaction->calculateTotal();
        });

        static::updating(function ($item) {
            $item->total_price = $item->quantity * $item->unit_price;
        });

        static::updated(function ($item) {
            // Update transaction total
            $item->transaction->calculateTotal();
        });
    }

    /**
     * Get the transaction that owns the transaction item.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Get the menu that owns the transaction item.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Calculate total price for this item.
     */
    public function calculateTotalPrice()
    {
        $this->total_price = $this->quantity * $this->unit_price;
        $this->save();
        
        return $this->total_price;
    }

    /**
     * Get menu name.
     */
    public function getMenuNameAttribute()
    {
        return $this->menu->name;
    }

    /**
     * Get category name through menu.
     */
    public function getCategoryNameAttribute()
    {
        return optional(optional($this->menu)->category)->name;
    }
}