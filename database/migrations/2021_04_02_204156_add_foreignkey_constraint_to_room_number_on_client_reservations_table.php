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
        Schema::table('client_reservations', function (Blueprint $table) {
            $table->foreign('room_id')->on('rooms')->references('id');
        });
    }

    public function down(){
        Schema::table('client_reservations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('room_id');
        });
    }


}
