<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return view('plans.index', [
            'plans' => Plan::all(),
            'currentPlan' => auth()->user()->subscription
        ]);
    }

    public function subscribe(Request $request, Plan $plan)
    {
        $user = auth()->user();
        
        // Process payment here (implementation depends on your payment gateway)
        
        $user->subscription()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'plan_id' => $plan->id,
                'ends_at' => now()->addMonth(),
                'status' => 'active'
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Subscription updated successfully!');
    }
}