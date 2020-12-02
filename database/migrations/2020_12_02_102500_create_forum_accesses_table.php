<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_accesses', function (Blueprint $table) {
            $table->unsignedInteger('forum_id');
            $table->unsignedInteger('group_id');
            $table->unsignedTinyInteger('allowread');
            $table->unsignedTinyInteger('allowthread');
            $table->unsignedTinyInteger('allowpost');
            $table->unsignedTinyInteger('allowattach');
            $table->unsignedTinyInteger('allowdown');
            $table->primary(['forum_id', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_accesses');
    }
}
