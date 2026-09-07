<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Import the User model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
    {
        // Admin
        User::create([
            'first_name' => 'Admin Saiful',
            'last_name' => 'Admin Alam',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('11111111'), 
            'role' => 'admin',
            'status' => 'active',
            'phone' => '1234567890', 
            'country' => 'USA', 
            'city' => 'New York', 
            'postcode' => '10001', 
            'state' => 'NY', 
            'street_and_number' => '123 Main St', 
            
            'sphone' => '1234567890', 
            'scountry' => 'USA', 
            'scity' => 'New York', 
            'spostcode' => '10001', 
            'sstate' => 'NY', 
            'sstreet_and_number' => '123 Main St', 
            'kundennummer' => '25EEK001', 
        ]);

        // Seller
        User::create([
            'first_name' => 'Seller Saiful',
            'last_name' => 'Seller Alam',
            'email' => 'seller@gmail.com',
            'password' => bcrypt('11111111'), 
            'role' => 'seller',
            'status' => 'active',
            'phone' => '1234567890', 
            'country' => 'USA', 
            'city' => 'New York', 
            'postcode' => '10001', 
            'state' => 'NY', 
            'street_and_number' => '123 Main St', 
            
             
            'sphone' => '1234567890', 
            'scountry' => 'USA', 
            'scity' => 'New York', 
            'spostcode' => '10001', 
            'sstate' => 'NY', 
            'sstreet_and_number' => '123 Main St', 
            'kundennummer' => '25EEK002',
        ]);

        // Customer
        User::create([
            'first_name' => 'Customer Saiful',
            'last_name' => 'Customer Alam',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('11111111'), 
            'role' => 'customer',
            'status' => 'active',
            'phone' => '1234567890', 
            'country' => 'USA', 
            'city' => 'New York', 
            'postcode' => '10001', 
            'state' => 'NY', 
            'street_and_number' => '123 Main St', 
            
             
            'sphone' => '1234567890', 
            'scountry' => 'USA', 
            'scity' => 'New York', 
            'spostcode' => '10001', 
            'sstate' => 'NY', 
            'sstreet_and_number' => '123 Main St', 
            'kundennummer' => '25EEK003',
        ]);
    }
}