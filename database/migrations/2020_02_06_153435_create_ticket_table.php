<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('help_id')->nullable()->unsigned();
            $table->biginteger('ask_id')->unsigned();
            $table->string('title');
            $table->text('desc')->nullable();
            $table->timestamps();

            $table->foreign('help_id')->references('id')->on('users');
            $table->foreign('ask_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket');
    }
}