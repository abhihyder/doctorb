<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('booking_serial_code');
            $table->string('patient_name');
            $table->string('mobile_no');
            $table->string('serial_no');
            $table->dateTime('visited_time');
            $table->text('address')->nullable();
            $table->bigInteger('organization_id');
            $table->bigInteger('doctor_id');
            $table->bigInteger('patient_id')->nullable();
            $table->bigInteger('agent_id')->nullable();
            $table->bigInteger('chamber_id');
            $table->bigInteger('gender');
            $table->bigInteger('age');
            $table->bigInteger('organization_branch_id');
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('booking');
    }
}
