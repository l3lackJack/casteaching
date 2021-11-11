<?php

namespace Tests\Feature\Videos;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideoTest extends TestCase
{
    /**
     * @test
     */
    public function users_canv_view_videos()
    {
      $video = Video::create([
            'title'=> 'Ubuntu 101',
            'description'=> '# Here Description',
            'url' => 'https://youtu.be/w8j07_DBl_I',
            'published_at'=> Carbon::parse('December 13'),
            'completed'=> false,
            'previous'=> null,
            'next'=> null,
            'series_id'=> 1
        ]);
        $response = $this->get('/videos/' .$video->id);
        $response->assertStatus(200);
        $response->assertSee('Ubuntu 101');
        $response->assertSee('Here Description');
        $response->assertSee('December 13');
    }
}
