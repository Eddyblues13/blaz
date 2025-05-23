<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('dashboard.home', [
            'user' => $user,
            'recentCampaigns' => $user->campaigns()->latest()->take(5)->get(),
            'recentTransactions' => $user->transactions()->latest()->take(5)->get()
        ]);
    }

    public function stats()
    {
        $user = Auth::user();

        return response()->json([
            'campaigns' => $user->campaigns()->count(),
            'balance' => number_format($user->balance, 2),
            'success_rate' => $user->success_rate,
            'victims' => $user->victims()->count()
        ]);
    }
}
