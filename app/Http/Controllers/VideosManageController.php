<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideosManageController extends Controller
{
    //CRUD
    /**
     * R -> Retrieve -> Llista
     */
    public function index()
    {
        return view('videos.manage.index');
    }

    /**
     * C -> create -> mostra formulari
     */
    public function create()
    {
        //
    }

    /**
     * C -> create -> Guarda formulari
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * R-> No llista -> Individual
     */
    public function show($id)
    {
        //
    }

    /**
     *  U -> update form
     */
    public function edit($id)
    {
        //
    }

    /**
     * u -> update -> procesa el form i guardara les modificacions
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * D -> Delete
     */
    public function destroy($id)
    {
        //
    }
}
