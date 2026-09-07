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
        Schema::create('vehicle_models', function (Blueprint $table) {
            $table->id();

            /*
             * ---------------------------------------------------------
             * Foreign Key
             * ---------------------------------------------------------
             */

            $table->unsignedBigInteger('brand_id');

            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            /*
             * ---------------------------------------------------------
             * Vehicle Model
             * ---------------------------------------------------------
             */

            $table->string('name');
            $table->string('slug')->unique();

            /*
             * ---------------------------------------------------------
             * Status / Sorting
             * ---------------------------------------------------------
             */

            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);

            /*
             * ---------------------------------------------------------
             * Timestamps
             * ---------------------------------------------------------
             */

            $table->timestamps();

            /*
             * ---------------------------------------------------------
             * Indexes
             * ---------------------------------------------------------
             */

            $table->index([
                'brand_id',
                'is_active',
            ]);

            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_models');
    }
};