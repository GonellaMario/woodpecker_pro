<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('daily_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('day')->nullable();
            $table->integer('worktime')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
