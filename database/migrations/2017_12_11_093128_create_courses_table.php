<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
          $table->increments('id');
          //title seo keyword 1, keyword 2 | Brand ; no more than 60 chars
          $table->string('title', 60);
          $table->date('date')->nullable();
          $table->time('time')->nullable();
          $table->string('description', 160);
          $table->text('body')->nullable();
          $table->string('language');
          $table->string('slug')->nullable();
          $table->string('g2m_id')->nullable();
          $table->text('dedication')->nullable();
          $table->integer('intervall')->default(0);
          $table->integer('meetings')->default(0);
          $table->enum('level', ['advanced','expert','anyone'])->default('anyone');
          $table->integer('cost')->default(0);
          $table->integer('channel_id')->unsigned();
          $table->integer('teacher_id')->unsigned();
          $table->timestamps();
          $table->enum('status', ['published','pending','canceled']);
          $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
