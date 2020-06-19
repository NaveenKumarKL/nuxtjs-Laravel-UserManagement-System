<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('clientid');
            $table->string('invoicenumber');
            $table->string('invoicetype');
            $table->string('paymenttype')->nullable();
            $table->string('paymentstatus')->nullable();
            $table->string('dueamount')->nullable();
            $table->string('status')->nullable();
            $table->string('totalamount')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}