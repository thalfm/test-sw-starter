<?php 

namespace App\Jobs;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class RecalculateStatsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;
    public function handle()
    {
        try {
            $logs = DB::table('search_logs')->get();

            $topQueries = DB::table('search_logs')
                ->select('query', DB::raw('COUNT(*) as total'))
                ->whereNotNull('query')
                ->groupBy('query')
                ->orderByDesc('total')
                ->limit(5)
                ->get();

            $avgDuration = DB::table('search_logs')->avg('duration');

            $popularHour = DB::table('search_logs')
                ->select(DB::raw('HOUR(searched_at) as hour'), DB::raw('COUNT(*) as total'))
                ->groupBy('hour')
                ->orderByDesc('total')
                ->first();

            DB::table('stats')->updateOrInsert(
                ['id' => 1],
                [
                    'data' => json_encode([
                        'top_queries' => $topQueries,
                        'average_duration_ms' => $avgDuration * 1000,
                        'popular_hour' => $popularHour?->hour,
                        'last_updated' => now()->toDateTimeString(),
                    ]),
                    'updated_at' => now(),
                ]
            );
        } catch (\Throwable $e){
           \Log::error("RecalculateStatsJob failed: " . $e->getMessage());

            throw $e; // importante: deixa falhar para o queue marcar FAIL
        }
    }
}
