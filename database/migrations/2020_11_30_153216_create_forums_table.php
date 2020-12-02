<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->char('name', 16);
            $table->unsignedTinyInteger('rank')->default(0);
            $table->unsignedMediumInteger('threads')->default(0);
            $table->unsignedMediumInteger('today_posts')->default(0);
            $table->unsignedMediumInteger('today_threads')->default(0);
            $table->text('brief');
            $table->text('announcement')->default('');
            $table->unsignedInteger('accesson')->default(0);
            $table->unsignedTinyInteger('orderby')->default(0);
            $table->unsignedInteger('icon')->default(0);
            $table->char('moduids', 120)->default('');
            $table->char('seo_title', 64)->default('');
            $table->char('seo_keywords', 64)->default('');
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
        Schema::dropIfExists('forums');
    }
}
