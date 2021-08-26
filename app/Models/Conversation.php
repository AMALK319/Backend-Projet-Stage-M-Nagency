<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;


    public function Messages()
    {
       return $this->hasMany(Message::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($conversation) {

        Message::where('conversation_id' , $conversation->id())->delete();
        });
    }
}
