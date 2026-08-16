<?php

namespace App\Http\Controllers\Tracking;

use App\Http\Controllers\Controller;
use App\Models\UserTracking;
use Illuminate\Http\Request;

class VisitDurationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_url' => ['required', 'url', 'max:2000'],
            'seconds' => ['required', 'integer', 'min:1', 'max:14400'],
        ]);

        $visit = UserTracking::where('session_id', $request->session()->getId())
            ->where('page_url', $validated['page_url'])
            ->latest('id')->first();

        if ($visit && (int) $validated['seconds'] > (int) $visit->time_spent) {
            $visit->time_spent = $validated['seconds'];
            $visit->save();
        }

        return response()->noContent();
    }
}
