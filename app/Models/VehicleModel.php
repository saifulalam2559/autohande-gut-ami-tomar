<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleModel extends Model
{
    use HasFactory;

    protected $table = 'vehicle_models';

    protected $fillable = [
        'brand_id',
        'name',
        'slug',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /*
     * ---------------------------------------------------------
     * Relationships
     * ---------------------------------------------------------
     */

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function autos(): HasMany
    {
        return $this->hasMany(Auto::class, 'vehicle_model_id');
    }

    /*
     * ---------------------------------------------------------
     * Search Scope
     * ---------------------------------------------------------
     */

    public function scopeSearch(
        Builder $query,
        ?string $search
    ): Builder {
        return $query->when(
            filled($search),
            function (Builder $query) use ($search) {
                $query->where(
                    'name',
                    'like',
                    '%' . trim($search) . '%'
                );
            }
        );
    }

    /*
     * ---------------------------------------------------------
     * Status Scope
     * ---------------------------------------------------------
     */

    public function scopeStatus(
        Builder $query,
        ?string $status
    ): Builder {
        return $query->when(
            in_array($status, ['active', 'inactive'], true),
            function (Builder $query) use ($status) {
                $query->where(
                    'is_active',
                    $status === 'active'
                );
            }
        );
    }

    /*
     * ---------------------------------------------------------
     * Brand Filter Scope
     * ---------------------------------------------------------
     */

    public function scopeBrand(
        Builder $query,
        mixed $brandId
    ): Builder {
        return $query->when(
            filled($brandId) && is_numeric($brandId),
            function (Builder $query) use ($brandId) {
                $query->where(
                    'brand_id',
                    (int) $brandId
                );
            }
        );
    }
}