<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketRequest', function (Blueprint $table) {
            $table->ticket_request_id();
            $table->string('title');
            $table->string('lafirst_namest_name');
            $table->string('other_names');
            $table->string('event_name');
            $table->string('even_details');
            $table->string('picture'); 
           
        

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
