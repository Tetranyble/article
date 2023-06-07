<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(schema="CommentResource")
 * {
 *
 *   @OA\Property(
 *       property="subject",
 *       type="string",
 *       description="The Tag resource subject."
 *   ),
 *   @OA\Property(
 *       property="url",
 *       type="string",
 *       description="The Tag resource body."
 *   ),
 *   @OA\Property(
 *       property="author",
 *       type="string",
 *       description="The resource Author."
 *   ),
 *   @OA\Property(
 *       property="articleId",
 *       type="string",
 *       description="The resource Article reference Id."
 *   ),
 * }
 */
class CommentResource extends JsonResource
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
            'subject' => $this->subject,
            'body' => $this->body,
            $this->mergeWhen($this->relationLoaded('author'), [
                'author' => $this->author->name,
            ]),
            'articleId' => $this->article_id,
            'url' => $this->path(true),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
