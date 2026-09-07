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
        Schema::create('auto_feature', function (Blueprint $table) {
            /*
             * ---------------------------------------------------------
             * Auto Foreign Key
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
             * Feature Foreign Key
             * ---------------------------------------------------------
             */

            $table->unsignedBigInteger('feature_id');

            $table->foreign('feature_id')
                ->references('id')
                ->on('features')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            /*
             * ---------------------------------------------------------
             * Primary Key
             * ---------------------------------------------------------
             *
             * Prevent the same feature from being assigned
             * to the same auto more than once.
             */

            $table->primary([
                'auto_id',
                'feature_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_feature');
    }
};