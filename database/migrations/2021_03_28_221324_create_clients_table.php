<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('mobile' ,15);
            $table->string('country');
            $table->enum('gender',['male','female']);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('receptionist_id');
            $table->timestamps();
<<<<<<< HEAD
=======

>>>>>>> 7dbdc29a34d1062777c0569a19c74e2b690b2393
            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('receptionist_id')->on('receptionists')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
