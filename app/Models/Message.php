<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model{
    use SoftDeletes;

    // protected $table = 'messages';
    // protected $fillable = ['content', 'seen' ];
    protected $fillable = ['content', 'seen'];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function makeMessagesAsRead($messages, $reader_id)
    {
        $messages = $messages->where('user_id', $reader_id);
        foreach ($messages as $message) {
            $message->update(['seen' => 'true']);
        }
    }
}
