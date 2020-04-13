<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->Integer('district_id');
            $table->Integer('division_id');
            $table->Integer('thana_id');
            $table->string('organization_name');
            $table->text('organization_address');
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('image')->nullable();
            $table->string('registration_no')->nullable();
            $table->bigInteger('organization_type');
            $table->Integer('status');
            $table->bigInteger('zip_code');
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
        Schema::dropIfExists('organizations');
    }
}
