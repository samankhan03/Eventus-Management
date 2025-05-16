<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Showing attendees of an event

class EventAttendees extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'event_id', 'user_id'
    ];
}
