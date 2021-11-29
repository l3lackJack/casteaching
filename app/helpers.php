<?php

use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

if (!function_exists('create_default_user')){

function create_default_user(){
   $user = User::create([
        'name'=> config('casteaching.default_user.name','casteaching'),
        'email'=> config('casteaching.default_user.email','casteaching@gmail.com'),
        'password' => Hash::make(config('casteaching.default_user.password', '12345678'))
    ]);
    try {
        Team::create([
            'name'=> $user->name . "'s team",
            'user_id'=> $user->id,
            'personal_team'=> true
        ]);
    }catch (\Exception $exception){
    }
}
}

if (!function_exists('create_default_video')){
    function create_default_video(){
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
