<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employeeid');
            $table->string('name');
            $table->string('joindate');
            $table->string('designation');
            $table->string('phone');
            // $table->string('imaged')->nullable();
            // $table->string('imagedesd')->nullable();
            $table->string('image')->nullable();
            $table->string('address');
            $table->string('status');
            $table->string('renumuration');
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
        Schema::dropIfExists('employees');
    }
}