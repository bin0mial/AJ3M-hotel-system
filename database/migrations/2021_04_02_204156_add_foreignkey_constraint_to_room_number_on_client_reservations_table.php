<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeyConstraintToRoomNumberOnClientReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_reservation', function (Blueprint $table) {
            $table->foreign('room_number')->on('rooms')->references('id');
        });
    }

    
}
