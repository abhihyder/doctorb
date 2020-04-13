<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('organization_id')->nullable();
            $table->string('name');
            $table->string('degree');
            $table->bigInteger('doc_type')->nullable();
            $table->string('doc_bmdc_no')->nullable();
            $table->enum('gender',array('male','female'));
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->Integer('district_id');
            $table->Integer('division_id');
            $table->Integer('thana_id');
            $table->string('image');
            $table->string('d_b_status')->nullable();
            $table->bigInteger('status')->nullable();
            $table->string('fees');
            $table->string('second_fees')->nullable();
            $table->bigInteger('chamber_id')->nullable();
            $table->bigInteger('assistant_id')->nullable();
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
        Schema::dropIfExists('doctors');
    }
}
