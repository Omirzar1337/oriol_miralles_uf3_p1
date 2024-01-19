<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class awardsTable extends Migration
{

    public function up()
    {

        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30);
            $table->date('awardedOn');
            $table->unsignedBigInteger('actor_id');
            $table->timestamps();

            $table->foreign('actor_id')->references('id')->on('actors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('awards');
    }
};
