<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $projectData = [
            ...parent::toArray($request),
            'cover' => $this->getFirstMediaUrl(),
            'preview' => $this->getFirstMedia()->getUrl('preview'),
        ];

        // Hide time fields and isPublished flag (as it always sends published only records to the frontend)
        unset(
            $projectData['created_at'],
            $projectData['updated_at'],
            $projectData['is_published'],
        );

        return $projectData;
    }

}
