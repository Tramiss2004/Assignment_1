<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Str; 
use Carbon\Carbon;

class IT_Asset_License_DetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //To add dummy data into memebers table
        for ($i = 1; $i <= 10; $i++) {
            $assigned = rand(0, 1) ? 'Assigned' : 'Unassigned';
            $hasWarranty = rand(0, 1);
            $hasLicense = rand(0, 1);
            $purchaseDate = Carbon::now()->subDays(rand(30, 365))->toDateString(); // Random purchase date within last year
            
            DB::table('it_assets')->insert([
                'name' => 'Asset ' . $i,
                'assigned_status' => $assigned,
                'category' => 'Category ' . $i,
                'brand' => 'Brand ' . $i,
                'model' => 'Model ' . $i,
                'operating_system' => rand(0, 1) ? 'Windows' : 'Linux',
                'date_purchase' => $purchaseDate,
                'serial_no' => strtoupper(Str::random(12)), // Unique serial number
                'status' => rand(0, 1) ? 'Running' : 'Failure',
                'warranty_available' => $hasWarranty,
                'warranty_due_date' => $hasWarranty ? Carbon::parse($purchaseDate)->addYear()->toDateString() : null, // Warranty valid for 1 year
                'license_available' => $hasLicense,
                'license_id' => $hasLicense ? rand(1, 10) : null, // Random license ID if available
                'user_id' => $assigned === 'Assigned' ? rand(1, 10) : null, // Assign a user only if status is 'Assigned'
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
