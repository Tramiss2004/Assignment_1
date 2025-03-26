<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id(); // License ID
            $table->string('name');
            $table->string('version');
            $table->date('expiry_date')->nullable();
            $table->enum('status', ['Valid', 'Expired']);
            $table->string('serial_no')->unique();
            $table->string('vendor');
            $table->date('date_purchase');
            $table->enum('license_type', ['Permanent', 'Renewable']);
            $table->string('product_key')->unique();
            $table->integer('quantity');
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
        Schema::dropIfExists('licenses');
    }
}
