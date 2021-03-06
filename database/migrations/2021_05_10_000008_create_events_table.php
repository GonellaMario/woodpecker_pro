<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->datetime('start_time')->nullable();
            $table->string('recurrence')->nullable();
            $table->datetime('end_time')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
