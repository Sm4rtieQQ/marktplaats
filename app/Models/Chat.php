<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['listing_id', 'receiver_uid', 'sender_uid'])]

class Chat extends Model
{
    use HasFactory;

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_uid');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_uid');
    }
}
