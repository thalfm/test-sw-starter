<?php

namespace App\Models;

use App\Models\Film;

class Person
{
    public int $id;
    public ?string $name;
    public ?string $birth_year;
    public ?string $eye_color;
    public array $movies;
    public ?string $gender;
    public ?string $hair_color;
    public ?string $height;
    public ?string $mass;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? basename($data['url']);
        $this->name = $data['name'] ?? null;
        $this->birth_year = $data['birth_year'] ?? null;
        $this->eye_color = $data['eye_color'] ?? null;
        $this->movies = $data['films'] ?? [] ? $this->extractMovieId($data['films']) : [];
        $this->gender = $data['gender'] ?? null;
        $this->hair_color = $data['hair_color'] ?? null;
        $this->height = $data['height'] ?? null;
        $this->mass = $data['mass'] ?? null;
    }

    private function extractMovieId(array $movies): array
    {
        return array_map(function (string $url) {
            return new Film(['url' => $url]);
        }, $movies);
    }
}
