<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LicensesSeeder extends Seeder
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
            DB::table('licenses')->insert([
                'name' => 'Software ' . $i,
                'version' => '1.' . $i,
                'expiry_date' => $i % 2 == 0 ? now()->addDays($i * 30)->toDateString() : null, // Every 2nd record has an expiry date
                'status' => $i % 2 == 0 ? 'Valid' : 'Expired', // Alternate between 'Valid' and 'Expired'
                'serial_no' => strtoupper(Str::random(10)),
                'vendor' => 'Vendor ' . $i,
                'date_purchase' => now()->subDays($i * 15)->toDateString(),
                'license_type' => $i % 2 == 0 ? 'Renewable' : 'Permanent', // Alternate between 'Permanent' and 'Renewable'
                'product_key' => strtoupper(Str::random(16)),
                'quantity' => rand(1, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Schema::create('licenses', function (Blueprint $table) {
        //     $table->id(); // License ID
        //     $table->string('name');
        //     $table->string('version');
        //     $table->date('expiry_date')->nullable();
        //     $table->enum('status', ['Valid', 'Expired']);
        //     $table->string('serial_no')->unique();
        //     $table->string('vendor');
        //     $table->date('date_purchase');
        //     $table->enum('license_type', ['Permanent', 'Renewable']);
        //     $table->string('product_key')->unique();
        //     $table->integer('quantity');
        //     $table->timestamps();
        // });
    

    }
}
