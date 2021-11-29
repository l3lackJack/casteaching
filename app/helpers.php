<?php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

if (!function_exists('create_default_user')){

function create_default_user(){
    User::create([
        'name'=> config('casteaching.default_user.name','casteaching'),
        'email'=> config('casteaching.default_user.email','casteaching@gmail.com'),
        'password' => Hash::make(config('casteaching.default_user.password', '12345678'))
    ]);
}
}
