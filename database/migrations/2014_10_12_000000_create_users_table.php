<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('group_id');
            $table->char('name', 32);
            $table->char('email', 40)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamp('avatar')->nullable();
            $table->unsignedInteger('posts')->default(0);
            $table->unsignedInteger('threads')->default(0);
            $table->unsignedInteger('credits')->default(0);
            $table->unsignedInteger('logins')->default(0);
            $table->unsignedInteger('login_ip')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
