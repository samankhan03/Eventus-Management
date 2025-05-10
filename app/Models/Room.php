<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Many-to-many relationship with User model.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    

    

    /**
     * Get the messages for the room.
     */
    public function messages() {
        return $this->hasMany(Message::class);
    }

    /**
     * Increment the active member count for the room.
     */
    public function incrementActive()
    {
        $this->increment('active');
    }

    /**
     * Decrement the active member count for the room.
     */
    public function decrementActive()
    {
        $this->decrement('active');
    }
}

