<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        create_default_user();
        create_default_video();
        // \App\Models\User::factory(10)->create();
        //Crear usuari propi pero tambe per a professor
        User::create([
            'name' => 'Gabriel',
            'email'=>'gabrielurs@gmail.com',
            'password'=> Hash::make((config('casteaching.user_default.password')))
        ]);

        User::create([
            'name'=> env('DEFAULT_USER_NAME','casteaching'),
            'email'=> env('DEFAULT_USER_EMAIL','casteaching@gmail.com'),
            'password'=> env('DEFAULT_USER_PASSWORD',12345678)
        ]);

        Video::create([
            'title'=> 'Ubuntu 101',
            'description'=> '# Here Description',
            'url' => 'https://youtu.be/w8j07_DBl_I',
            'published_at'=> Carbon::parse('December 13'),
            'previous'=> null,
            'next'=> null,
            'series_id'=> 1
        ]);
    }
}
