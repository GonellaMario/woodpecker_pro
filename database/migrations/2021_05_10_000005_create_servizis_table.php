<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServizisTable extends Migration
{
    public function up()
    {
        Schema::create('servizis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome_servizio')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
