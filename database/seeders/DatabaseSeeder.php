<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Seller;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => Hash::make('password'),
        ]);

        Admin::query()->updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Default Admin',
            'password' => Hash::make('password'),
        ]);

        Seller::query()->updateOrCreate([
            'email' => 'seller@example.com',
        ], [
            'name' => 'Default Seller',
            'password' => Hash::make('password'),
        ]);

        Customer::query()->updateOrCreate([
            'email' => 'customer@example.com',
        ], [
            'name' => 'Default Customer',
            'password' => Hash::make('password'),
        ]);
    }
}
