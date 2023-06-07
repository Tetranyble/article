<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(schema="Comment")
 * {
 *
 *   @OA\Property(
 *       property="subject",
 *       type="string",
 *       description="The resource subject"
 *   ),
 *   @OA\Property(
 *       property="body",
 *       type="string",
 *       description="The resource body"
 *   ),
 *   @OA\Property(
 *       property="user_id",
 *       type="integer",
 *       description="The resource Author Id"
 *   ),
 *   @OA\Property(
 *       property="article_id",
 *       type="integer",
 *       description="The resource Article being commented on."
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
 * }
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'body',
        'user_id',
        'article_id',
    ];

    protected $with = ['author'];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function path(bool $fullPath = false): string
    {
        return $fullPath == false ? "api/v1/articles/{$this->article->id}/comment/{$this->id}" :
            url("api/v1/articles/{$this->article->id}/comment/{$this->id}");
    }
}
