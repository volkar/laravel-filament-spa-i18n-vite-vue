<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $pageData = parent::toArray($request);

        // Hide time fields
        unset(
            $pageData['created_at'],
            $pageData['updated_at'],
        );

        return $pageData;
    }

}
