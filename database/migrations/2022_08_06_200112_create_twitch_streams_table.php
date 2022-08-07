<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streams', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('user_login');
            $table->string('user_name');
            $table->string('game_id');
            $table->string('game_name');
            $table->string('type');
            $table->string('title');
            $table->unsignedInteger('viewer_count');
            $table->string('started_at');
            $table->string('language');
            $table->string('thumbnail_url');
            $table->boolean('is_mature');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('twitch_streams');
    }
};
