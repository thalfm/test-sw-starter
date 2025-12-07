<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Support\Facades\Http;
use App\Models\Film;

class SwapiFilmsService
{
    private string $baseUrl = 'https://swapi.tech/api';

    private string $path = 'films';

    private SwapiCaractersService $swapi;

    public function __construct(SwapiCaractersService $swapi)
    {
        $this->swapi = $swapi;
    }

    public function getFilmsById(string $id): Film
    {
        $response = Http::get("{$this->baseUrl}/{$this->path}/{$id}");

        $properties = $response->json('result.properties');

        $film = new Film($properties);

        $film->character = $this->swapi->getCaracters($film->character);

        return $film;
    }


    public function getFilms(array $films): array
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
