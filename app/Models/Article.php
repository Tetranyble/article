<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(schema="Article")
 * {
 *
 *   @OA\Property(
 *       property="cover",
 *       type="string",
 *       description="The resource cover title"
 *   ),
 *   @OA\Property(
 *       property="article",
 *       type="string",
 *       description="The resource text content"
 *   ),
 *   @OA\Property(
 *       property="views",
 *       type="integer",
 *       description="The resource view count"
 *   ),
 *   @OA\Property(
 *       property="likes",
 *       type="integer",
 *       description="The resource like count"
 *   ),
 *   @OA\Property(
 *       property="created_at",
 *       type="string",
 *       description="The resource creation date"
 *   ),
 *   @OA\Property(
 *       property="updated_at",
 *       type="string",
 *       description="The resource last updated date"
 *   ),
 *   @OA\Property(
 *       property="author",
 *       type="string",
 *       description="The Article resource author"
 *   ),
 * }
 */
class Article extends Model
{
    use HasFactory;

    protected $with = ['tags'];

    protected $fillable = [
        'thumbnail',
        'title',
        'description',
        'cover',
        'article',
        'views',
        'user_id',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'article_likes')->withTimestamps();
    }

    public function liked(User $user)
    {
        return $this->likes()->sync($user);
    }

    public function likeCount()
    {
        return $this->likes()->count();
    }

    public function viewed(): int|false
    {
        return $this->increment('views');
    }

    public function path(bool $fullPath = false): string
    {
        return $fullPath == false ? "api/v1/articles/{$this->id}" :
            url("/api/v1/articles/{$this->id}");
    }

    public function scopeFilter($query, $request)
    {
        $query->when($request->search ?? false, function ($q, $search) {
            $q->where(function ($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('article', 'like', '%'.$search.'%');
            });
        })->when($request->author ?? false, function ($q, $author) {
            $q->whereHas('author', function ($q) use ($author) {
                $q->where('user_id', $author);
            });
        })->latest();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function giveTags(Tag $tags)
    {
        return $this->tags()->sync($tags);
    }

    public function comments(): hasMany
    {
        return $this->hasMany(Comment::class, 'article_id');
    }
}
