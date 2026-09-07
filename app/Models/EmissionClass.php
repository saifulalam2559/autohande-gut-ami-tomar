<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmissionClass extends Model
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

    /*
     * ---------------------------------------------------------
     * Relationships
     * ---------------------------------------------------------
     */

    public function autos(): HasMany
    {
        return $this->hasMany(Auto::class);
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
}