<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeacherTest extends TestCase
{
  use DatabaseMigrations;

    /** @test */
    public function testExample()
    {
      $this->assertTrue(true);
    }
}
