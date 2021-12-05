<?php

namespace Tests\Unit;

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
    public function can_get_formatted_date()
    {
        //Preparacio
        //TODO CODE SMELL
        $video = Video::create([
            'title'=> 'Ubuntu 101',
            'description'=> '# Here Description',
            'url' => 'https://youtu.be/w8j07_DBl_I',
            'published_at'=> Carbon::parse('December 13'),
            'previous'=> null,
            'next'=> null,
            'series_id'=> 1
        ]);
        //Execucio WISHFULL PROGRAMMING
        $dateToTest = $video->formatted_pusblished_at;

        //Comprovacio/assert
        $this->assertEquals($dateToTest, 'December 13');
    }
}
