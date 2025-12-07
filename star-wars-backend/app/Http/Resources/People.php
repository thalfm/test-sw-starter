<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class People extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'data' => [
                'id' => $this->id,
                'name' => $this->name,
                'birth_year' => $this->birth_year,
                'eye_color' => $this->eye_color,
                'movies' => array_map(function ($movie) {
                    return [
                        "id" => $movie->id,
                        "name" => $movie->name
                    ];
                }, $this->movies),
                'gender' => $this->gender,
                'hair_color' => $this->hair_color,
                'height' => $this->height,
                'mass' => $this->mass,
            ]
        ];
    }
}
