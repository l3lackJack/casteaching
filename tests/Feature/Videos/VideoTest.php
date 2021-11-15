<?php

namespace Tests\Feature\Videos;

use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;
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
            'previous'=> null,
            'next'=> null,
            'series_id'=> 1
        ]);



        $response = $this->get('/videos/' .$video->id);
        $response->assertStatus(200);
        $response->assertSee('Ubuntu 101');
        $response->assertSee('Here Description');
        $response->assertSee('2021-12-13 00:00:00');
    }
}
