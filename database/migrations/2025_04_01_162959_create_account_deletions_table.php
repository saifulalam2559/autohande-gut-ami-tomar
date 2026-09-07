<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountDeletionsTable extends Migration
{
    public function up()
    {
        Schema::create('account_deletions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('kundennummer')->nullable();
            $table->timestamp('deleted_at')->useCurrent();
            $table->text('reason')->nullable();  // Store the reason for deletion
            $table->string('ip_address')->nullable(); // Store the IP address
            $table->string('browser_details')->nullable(); // Store browser details
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('account_deletions');
    }
}
