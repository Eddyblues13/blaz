<?php

namespace App\Http\Controllers;

use App\Models\Victim;
use Illuminate\Http\Request;
use App\Imports\VictimsImport;

class VictimController extends Controller
{
    public function index()
    {
        return view('victims.index', [
            'victims' => auth()->user()->victims()->latest()->paginate(10)
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'victims_file' => 'required|file|mimes:csv,txt'
        ]);

        (new VictimsImport(auth()->id()))->import($request->file('victims_file'));

        return back()->with('success', 'Victims imported successfully!');
    }
}
