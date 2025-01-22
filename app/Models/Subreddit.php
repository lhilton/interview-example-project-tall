<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subreddit extends Model
{
    /** @use HasFactory<\Database\Factories\SubredditFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'url',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $subreddit) {
            if ($subreddit->user?->subreddits()->count() >= 5) {
                $subreddit->user?->subreddits()->orderBy('created_at')->first()->delete();
            }
        });
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
