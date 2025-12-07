<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Film extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'opening_crawl' => $this->openingCrawl,
            'characters' => array_map(function ($character) {
                    return [
                        "id" => $character->id,
                        "name" => $character->name
                    ];
                }, $this->character)
        ];
    }
}
