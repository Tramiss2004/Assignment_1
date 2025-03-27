<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class IT_Asset_MaintenancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //To add dummy data into memebers table
        // Fetch all existing IT asset IDs
        $itAssets = DB::table('it_assets')->pluck('id')->toArray();

        // Ensure we have assets to assign maintenance records
        if (empty($itAssets)) {
            return;
        }

        for ($i = 1; $i <= 10; $i++) {
            $startDate = Carbon::now()->subDays(rand(10, 90))->toDateString(); // Random start date in last 3 months
            $isDone = rand(0, 1);
            $endDate = $isDone ? Carbon::parse($startDate)->addDays(rand(1, 7))->toDateString() : null; // Set only if "Done"
            $cost = $isDone ? rand(50, 500) : null; // Cost applies only if maintenance is completed

            DB::table('it_asset_maintenances')->insert([
                'title' => 'Maintenance ' . $i,
                'description' => 'Maintenance work for asset ' . $i,
                'it_asset_id' => $itAssets[array_rand($itAssets)], // Assign random IT asset
                'status' => $isDone ? 'Done' : 'Pending',
                'maintenance_cost' => $cost,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'maintenance_type' => rand(0, 1) ? 'Service' : 'Repair',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // IT Asset Maintenance Table
    // Schema::create('it_asset_maintenances', function (Blueprint $table) {
    //     $table->id(); // IT Asset Maintenance ID
    //     $table->string('title');
    //     $table->text('description');
    //     $table->foreignId('it_asset_id')->constrained('it_assets')->onDelete('cascade');
    //     $table->enum('status', ['Done', 'Pending']);
    //     $table->decimal('maintenance_cost', 10, 2)->nullable();
    //     $table->date('start_date');
    //     $table->date('end_date')->nullable();
    //     $table->enum('maintenance_type', ['Service', 'Repair']);
    //     $table->timestamps();
    // });


    }
}
