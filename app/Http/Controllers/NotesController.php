<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allNotes = Note::all();

        $requestQuery = request()->query();
        if (array_key_exists('type', $requestQuery) && $requestQuery['type'] === 'favourite') {
            $allNotes = $allNotes->where('is_favourite', true);
        }

        return response()->json($allNotes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedNoteData = $request->validate([
            'title' => 'required',
            'user_id' => 'required',
            'is_favourite' => 'required',
        ]);

        $note = Note::create($validatedNoteData);

        return response()->json($note);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $note = Note::find($id)->update(['title' => $request->get('title')]);

        return response()->json($note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::findOrFail($id);

        return response()->json($note->delete());

    }

    public function favourite($id)
    {
        $note = Note::find($id);
        $note = $note->update(['is_favourite' => !$note->is_favourite]);

        return response()->json($note);
    }
}
