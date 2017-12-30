<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male','female']);
            $table->text('city')->nullable();
            $table->string('language')->nullable();
            $table->string('facebook')->nullable();
            $table->string('title')->nullable();
            $table->date('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->text('notes')->nullable();
            $table->string('email')->unique();
            $table->string('email_verification_token')->nullable();
            $table->boolean('jewish'); //is part of a synagoge or of a community?
            $table->string('password');
            $table->string('assignedBy')->nullable();
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
