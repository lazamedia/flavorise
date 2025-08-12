<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'amount',
        'category',
        'expense_date',
        'receipt_image',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'expense_date' => 'date',
    ];

    /**
     * Get the user that owns the expense.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope a query to filter by date range.
     */
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('expense_date', [$startDate, $endDate]);
    }

    /**
     * Scope a query to filter by current month.
     */
    public function scopeCurrentMonth($query)
    {
        return $query->whereMonth('expense_date', now()->month)
                    ->whereYear('expense_date', now()->year);
    }

    /**
     * Scope a query to filter by current year.
     */
    public function scopeCurrentYear($query)
    {
        return $query->whereYear('expense_date', now()->year);
    }

    /**
     * Get expense category label.
     */
    public function getCategoryLabelAttribute()
    {
        $categories = [
            'operational' => 'Operasional',
            'supplies' => 'Perlengkapan',
            'maintenance' => 'Perawatan',
            'other' => 'Lainnya',
        ];

        return $categories[$this->category] ?? 'Tidak Diketahui';
    }

    /**
     * Get total expenses for a specific period.
     */
    public static function getTotalByPeriod($startDate, $endDate, $category = null)
    {
        $query = self::byDateRange($startDate, $endDate);
        
        if ($category) {
            $query->byCategory($category);
        }
        
        return $query->sum('amount');
    }

    /**
     * Get monthly expenses summary.
     */
    public static function getMonthlySummary($year = null, $month = null)
    {
        $year = $year ?? now()->year;
        $month = $month ?? now()->month;
        
        return self::whereYear('expense_date', $year)
                  ->whereMonth('expense_date', $month)
                  ->selectRaw('category, SUM(amount) as total')
                  ->groupBy('category')
                  ->get();
    }
}