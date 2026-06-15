<?php

namespace App\Models;

use App\FormattedPrice;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['listing_id', 'user_id', 'bid'])]

class Bidding extends Model
{
    use HasFactory;
    use FormattedPrice;

    public function listing()
    {
        return $this->BelongsTo(Listing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
