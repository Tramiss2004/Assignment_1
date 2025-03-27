<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //To add dummy data into memebers table
        for ($i = 1; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => 'User' . $i, // More readable names
                'is_admin' => rand(0, 1), // Randomly assign admin role
                'position' => 'Position ' . $i, // Simulated job position
                'department' => 'Department ' . $i, // Simulated department
                'email' => 'user' . $i . '@gbn.my', // Ensures unique emails
                'password' => bcrypt('password123'), // Securely hashed password
                'remember_token' => Str::random(10), // Required for authentication
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // $table->id();
        //     $table->string('name');
        //     $table->tinyInteger('is_admin'); //0 or 1 to indicate false or true, 0 being false- not admin, normal staff, 1 being true, is admin)
        //     $table->string('position');
        //     $table->string('department');
        //     $table->string('email')->unique();
        //     $table->string('password');
        //     $table->rememberToken();
        //     $table->timestamps();

    }
}
