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
        $departments = ['HR', 'Finance', 'Marketing', 'Sales', 'Operations', 'Customer Service'];
        $positions = ['Assistant', 'Coordinator', 'Manager', 'Executive', 'Senior Manager', 'Director'];
        
        for ($i = 1; $i <= 10; $i++) {
            $isAdmin = rand(0, 1);
            
            if ($isAdmin) {
                $department = 'IT';
                $position = ['Executive', 'Senior Executive', 'Manager', 'Senior Manager', 'Director'][array_rand([0, 1, 2, 3, 4])];
            } else {
                $department = $departments[array_rand($departments)];
                $position = $positions[array_rand($positions)];
            }

            DB::table('users')->insert([
                'name' => 'User' . $i,
                'is_admin' => $isAdmin,
                'position' => $position,
                'department' => $department,
                'email' => 'user' . $i . '@gbn.my',
                'password' => bcrypt('password123'),
                'remember_token' => Str::random(10),
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
