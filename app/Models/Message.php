<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'conversation_id',
        'from_id',
        'to_id',
        'readed_at'
    ];


    public function Conversation()
    {
       return $this->belongsTo(Conversation::class);
    }
}
