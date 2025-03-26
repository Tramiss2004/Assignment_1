<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('it_assets', function (Blueprint $table) {
            $table->id(); // IT Asset ID
            $table->string('name');
            $table->enum('assigned_status', ['Assigned', 'Unassigned']);
            $table->string('category');
            $table->string('brand');
            $table->string('model');
            $table->string('operating_system');
            $table->date('date_purchase');
            $table->string('serial_no')->unique();
            $table->enum('status', ['Running', 'Failure']);
            $table->boolean('warranty_available');
            $table->date('warranty_due_date')->nullable();
            $table->boolean('license_available');
            $table->foreignId('license_id')->nullable()->constrained('licenses')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
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
        Schema::dropIfExists('it_assets');
    }
}
