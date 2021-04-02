<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("number");
            $table->integer("capacity");
            $table->bigInteger("price");
            $table->boolean('reserved');
            $table->unsignedBigInteger('floor_id');
            $table->unsignedBigInteger('manager_id');
            $table->timestamps();

            $table->foreign("manager_id")->on("managers")->references("id");
            $table->foreign("floor_id")->on("floors")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
