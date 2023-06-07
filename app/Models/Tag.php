<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(schema="Tag")
 * {
 *
 *   @OA\Property(
 *       property="label",
 *       type="string",
 *       description="The resource label"
 *   ),
 * }
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tag');
    }

    public function path(bool $fullPath = false): string
    {
        return $fullPath == false ? "api/v1/tags/{$this->id}" :
            url("/api/v1/tags/{$this->id}");
    }
}
