<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->char('name', 20);
            $table->unsignedInteger('credits_from')->default(0);
            $table->unsignedInteger('credits_to')->default(0);
            $table->boolean('allowread')->default(0);
            $table->boolean('allowthread')->default(0);
            $table->boolean('allowpost')->default(0);
            $table->boolean('allowattach')->default(0);
            $table->boolean('allowdown')->default(0);
            $table->boolean('allowtop')->default(0);
            $table->boolean('allowupdate')->default(0);
            $table->boolean('allowdelete')->default(0);
            $table->boolean('allowmove')->default(0);
            $table->boolean('allowbanuser')->default(0);
            $table->boolean('allowdeleteuser')->default(0);
            $table->boolean('allowviewip')->default(0);
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
        Schema::dropIfExists('groups');
    }
}
