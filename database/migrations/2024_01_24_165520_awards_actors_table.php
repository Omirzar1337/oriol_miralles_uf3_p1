<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AwardsActorsTable extends Migration
{
    public function up()
    {
        Schema::create('awards_actors', function (Blueprint $table) {
            $table->unsignedBigInteger('actor_id');
            $table->unsignedBigInteger('award_id');
            $table->date('awarded_at');
            $table->timestamps();

            $table->foreign('actor_id')->references('id')->on('actors')->onDelete('cascade');
            $table->foreign('award_id')->references('id')->on('awards')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('awards_actors');
    }
}
