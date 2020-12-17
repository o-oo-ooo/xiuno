<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('thread_id');
            $table->unsignedInteger('is_first')->default(0);
            $table->unsignedInteger('ip');
            $table->unsignedSmallInteger('images')->default(0);
            $table->unsignedSmallInteger('files')->default(0);
            $table->unsignedTinyInteger('doctype')->default(0);
            $table->unsignedInteger('quote_id')->default(0);
            $table->longText('message');
            $table->longText('message_format');
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
        Schema::dropIfExists('posts');
    }
}
