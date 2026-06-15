<?php

namespace App\Models;

use App\FormattedPrice;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description', 'price', 'user_id',])]

class Listing extends Model
{
    use HasFactory;
    use FormattedPrice;

    public function biddings()
    {
        return $this->hasMany(Bidding::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'name',
        'description',
        'price',
        'user_id',
    ];
}
