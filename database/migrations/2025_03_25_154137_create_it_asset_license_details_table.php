<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItAssetLicenseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('it_asset_license_details', function (Blueprint $table) {
            $table->id(); // IT Asset and License Detail ID
            $table->foreignId('it_asset_id')->constrained('it_assets')->onDelete('cascade');
            $table->foreignId('license_id')->constrained('licenses')->onDelete('cascade');
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
        Schema::dropIfExists('it_asset_license_details');
    }
}
