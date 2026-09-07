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
        Schema::create('feature_categories', function (Blueprint $table) {
            $table->id();

            /*
             * ---------------------------------------------------------
             * Feature Category
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
             * Indexes / Unique Constraints
             * ---------------------------------------------------------
             */

            // Prevent duplicate category names.
            $table->unique('name');

            $table->index('is_active');
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_categories');
    }
};