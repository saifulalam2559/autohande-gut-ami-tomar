<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Auto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'meta_title',
        'meta_description',
        'brand_id',
        'vehicle_model_id',
        'body_type_id',
        'fuel_type_id',
        'transmission_id',
        'color_id',
        'condition_id',
        'emission_class_id',

        'stock_number',
        'variant',
        'vin',

        'price',
        'currency',

        'mileage',
        'mileage_unit',

        'first_registration',

        'engine_cc',
        'engine_size',

        'power_hp',
        'power_kw',

        'gears',
        'drivetrain',

        'co2_emissions',

        'inspection_date',

        'doors',
        'seats',

        'interior_color',

        'previous_owners',
        'accident_free',
        'vat_deductible',

        'description',

        'slug',

        'status',
        'is_visible',
        'is_featured',

        'published_at',
        'sold_at',
    ];

    protected $casts = [
        'price' => 'decimal:2',

        'first_registration' => 'date',
        'inspection_date' => 'date',

        'accident_free' => 'boolean',
        'vat_deductible' => 'boolean',
        'is_visible' => 'boolean',
        'is_featured' => 'boolean',

        'published_at' => 'datetime',
        'sold_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Brand
    |--------------------------------------------------------------------------
    */

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Vehicle Model
    |--------------------------------------------------------------------------
    */

    public function model(): BelongsTo
    {
        return $this->belongsTo(
            VehicleModel::class,
            'vehicle_model_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Body Type
    |--------------------------------------------------------------------------
    */

    public function bodyType(): BelongsTo
    {
        return $this->belongsTo(BodyType::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Fuel Type
    |--------------------------------------------------------------------------
    */

    public function fuelType(): BelongsTo
    {
        return $this->belongsTo(FuelType::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Transmission
    |--------------------------------------------------------------------------
    */

    public function transmission(): BelongsTo
    {
        return $this->belongsTo(Transmission::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Color
    |--------------------------------------------------------------------------
    */

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Vehicle Condition
    |--------------------------------------------------------------------------
    */

    public function condition(): BelongsTo
    {
        return $this->belongsTo(
            VehicleCondition::class,
            'condition_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Emission Class
    |--------------------------------------------------------------------------
    */

    public function emissionClass(): BelongsTo
    {
        return $this->belongsTo(EmissionClass::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Images
    |--------------------------------------------------------------------------
    */

    public function images(): HasMany
    {
        return $this->hasMany(AutoImage::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    /*
    |--------------------------------------------------------------------------
    | Primary Image
    |--------------------------------------------------------------------------
    */

    public function primaryImage(): HasOne
    {
        return $this->hasOne(AutoImage::class)
            ->where('is_primary', true);
    }

    /*
    |--------------------------------------------------------------------------
    | Features / Equipment
    |--------------------------------------------------------------------------
    */

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(
            Feature::class,
            'auto_feature'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Search Scope
    |--------------------------------------------------------------------------
    */

    public function scopeSearch(
        Builder $query,
        ?string $search
    ): Builder {
        if (blank($search)) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {

            $q->where('stock_number', 'like', '%' . $search . '%')
                ->orWhere('variant', 'like', '%' . $search . '%')
                ->orWhere('vin', 'like', '%' . $search . '%')
                ->orWhere('slug', 'like', '%' . $search . '%')
                ->orWhereHas('brand', function ($brandQuery) use ($search) {
                    $brandQuery->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    );
                })
                ->orWhereHas('model', function ($modelQuery) use ($search) {
                    $modelQuery->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    );
                });

        });
    }

    /*
    |--------------------------------------------------------------------------
    | Status Scope
    |--------------------------------------------------------------------------
    */

    public function scopeStatus(
        Builder $query,
        ?string $status
    ): Builder {
        if (blank($status)) {
            return $query;
        }

        return $query->where('status', $status);
    }

    /*
    |--------------------------------------------------------------------------
    | Visibility Scope
    |--------------------------------------------------------------------------
    */

    public function scopeVisibility(
        Builder $query,
        ?string $visibility
    ): Builder {
        if ($visibility === null || $visibility === '') {
            return $query;
        }

        return $query->where(
            'is_visible',
            (bool) $visibility
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Featured Scope
    |--------------------------------------------------------------------------
    */

    public function scopeFeatured(
        Builder $query,
        ?string $featured
    ): Builder {
        if ($featured === null || $featured === '') {
            return $query;
        }

        return $query->where(
            'is_featured',
            (bool) $featured
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Public Inventory
    |--------------------------------------------------------------------------
    */

    public function scopePubliclyVisible(
        Builder $query
    ): Builder {
        return $query
            ->where('is_visible', true)
            ->whereIn('status', [
                'published',
                'sold',
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Published
    |--------------------------------------------------------------------------
    */

    public function scopePublished(
        Builder $query
    ): Builder {
        return $query
            ->where('status', 'published')
            ->where('is_visible', true);
    }

    /*
    |--------------------------------------------------------------------------
    | Available Inventory
    |--------------------------------------------------------------------------
    */

    public function scopeAvailable(
        Builder $query
    ): Builder {
        return $query
            ->where('status', 'published')
            ->where('is_visible', true);
    }
    
    
    


    
    
}