<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResourceWithProjects extends JsonResource
{
    /**
     * Transform the resource into an array with related children's data.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $categoryData = [
            ...parent::toArray($request),
            'projects' => ProjectResource::collection($this->projects()->where(['is_published' => true])->get()),
        ];

        // Hide time fields
        unset(
            $categoryData['created_at'],
            $categoryData['updated_at'],
        );

        return $categoryData;
    }

}
