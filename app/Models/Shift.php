<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Shift extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'shift_date',
        'start_time',
        'end_time',
        'opening_cash',
        'closing_cash',
        'total_sales',
        'cash_sales',
        'qris_sales',
        'notes',
        'status',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'shift_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'opening_cash' => 'decimal:2',
        'closing_cash' => 'decimal:2',
        'total_sales' => 'decimal:2',
        'cash_sales' => 'decimal:2',
        'qris_sales' => 'decimal:2',
    ];

    /**
     * Get the user that owns the shift.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all transactions for this shift.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function cashMovements()
    {
        return $this->hasMany(\App\Models\ShiftCashMovement::class);
    }

    /**
     * Calculate total sales for this shift.
     */
    public function calculateTotalSales()
    {
        $this->total_sales = $this->transactions()->sum('total');
        $this->cash_sales = $this->transactions()->where('payment_method', 'cash')->sum('total');
        $this->qris_sales = $this->transactions()->where('payment_method', 'qris')->sum('total');
        $this->save();
    }

    public function getCurrentCashBalanceAttribute()
    {
        $in = (float) $this->cashMovements()->where('type','in')->sum('amount');
        $out = (float) $this->cashMovements()->where('type','out')->sum('amount');
        return (float) $this->opening_cash + $in - $out + (float) $this->cash_sales;
    }

    /**
     * Close the shift.
     */
    public function closeShift($closingCash, $notes = null)
    {
        $this->end_time = now()->format('H:i');
        $this->closing_cash = $closingCash;
        $this->notes = $notes;
        $this->status = 'closed';
        $this->calculateTotalSales();
        $this->save();
    }

    /**
     * Scope a query to only include active shifts.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include closed shifts.
     */
    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    /**
     * Check if shift is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Get shift duration in hours.
     */
    public function getDurationAttribute()
    {
        if (!$this->end_time) {
            return null;
        }
        
        $start = Carbon::parse($this->shift_date . ' ' . $this->start_time);
        $end = Carbon::parse($this->shift_date . ' ' . $this->end_time);
        
        return $start->diffInHours($end);
    }
}