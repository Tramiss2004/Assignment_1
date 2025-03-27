<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        // Fetch all existing IT assets and licenses
        $itAssets = DB::table('it_assets')->pluck('id')->toArray();
        $licenses = DB::table('licenses')->pluck('id')->toArray();

        // Ensure we have data in both tables
        if (empty($itAssets) || empty($licenses)) {
            return;
        }

        // Insert multiple relationships
        foreach ($itAssets as $itAssetId) {
            // Each IT asset can be linked to 1-3 random licenses
            $assignedLicenses = array_rand(array_flip($licenses), rand(1, 3));

            foreach ((array) $assignedLicenses as $licenseId) {
                DB::table('it_asset_license_details')->insert([
                    'it_asset_id' => $itAssetId,
                    'license_id' => $licenseId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // IT Asset And License Details Table (Many-to-Many Relationship)
    // Schema::create('it_asset_license_details', function (Blueprint $table) {
    //     $table->id(); // IT Asset and License Detail ID
    //     $table->foreignId('it_asset_id')->constrained('it_assets')->onDelete('cascade');
    //     $table->foreignId('license_id')->constrained('licenses')->onDelete('cascade');
    //     $table->timestamps();
    // });

    

    }
}
