<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('forum_id');
            $table->boolean('top')->default(0);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('ip');
            $table->char('subject', 128);
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('posts')->default(0);
            $table->unsignedTinyInteger('images')->default(0);
            $table->unsignedTinyInteger('files')->default(0);
            $table->unsignedTinyInteger('mods')->default(0);
            $table->boolean('closed')->default(0);
            $table->unsignedInteger('first_pid')->default(0);
            $table->unsignedInteger('last_uid')->default(0);
            $table->unsignedInteger('last_pid')->default(0);
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
        Schema::dropIfExists('threads');
    }
}
