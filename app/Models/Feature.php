<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'feature_category_id',
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

    /**
     * Feature category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            FeatureCategory::class,
            'feature_category_id'
        );
    }

    /**
     * Vehicles using this feature.
     */
    public function autos(): BelongsToMany
    {
        return $this->belongsToMany(
            Auto::class,
            'auto_feature'
        );
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

                $search = trim($search);

                $query->where(function (Builder $query) use ($search) {

                    $query->where(
                        'features.name',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'features.slug',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhereHas(
                        'category',
                        function (Builder $query) use ($search) {
                            $query->where(
                                'name',
                                'like',
                                '%' . $search . '%'
                            );
                        }
                    );

                });
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
                    'features.is_active',
                    $status === 'active'
                );
            }
        );
    }

    /*
     * ---------------------------------------------------------
     * Category Filter Scope
     * ---------------------------------------------------------
     */

    public function scopeCategory(
        Builder $query,
        mixed $categoryId
    ): Builder {
        return $query->when(
            filled($categoryId) && is_numeric($categoryId),
            function (Builder $query) use ($categoryId) {
                $query->where(
                    'features.feature_category_id',
                    (int) $categoryId
                );
            }
        );
    }
}