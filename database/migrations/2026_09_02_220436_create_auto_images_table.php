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
        Schema::create('auto_images', function (Blueprint $table) {
            $table->id();

            /*
             * ---------------------------------------------------------
             * Foreign Key
             * ---------------------------------------------------------
             */

            $table->unsignedBigInteger('auto_id');

            $table->foreign('auto_id')
                ->references('id')
                ->on('autos')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            /*
             * ---------------------------------------------------------
             * Image
             * ---------------------------------------------------------
             */

            $table->string('image_path');

            $table->string('alt_text')->nullable();

            $table->unsignedTinyInteger('sort_order')->default(0);

            $table->boolean('is_primary')->default(false);

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
                'auto_id',
                'sort_order',
            ]);

            $table->index([
                'auto_id',
                'is_primary',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_images');
    }
};