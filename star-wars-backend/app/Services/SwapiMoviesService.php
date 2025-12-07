<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Facades\Http;

class SwapiMoviesService
{
    private string $baseUrl = 'https://swapi.tech/api';

    private string $path = 'films';

    public function getMovies(array $films): array
    {
        $responses = Http::pool(function ($pool) use ($films) {
            return array_map(function ($film) use ($pool) {
                $url = "{$this->baseUrl}/{$this->path}/{$film->id}";
                return $pool->as($url)->get($url);
            }, $films);
        });

        $films = [];

        foreach ($responses as $url => $response) {
            $data = $response->json('result.properties');

            $films[] = new Movie($data);
        }

        return $films;
    }
}
