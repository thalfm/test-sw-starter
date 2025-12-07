<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function index()
    {
        $stats = DB::table('stats')->where('id', 1)->first();

        return response()->json([
            'success' => true,
            'data' => json_decode($stats->data ?? '{}', true),
        ]);
    }
}
