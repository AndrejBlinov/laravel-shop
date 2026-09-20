<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'is_active',
    ];

    public function warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }

    // Вспомогательный метод: общий остаток по всем складам
    public function getTotalQuantityAttribute(): int
    {
        return $this->warehouses()->sum('quantity');
    }

    // Остаток на конкретном складе
    public function getQuantityAt(Warehouse $warehouse): int
    {
        return $this->warehouses()
            ->where('warehouse_id', $warehouse->id)
            ->sum('quantity');
    }
}
