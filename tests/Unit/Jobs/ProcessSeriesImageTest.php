<?php

namespace Tests\Unit\Jobs;

use App\Jobs\ProcessSeriesImage;
use App\Models\Serie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * @covers ProcessSeriesImage::class
 */
class ProcessSeriesImageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_resizes_the_series_image_400px_height()
    {
        Storage::fake('public');
        Storage::disk('public')->put('series/serie-serie-example.jpg', $path = file_get_contents(base_path('tests/Fixtures/image.jpg')));
        $originalSize = filesize($path);
        $serie = Serie::create([
            'title' => 'Intro to TDD',
            'description' => 'Bla Bla bla',
            'image' => 'series/serie-serie-example.jpg'
        ]);
         ProcessSeriesImage::dispatch($serie);

         $resizedImage = Storage::disk('public')->get('series/serie-serie-example.jpg');

         list($width,$height) = getimagesizefromstring($resizedImage);
         $this->assertEquals(400, $height);
         $this->assertEquals(711, $width);

         $newSize = Storage::disk('public')->size('series/serie-serie-example.jpg');

         $this->assertLessThan($originalSize,$newSize);
    }
}
