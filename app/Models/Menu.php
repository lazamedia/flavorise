<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'stock',
        'is_available',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'is_available' => 'boolean',
        'stock' => 'integer',
    ];

    /**
     * Get the category that owns the menu.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all transaction items for this menu.
     */
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    /**
     * Scope a query to only include available menus.
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope a query to only include menus with stock.
     */
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    /**
     * Check if menu is in stock.
     */
    public function inStock()
    {
        return $this->stock > 0;
    }

    /**
     * Reduce stock when item is sold.
     */
    public function reduceStock($quantity)
    {
        $this->stock = max(0, $this->stock - $quantity);
        $this->save();
    }
}