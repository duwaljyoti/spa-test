<?php

namespace App;

use App\Http\Controllers\Api\NotesController;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function favourites()
    {
        return $this->belongsToMany(Note::class, 'favourite_notes', 'user_id', 'note_id');
    }
}
