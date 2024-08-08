<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDailyCreditLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('sanctum')->user();

        $totalDailyCredit = $user->creditHistories()
            ->whereDate('created_at', now()->toDateString())
            ->sum('credit');

        $dailyCreditLimit = $user->dailyCreditLimit;

        if ($totalDailyCredit >= $dailyCreditLimit) {
            return response()->json([
                'message' => 'Daily credit limit exceeded',
            ], 403);
        }

        return $next($request);
    }
}
