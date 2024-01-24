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
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('awards');
    }
};
