<?php

namespace App\Services;

use App\Models\Characters;
use Illuminate\Support\Facades\Http;

class SwapiCaractersService
{
    private string $baseUrl = 'https://swapi.tech/api';
    private string $path = 'people';

    public function getCaracters(array $people): array
    {
        $responses = Http::pool(function ($pool) use ($people) {
            return array_map(function ($person) use ($pool) {
                $url = "{$this->baseUrl}/{$this->path}/{$person->id}";
                return $pool->as($url)->get($url);
            }, $people);
        });

        $caracters = [];

        foreach ($responses as $url => $response) {
            $data = $response->json('result.properties');

            $caracters[] = new Characters($data);
        }

        return $caracters;
    }

    
}
