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
          $table->dateTimeTz('datetimetz')/*->nullable()*/;
          //desc appears in serp
          $table->string('description', 160);
          $table->text('body');
          $table->string('language');
          $table->string('slug');
          $table->integer('g2m_id');
          $table->integer('cycle')->default(0);
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
        Schema::dropIfExists('courses');
    }
}
