<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model{
    use SoftDeletes;

    protected $table = 'conversations';
    
    public function messages(){
        return $this->hasMany(Message::class);
    }
    //the client
    public function firstuser(){
        return $this->belongsTo(User::class,'user1');
    }
    
    //the admin
    public function seconduser(){
        return $this->belongsTo(User::class,'user2');
    }
}
