<?php

namespace App\Http\Controllers;

use App\Services\SwapiPeopleService;
use App\Http\Resources\PeopleCollection;
use App\Http\Resources\People as PeopleResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SwapiPeopleController extends Controller
{
    private SwapiPeopleService $swapi;

    public function __construct(SwapiPeopleService $swapi)
    {
        $this->swapi = $swapi;
    }

    public function index(\Illuminate\Http\Request $request)
    {
        try {

            $start = microtime(true);

            $name = $request->query('name');
            $people = $this->swapi->getPeople($name);

            $duration = microtime(true) - $start;
            $this->logSearch('person_list', $name, $duration);

            return new PeopleCollection($people);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching SWAPI data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(int $id)
    {
        $start = microtime(true);

        $person = $this->swapi->getPersonById($id);

        $duration = microtime(true) - $start;
        $this->logSearch('person_detail', "person-{$id}", $duration);

        return new PeopleResource($person);
    }

    private function logSearch(string $type, ?string $query, float $duration)
    {
        DB::table('search_logs')->insert([
            'type' => $type,
            'query' => $query,
            'duration' => $duration,
            'searched_at' => now(),
        ]);
    }

}
