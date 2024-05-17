<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use App\Models\UploadSettings;

class CheckUploadPeriod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $latestPeriod = UploadSettings::orderBy('end_date', 'desc')->first();

        if ($latestPeriod) {
            $now = Carbon::now();
            if ($now->lt(Carbon::parse($latestPeriod->start_date)) || $now->gt(Carbon::parse($latestPeriod->end_date))) {
                return redirect()->back()->with('error', 'Deadline for report uploads is over. Uploads are not allowed at this time.');
            }
        } else {
            return redirect()->back()->with('error', 'No upload period is set.');
        }
        return $next($request);
    }
}
