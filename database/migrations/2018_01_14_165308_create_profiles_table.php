<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('title')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('timezone')->nullable();
            $table->string('language')->nullable();
            $table->string('social_profile')->nullable();
            $table->boolean('jewish')->nullable();
            $table->date('birthday')->nullable();
            $table->text('quotes')->nullable();
            $table->text('hobbies')->nullable();
            //teacher
            $table->text('message')->nullable();
            //admin
            $table->text('notes')->nullable();
            $table->string('assignedBy')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
