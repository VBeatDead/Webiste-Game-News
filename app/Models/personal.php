<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personal extends Model
{
    use HasFactory;

    protected $table = 'newsgame';

    protected $fillable = [
        'photoUrl',
        'title',
        'description',
        'name',
        'category',
        'tags',
        'reading_level'
    ];

    protected $casts = [
        'tags' => 'array'  // Cast tags sebagai array
    ];

    // Helper method untuk mendapatkan daftar kategori
    public static function getCategories()
    {
        return [
            'PC Games' => 'PC Games',
            'Mobile Games' => 'Mobile Games',
            'Console Games' => 'Console Games',
            'Game Reviews' => 'Game Reviews',
            'Gaming Tips' => 'Gaming Tips',
            'eSports' => 'eSports',
            'Game Updates' => 'Game Updates'
        ];
    }

    // Helper method untuk mendapatkan daftar level pembaca
    public static function getReadingLevels()
    {
        return [
            'beginner' => 'Pemula',
            'intermediate' => 'Menengah',
            'expert' => 'Ahli'
        ];
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'item_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'item_id');
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'item_id');
    }

    // Helper method to check if user has bookmarked
    public function isBookmarkedBy($user)
    {
        if (!$user) return false;
        return $this->bookmarks()->where('user_id', $user->id)->exists();
    }

    // Helper method to get bookmark notes
    public function getBookmarkNotes($user)
    {
        if (!$user) return null;
        $bookmark = $this->bookmarks()->where('user_id', $user->id)->first();
        return $bookmark ? $bookmark->notes : null;
    }
}
