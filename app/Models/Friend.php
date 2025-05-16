<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// This model is used to manage the friend requests and friendships between users
class Friend extends Model
{
    use HasFactory;

    protected $fillable = ['requester', 'user_requested', 'status'];
}
