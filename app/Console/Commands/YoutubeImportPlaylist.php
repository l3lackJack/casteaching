<?php

namespace App\Console\Commands;

use Alaouy\Youtube\Facades\Youtube;
use App\Models\Serie;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\FileHelpers;
use Illuminate\Support\Str;

class YoutubeImportPlaylist extends Command
{
    use FileHelpers;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:import_playlist {playlistId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import a youtube playlist. Playlist will be converted to a casteaching serie';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $playlist = Youtube::getPlaylistById($this->argument('playlistId'));
        $this->info('Serie name: ' . $playlist->snippet->title);
        $this->info('Creating serie...');

        $extension = pathinfo(storage_path(($playlist->snippet->thumbnails->maxres->url), PATHINFO_EXTENSION))['extension'];
        $filename = Str::slug($playlist->snippet->title).'.'.$extension;
        $path = 'app/public/series/' . $filename;
        copy($playlist->snippet->thumbnails->maxres->url, storage_path($path));


        $serie = Serie::create([
            'title' => $playlist->snippet->title,
            'description' => $playlist->snippet->description,
            'image' => $filename,
            'teacher_name' => 'Sergi Tur Badenas',
            'teacher_photo_url' => 'https://www.gravatar.com/avatar/046889f49471fd40d105eb76b9d83bf6'
        ]);

        $items = Youtube::getPlaylistItemsByPlaylistId($this->argument('playlistId'));
        $previous = null;
        foreach ($items['results'] as $item) {
            if ($item->snippet->title === 'Deleted video') {
                continue;
            }
            $this->info($item->snippet->title);
            $video = Video::create([
                'title' => $item->snippet->title,
                'description' => $item->snippet->description,
                'url' => 'https://www.youtube.com/embed/' . $item->snippet->resourceId->videoId,
                'published_at' => Carbon::now(),
                'previous' => optional($previous)->id,
                'user_id' => User::where(['email' => 'sergiturbadenas@gmail.com'])->first()->id,
                'serie_id' => $serie->id
            ]);
            if ($previous) {
                $previous->next = optional($video)->id;
                $previous->save();
            }
            $previous = $video;
        }
    }
}
