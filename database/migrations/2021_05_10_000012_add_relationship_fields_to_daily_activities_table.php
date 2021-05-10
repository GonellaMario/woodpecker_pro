<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDailyActivitiesTable extends Migration
{
    public function up()
    {
        Schema::table('daily_activities', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_3856776')->references('id')->on('users');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id', 'service_fk_3856777')->references('id')->on('servizis');
        });
    }
}
