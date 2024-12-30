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
        Schema::create('tickets', function (Blueprint $table) {
            $table->ticket_id ();
            $table->string('doner'); 
            $table->string('amount');
            $table->string('amount_in_words');
            $table->string('contact'); 
            $table->string('given_to');
            $table->string('mode_of_payment'); 
        

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
