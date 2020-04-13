<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->bigInteger('organization_id')->nullable();
            $table->bigInteger('doctor_id');
            $table->bigInteger('chamber_id')->nullable();
            $table->bigInteger('agent_id')->nullable();
            $table->string('booking_serial_code');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('serial_no');
            $table->text('address');
            $table->bigInteger('P_type');
            $table->bigInteger('created_by')->nullable();
            $table->tinyInteger('patient_type');
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
        Schema::dropIfExists('patient');
    }
}
