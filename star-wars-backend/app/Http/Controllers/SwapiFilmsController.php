<?php

namespace App\Http\Controllers;

use App\Services\SwapiFilmsService;
use App\Http\Resources\Film as FilmResource;

class SwapiFilmsController extends Controller
{
    private SwapiFilmsService $swapi;

    public function __construct(SwapiFilmsService $swapi)
    {
        $this->swapi = $swapi;

    }

     public function show(int $id)
    {
        $film = $this->swapi->getFilmsById($id);

        return new FilmResource($film);
    }
}
