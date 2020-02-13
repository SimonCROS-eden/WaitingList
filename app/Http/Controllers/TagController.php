<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTag;

class TagController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Tag::class, 'tag');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tags = Tag::all();

        return view('tag' , ["tags" => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreTag  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTag $request)
    {
        $validated = $request->validated();

        $ticket = new Tag;
        $ticket->fill($validated);
        $ticket->save();

        return redirect('/tag');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $inputName = $tag->name;
        $inputColor = $tag->color;
        
        $validatedData = $request->validate([
            $inputName => 'required|min:5|max:20',
            $inputColor => 'required'
        ]);
        
        $tags = Tag::find($tag->id);
        $tags->name = $request->$inputName;
        $tags->color = $request->$inputColor;
        $tags->save();

        return redirect('/tag');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect('/tag');
    }
}
