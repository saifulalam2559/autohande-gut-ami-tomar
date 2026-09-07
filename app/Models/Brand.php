<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function models(): HasMany
    {
        return $this->hasMany(VehicleModel::class);
    }

    public function autos(): HasMany
    {
        return $this->hasMany(Auto::class);
    }

    /**
     * Search by brand name.
     */
    public function scopeSearch($query, ?string $search)
    {
        return $query->when(
            filled($search),
            fn ($query) => $query->where(
                'name',
                'like',
                '%' . trim($search) . '%'
            )
        );
    }

    /**
     * Filter by active/inactive status.
     */
    public function scopeStatus($query, ?string $status)
    {
        return $query->when(
            in_array($status, ['active', 'inactive'], true),
            fn ($query) => $query->where(
                'is_active',
                $status === 'active'
            )
        );
    }
}