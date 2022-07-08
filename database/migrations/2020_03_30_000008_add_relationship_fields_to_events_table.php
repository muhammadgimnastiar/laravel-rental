<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventsTable extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedInteger('car_id');
            $table->foreign('car_id', 'car_fk_1226838')->references('id')->on('cars');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id', 'user_fk_1226839')->references('id')->on('users');
        });

    }
}
