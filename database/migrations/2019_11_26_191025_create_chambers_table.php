<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChambersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chambers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('organization_id');
            $table->string('chamber_name');
            $table->text('chamber_address')->nullable();
            $table->Integer('division_id');
            $table->Integer('district_id');
            $table->Integer('thana_id');
            $table->string('room_no')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->Integer('status');
            $table->bigInteger('created_by')->nullable();
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
        Schema::dropIfExists('chambers');
    }
}
