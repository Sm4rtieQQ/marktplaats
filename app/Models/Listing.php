<?php

namespace App\Models;

use App\FormattedPrice;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description', 'price', 'promoted', 'user_id',])]

class Listing extends Model
{
    use HasFactory;
    use FormattedPrice;


    // RELATIONS
    public function biddings()
    {
        return $this->hasMany(Bidding::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // FUNCTIONS
    public function scopeWithCategory(Builder $query, int $categoryId)
    {
        return $query->whereHas('categories', function ($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        });
    }

    public function scopeWithKeyword(Builder $query, string $keyword)
    {
        return $query->where('description', 'LIKE', '%' . $keyword . '%')
            ->orWhere('name', 'LIKE', '%' . $keyword . '%');
    }
}
