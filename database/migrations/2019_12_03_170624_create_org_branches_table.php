<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('organization_address');
            $table->string('phone');
            $table->string('email');
            $table->string('image');
            $table->Integer('status');
            $table->bigInteger('organization_id');
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
        Schema::dropIfExists('org_branch');
    }
}
