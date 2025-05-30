<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transactions.index', [
            'transactions' => auth()->user()->transactions()->latest()->paginate(10)
        ]);
    }
}
