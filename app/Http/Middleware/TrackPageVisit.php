<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('GET') && !$request->ajax() && $response->isSuccessful()) {
            $today = now()->toDateString();

            try {
                $record = PageVisit::firstOrCreate(
                    ['visited_date' => $today],
                    ['total_views' => 0, 'unique_visitors' => 0]
                );
            } catch (\Illuminate\Database\UniqueConstraintViolationException) {
                // Race condition : une autre requête a inséré la ligne en même temps
                $record = PageVisit::where('visited_date', $today)->first();
            }

            if ($record) {
                $record->increment('total_views');

                $sessionKey = 'pv_unique_' . $today;
                if (!session()->has($sessionKey)) {
                    session()->put($sessionKey, true);
                    $record->increment('unique_visitors');
                }
            }
        }

        return $response;
    }
}