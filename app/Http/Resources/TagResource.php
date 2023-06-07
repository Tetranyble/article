<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(schema="TagResource")
 * {
 *
 *   @OA\Property(
 *       property="label",
 *       type="string",
 *       description="The Tag resource label."
 *   ),
 *   @OA\Property(
 *       property="url",
 *       type="string",
 *       description="The Tag resource url."
 *   ),
 * }
 */
class TagResource extends JsonResource
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
            'url' => $this->path(true),
            'label' => $this->label,
        ];
    }
}
