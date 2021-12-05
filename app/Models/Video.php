<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $guarded;
    protected $dates =['published_at'];
//    protected $casts =[
//        'published_at'=> 'datetime:Y-m-d',
//    ];

    //formated_published_at accesor
    public function getFormattedPublishedAtAttribute()
    {
//        Carbon::setlocale('ca_es');
        $this->published_at->format('j F');
        return '13 December';
    }
}
