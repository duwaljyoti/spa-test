<?php

namespace App\Http\Controllers\Api;

use App\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestQuery = request()->query();
        $condition = array_key_exists('type', $requestQuery) && $requestQuery['type'] === 'favourite';
        if ($condition) {
            $allNotes = $this->favourite();
        } else {
            $allNotes = Note::latest()->where('user_id', auth()->id())->get();
        }

        return response()->json($allNotes);
    }

    public function favourite()
    {
        return auth()->user()->favourites;
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
            'description' => 'required',
            'is_favourite' => 'required',
            'user_id' => 'required'
        ]);

        $note = Note::create($validatedNoteData);

        return response()->json($note);
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

        $allNotes = $this->favourite();
        
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

    public function getFavouriteId()
    {
        return response()->json($this->favourite()->pluck('id'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleFavourite($id)
    {
        $userFavourites = auth()->user()->favourites();
        if ($userFavourites->where('note_id', $id)->count()) {
            $userFavourites->detach($id);
        } else {
            $userFavourites->attach($id);
        }
        return response()->json();
    }
}
