<?php

namespace App\Models;

readonly class Movie
{
    public int $id;
    public ?string $name;

    public function __construct(array $data)
    {
        $id = $data["id"] ?? null;
        $this->id = $id ?: basename($data["url"]);
        $this->name = $data["title"] ?? null;
    }
}
