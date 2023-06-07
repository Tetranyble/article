<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(schema="ArticleResource")
 * {
 *
 *   @OA\Property(
 *       property="title",
 *       type="string",
 *       description="The resource cover title"
 *   ),
 *   @OA\Property(
 *       property="cover",
 *       type="string",
 *       description="The resource cover image url"
 *   ),
 *   @OA\Property(
 *       property="thumbnail",
 *       type="string",
 *       description="The resource thumbnail image url"
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
class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'cover' => $this->cover,
            'article' => $this->article,
            'likes' => $this->likeCount(),
            'views' => $this->views,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->created_at,
            $this->mergeWhen($this->relationLoaded('author'), [
                'author' => $this->author->name,
            ]),
            $this->mergeWhen($this->relationLoaded('tags'), [
                'tags' => TagResource::collection($this->tags),
            ]),
            'url' => $this->path(true),
        ];
    }
}
