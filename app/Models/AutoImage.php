<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AutoImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'auto_id',
        'image_path',
        'alt_text',
        'sort_order',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Vehicle relation.
     */
    public function auto(): BelongsTo
    {
        return $this->belongsTo(Auto::class);
    }

    /**
     * Search by image information or vehicle information.
     */
    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if (blank($search)) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            $q->where('image_path', 'like', '%' . $search . '%')
                ->orWhere('alt_text', 'like', '%' . $search . '%')
                ->orWhereHas('auto', function ($autoQuery) use ($search) {
                    $autoQuery
                        ->where('stock_number', 'like', '%' . $search . '%')
                        ->orWhere('variant', 'like', '%' . $search . '%')
                        ->orWhereHas('brand', function ($brandQuery) use ($search) {
                            $brandQuery->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('model', function ($modelQuery) use ($search) {
                            $modelQuery->where('name', 'like', '%' . $search . '%');
                        });
                });
        });
    }

    /**
     * Filter primary/non-primary images.
     */
    public function scopePrimary(Builder $query, ?string $primary): Builder
    {
        if ($primary === null || $primary === '') {
            return $query;
        }

        return $query->where('is_primary', (bool) $primary);
    }
}