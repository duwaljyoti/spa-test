<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersWithNotes = User::query()
            ->join('notes', 'users.id', 'notes.user_id')
            ->select('users.name', 'users.id')
            ->groupBy('users.id');

        return response()->json($usersWithNotes->get());
    }

    public function getNotesByUser(User $user)
    {
        return $user->notes;
    }
}