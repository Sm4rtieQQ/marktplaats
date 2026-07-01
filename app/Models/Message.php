<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['chat_id', 'from_uid', 'to_uid', 'text'])]

class Message extends Model
{
    use HasFactory;

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function from_uid()
    {
        return $this->belongsTo(User::class, 'from_uid');
    }

    public function to_uid()
    {
        return $this->belongsTo(User::class, 'to_uid');
    }
}
