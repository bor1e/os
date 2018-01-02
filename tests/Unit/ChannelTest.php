<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChannelTest extends TestCase
{
    /** @test */
    public function a_channel_has_courses()
    {
      $channel = create('App\Channel');
      $course = create('App\Course', ['channel_id'=>$channel->id]);
      $this->assertTrue($channel->courses->contains($course));
    }
}
