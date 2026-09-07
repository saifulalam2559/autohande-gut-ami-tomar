<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('autos', function (Blueprint $table) {
            $table->id();
            
            $table->string('title');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            /*
             * ---------------------------------------------------------
             * Foreign Keys
             * ---------------------------------------------------------
             */

            // Brand
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade');

            // Vehicle Model
            $table->unsignedBigInteger('vehicle_model_id');
            $table->foreign('vehicle_model_id')
                ->references('id')
                ->on('vehicle_models')
                ->onDelete('cascade');

            // Body Type
            $table->unsignedBigInteger('body_type_id')->nullable();
            $table->foreign('body_type_id')
                ->references('id')
                ->on('body_types')
                 ->onDelete('cascade');

            // Fuel Type
            $table->unsignedBigInteger('fuel_type_id')->nullable();
            $table->foreign('fuel_type_id')
                ->references('id')
                ->on('fuel_types')
                 ->onDelete('cascade');

            // Transmission
            $table->unsignedBigInteger('transmission_id')->nullable();
            $table->foreign('transmission_id')
                ->references('id')
                ->on('transmissions')
                ->onDelete('cascade');

            // Color
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')
                ->references('id')
                ->on('colors')
                 ->onDelete('cascade');

            // Vehicle Condition
            $table->unsignedBigInteger('condition_id')->nullable();
            $table->foreign('condition_id')
                ->references('id')
                ->on('vehicle_conditions')
                  ->onDelete('cascade');

            // Emission Class
            $table->unsignedBigInteger('emission_class_id')->nullable();
            $table->foreign('emission_class_id')
                ->references('id')
                ->on('emission_classes')
                 ->onDelete('cascade');

            /*
             * ---------------------------------------------------------
             * Inventory
             * ---------------------------------------------------------
             */
            $table->string('stock_number')
                ->nullable()
                ->unique();

            /*
             * ---------------------------------------------------------
             * Vehicle Identification
             * ---------------------------------------------------------
             */
            $table->string('variant')->nullable();
            $table->string('vin', 17)
                ->nullable()
                ->unique();

            /*
             * ---------------------------------------------------------
             * Pricing
             * ---------------------------------------------------------
             */
            $table->decimal('price', 12, 2);
            $table->string('currency', 3)->default('EUR');

            /*
             * ---------------------------------------------------------
             * Mileage
             * ---------------------------------------------------------
             */
            $table->unsignedInteger('mileage')->default(0);
            $table->string('mileage_unit', 10)->default('km');

            /*
             * ---------------------------------------------------------
             * Registration
             * ---------------------------------------------------------
             */
            $table->date('first_registration')->nullable();

            /*
             * ---------------------------------------------------------
             * Engine
             * ---------------------------------------------------------
             */
            $table->unsignedSmallInteger('engine_cc')->nullable();
            $table->string('engine_size')->nullable();

            $table->unsignedSmallInteger('power_hp')->nullable();
            $table->unsignedSmallInteger('power_kw')->nullable();

            /*
             * ---------------------------------------------------------
             * Transmission / Drivetrain
             * ---------------------------------------------------------
             */
            $table->unsignedTinyInteger('gears')->nullable();
            $table->string('drivetrain')->nullable();

            /*
             * ---------------------------------------------------------
             * Environmental
             * ---------------------------------------------------------
             */
            $table->unsignedSmallInteger('co2_emissions')->nullable();

            /*
             * ---------------------------------------------------------
             * Inspection / HU-AU
             * ---------------------------------------------------------
             */
            $table->date('inspection_date')->nullable();

            /*
             * ---------------------------------------------------------
             * General Vehicle Information
             * ---------------------------------------------------------
             */
            $table->unsignedTinyInteger('doors')->nullable();
            $table->unsignedTinyInteger('seats')->nullable();

            $table->string('interior_color')->nullable();

            /*
             * ---------------------------------------------------------
             * Ownership / Condition
             * ---------------------------------------------------------
             */
            $table->unsignedTinyInteger('previous_owners')->nullable();
            $table->boolean('accident_free')->nullable();

            /*
             * ---------------------------------------------------------
             * VAT
             * ---------------------------------------------------------
             */
            $table->boolean('vat_deductible')->nullable();

            /*
             * ---------------------------------------------------------
             * Content
             * ---------------------------------------------------------
             */
            $table->longText('description')->nullable();

            /*
             * ---------------------------------------------------------
             * SEO
             * ---------------------------------------------------------
             */
            $table->string('slug')->unique();

            /*
             * ---------------------------------------------------------
             * Inventory Status
             * ---------------------------------------------------------
             */
            $table->enum('status', [
                'draft',
                'published',
                'inactive',
                'sold',
            ])->default('draft');

            $table->boolean('is_visible')->default(false);
            $table->boolean('is_featured')->default(false);

            $table->timestamp('published_at')->nullable();
            $table->timestamp('sold_at')->nullable();

            /*
             * ---------------------------------------------------------
             * Timestamps / Soft Delete
             * ---------------------------------------------------------
             */
            $table->timestamps();
            $table->softDeletes();

            /*
             * ---------------------------------------------------------
             * Indexes
             * ---------------------------------------------------------
             */
            $table->index('brand_id');
            $table->index('vehicle_model_id');
            $table->index('body_type_id');
            $table->index('fuel_type_id');
            $table->index('transmission_id');
            $table->index('color_id');
            $table->index('condition_id');
            $table->index('emission_class_id');

            $table->index('price');
            $table->index('mileage');
            $table->index('first_registration');

            $table->index('status');
            $table->index('is_visible');
            $table->index('is_featured');

            $table->index([
                'status',
                'is_visible',
            ]);

            $table->index([
                'status',
                'is_featured',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autos');
    }
};