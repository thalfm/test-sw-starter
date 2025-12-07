<?php

namespace App\Services;

use App\Models\Caracters;
use Illuminate\Support\Facades\Http;
use App\Models\Person;

class SwapiPeopleService
{
    private string $baseUrl = 'https://swapi.tech/api';
    private string $path = 'people';
    private SwapiMoviesService $swapi;

    public function __construct(SwapiMoviesService $swapi) {
        $this->swapi = $swapi;
    }


    /**
     * Summary of getPeople
     * @param string | null $name
     * @return Person[]
     */
    public function getPeople(?string $name = null)
    {
        if ($name) {
            return $this->searchPeopleByName($name);
        }

        return $this->getAllPeople();
    }


    /**
     * Summary of getAllPeople
     * @throws \Exception
     * @return Person[]
     */
    private function getAllPeople()
    {
        $response = Http::get("{$this->baseUrl}/{$this->path}");

        if ($response->failed()) {
            throw new \Exception("Failed to fetch SWAPI People");
        }

        $results = $response->json('results');

        return array_map(
            fn($item) => new Person($item),
            $results
        );
    }


    /**
     * Summary of searchPeopleByName
     * @param string $name
     * @throws \Exception
     * @return Person[]
     */
    private function searchPeopleByName(string $name)
    {
        $response = Http::get("{$this->baseUrl}/{$this->path}", [
            'name' => $name
        ]);

        if ($response->failed()) {
            throw new \Exception("Failed to search SWAPI People by name");
        }

        $results = $response->json('result', []);

        return array_map(
            fn($item) => new Person($item['properties']),
            $results
        );
    }

    /**
     * Summary of getPersonById
     * @param string $id
     * @return Person
     */
    public function getPersonById(string $id): Person
    {
        $response = Http::get("{$this->baseUrl}/{$this->path}/{$id}");

        $properties = $response->json('result.properties');

        $person = new Person($properties);

        $person->movies = $this->swapi->getMovies($person->movies);

        return $person;
    }

    public function getPerson(array $people): array
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

            $caracters[] = new Caracters($data);
        }

        return $caracters;
    }

    
}
