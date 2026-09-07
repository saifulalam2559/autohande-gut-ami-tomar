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
        Schema::create('features', function (Blueprint $table) {
            $table->id();

            /*
             * ---------------------------------------------------------
             * Feature Category Foreign Key
             * ---------------------------------------------------------
             */

            $table->unsignedBigInteger('feature_category_id');

            $table->foreign('feature_category_id')
                ->references('id')
                ->on('feature_categories')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            /*
             * ---------------------------------------------------------
             * Feature
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
             * Unique / Indexes
             * ---------------------------------------------------------
             */

            // Prevent duplicate feature names.
            $table->unique('name');

            $table->index('feature_category_id');
            $table->index('is_active');
            $table->index('sort_order');

            // Useful when loading/filtering active features by category.
            $table->index([
                'feature_category_id',
                'is_active',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('features');
    }
};