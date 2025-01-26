<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\adminabout;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'first_name'=> 'admin',
            'email' => 'drashtimistry013@gmail.com',
            'password' => Hash::make('admin123'),
            'phone_number'=> '9586981325',
            'date_of_birth'=> '2000-01-01',
            'role_id'=>1,
            'is_active'=>true,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
        ]);

        adminabout::create([
            'admin_id' => 1,
            'short_discription' => null,
        ]);
    }
}
