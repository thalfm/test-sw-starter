<?php

namespace App\Models;

class Film
{
    public int $id;
    public ?string $name;
    public ?string $openingCrawl;

    public ?array $character;

    public function __construct(array $data)
    {
        $this->id =  $data['id'] ?? basename($data["url"]);
        $this->name = $data["title"] ?? null;
        $this->openingCrawl = $data["opening_crawl"] ?? null;
        $this->character = $data["characters"] ?? [] ? $this->extractPersonId($data["characters"]) : null;
    }

    private function extractPersonId(array $caracter): array
    {
        return array_map(function (string $url) {
            return new Characters(['url' => $url]);
        }, $caracter);
    }
}
