<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Tests\Feature\Videos\VideosManageControllerTest;

class VideosManageController extends Controller
{
    public static function testedBy()
    {
        return VideosManageControllerTest::class;
    }

    public function index()
    {
        return view('videos.manage.index',[
            'videos' => Video::all()
        ]);
    }

    /** C -> Create -> Guardara a base de dades el nou Video */
    public function store(Request $request)
    {
        Video::create([
            'title'=> $request->title,
            'description'=> $request->description,
            'url'=> $request->url,
        ]);
        session()->flash('status', 'Successfully created');
        return redirect()->route('manage.videos');
//        return response()->view('videos.manage.index',['videos'=> []], 201);
    }

    /** R-> NO LLISTA -> Individual ->
     */
    public function show($id)
    {
        //
    }

    /** U -> update - > Form */
    public function edit($id)
    {
        //
    }

    /** U -> update - > Processarà el Form i guardara las modificacions */
    public function update(Request $request, $id)
    {
        //
    }

    /** D -> DELETE
     */
    public function destroy($id)
    {
        Video::find($id)->delete();
        session()->flash('status', 'Successfully removed');
        return redirect()->route('manage.videos');
    }
}
