<?php

use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

if (!function_exists('create_default_user')){

function create_default_user(){
   $user = User::create([
        'name'=> config('casteaching.default_user.name','casteaching'),
        'email'=> config('casteaching.default_user.email','casteaching@gmail.com'),
        'password' => Hash::make(config('casteaching.default_user.password', '12345678'))
    ]);

   $user->superadmin = true;
   $user->save();

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
if (! function_exists('create_regular_user')) {
    function create_regular_user()
    {
        $user = User::create([
            'name' => 'Pepe Pringao',
            'email' => 'pringao@casteaching.com',
            'password' => Hash::make('12345678')
        ]);

        add_personal_team($user);
        return $user;
    }
}

if (! function_exists('create_super_admin_user')) {
 function create_videomanager_user(){
     $user = User::create([
         'name'=>'VideosManager',
         'email'=>'videosmanager@casteaching.com',
         'password'=> Hash::make('12345678')
     ]);
     Permission::create(['name' => 'videos_manage_index']);
     $user->givePermissionTo('videos_manage_index');
     add_personal_team($user);
     return $user;

 }
}

if (! function_exists('create_super_admin_user')){
    function create_superadmin_user(){
        $user = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@casteaching.com',
            'password' => Hash::make('12345678')
        ]);

        $user->superadmin = true;
        $user-> save();

        add_personal_team($user);
        return $user;
    }
}
if (! function_exists('add_personal_team')) {
    /**
     * @param $user
     */
    function add_personal_team($user): void
    {
        try {
            Team::forceCreate([
                'name' => $user->name . "'s team",
                'user_id' => $user->id,
                'personal_team' => true
            ]);
        } catch (\Exception $exception) {
        }
    }
}

if (! function_exists('define_gates')){
    function define_gates(){

        Gate::before(function ($user, $ability){
            if ($user->isSuperAdmin()){
                return true;
            }
        });


    }
}

if (! function_exists('create_permission')) {
    function create_permission()
    {
        Permission::firstOrCreate(['name' => 'videos_manage_index']);
    }
}
