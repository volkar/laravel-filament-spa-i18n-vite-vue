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
        $projectData = parent::toArray($request);

        $media = $this->getMedia();
        if ($media) {
            $projectData['images'] = [];
            foreach($media as $m) {
                $projectData['images'][] = ["preview" => $m->getUrl('preview'), "large" => $m->getUrl('large')];
            }
        }

        // Hide time fields and isPublished flag (as it always sends published only records to the frontend)
        unset(
            $projectData['created_at'],
            $projectData['updated_at'],
            $projectData['is_published'],
        );

        return $projectData;
    }

}
