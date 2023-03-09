<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $categoryData = [
            ...parent::toArray($request),
            'projectsCount' => $this->projects()->where(['is_published' => true])->count(),
        ];

        // Hide time fields
        unset(
            $categoryData['created_at'],
            $categoryData['updated_at'],
        );

        return $categoryData;
    }

}
