<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket-tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('ticket_id')->unsigned();
            $table->biginteger('tag_id')->unsigned();

            $table->foreign('ticket_id')->references('id')->on('ticket');
            $table->foreign('tag_id')->references('id')->on('tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket-tag');
    }
}