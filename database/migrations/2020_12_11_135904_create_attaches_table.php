<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attaches', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('thread_id');
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('filesize');
            $table->unsignedMediumInteger('width');
            $table->unsignedMediumInteger('height');
            $table->char('filename', 120);
            $table->char('orgfilename', 120);
            $table->char('filetype', 120);
            $table->char('comment', 120);
            $table->unsignedInteger('downloads');
            $table->unsignedInteger('credits')->default(0);
            $table->unsignedInteger('golds')->default(0);
            $table->unsignedTinyInteger('isimage');
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
        Schema::dropIfExists('attaches');
    }
}
