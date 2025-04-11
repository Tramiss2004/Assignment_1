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
        //To add dummy data into it_asset_license_details table

        // Fetch random IT asset and license IDs
        $itAssetIds = DB::table('it_assets')->pluck('id')->toArray();
        $licenseIds = DB::table('licenses')->pluck('id')->toArray();

        if (empty($itAssetIds) || empty($licenseIds)) {
            $this->command->warn('No IT assets or licenses found. Please seed them first.');
            return;
        }

        for ($i = 1; $i <= 10; $i++) {
            DB::table('it_asset_license_details')->insert([
                'it_asset_id' => $itAssetIds[array_rand($itAssetIds)],
                'license_id' => $licenseIds[array_rand($licenseIds)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        
        // Schema::create('it_asset_license_details', function (Blueprint $table) {
        //     $table->id(); // IT Asset and License Detail ID
        //     $table->foreignId('it_asset_id')->constrained('it_assets')->onDelete('cascade');
        //     $table->foreignId('license_id')->constrained('licenses')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }
}
