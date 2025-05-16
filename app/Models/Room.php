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
     * Gets the messages for the room.
     */
    public function messages() {
        return $this->hasMany(Message::class);
    }

    /**
     * Increments the active member count for the room.
     */
    public function incrementActive()
    {
        $this->increment('active');
    }

    /**
     * Decrements the active member count for the room.
     */
    public function decrementActive()
    {
        $this->decrement('active');
    }
}

