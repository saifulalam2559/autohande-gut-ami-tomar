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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company')->nullable();        
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);          
            $table->string('photo')->nullable();
            $table->string('phone')->nullable();           
            $table->enum('role',['admin','seller','customer'])->default('seller');
            $table->enum('status',['active','inactive'])->default('active');         
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('postcode')->nullable();
            $table->string('state')->nullable();
            $table->string('street_and_number')->nullable(); 
            
            $table->string('sfirst_name')->nullable();
            $table->string('slast_name')->nullable();
            $table->string('scompany')->nullable();
            $table->string('scountry')->nullable();
            $table->string('scity')->nullable();
            $table->string('spostcode')->nullable();
            $table->string('sstate')->nullable();
            $table->string('sstreet_and_number')->nullable();  
            $table->string('sphone')->nullable(); 
            $table->string('kundennummer',20)->unique();
            
            $table->string('two_factor_code')->nullable();
            $table->dateTime('two_factor_expires_at')->nullable();
            $table->boolean('two_factor_enabled')->default(false);
            
            
            $table->string('verification_code')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            
            $table->longText('admin_note')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
