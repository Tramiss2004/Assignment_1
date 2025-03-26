<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItAssetMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('it_asset_maintenances', function (Blueprint $table) {
            $table->id(); // IT Asset Maintenance ID
            $table->string('title');
            $table->text('description');
            $table->foreignId('it_asset_id')->constrained('it_assets')->onDelete('cascade');
            $table->enum('status', ['Done', 'Pending']);
            $table->decimal('maintenance_cost', 10, 2)->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('maintenance_type', ['Service', 'Repair']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('it_asset_maintenances');
    }
}
