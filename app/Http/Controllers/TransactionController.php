<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = Transaction::all();

        if (request()->wantsJson()) {
            return response()->json($transactions);
        }


        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_date' => 'required|date',
            'total' => 'required|numeric',
        ]);

        Transaction::create([
            'transaction_date' => $request->transaction_date,
            'total' => $request->total,
        ]);

        return redirect()->route('transactions.index')
            ->with('message', 'Transaction created successfully!');
    }


    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'transaction_date' => 'required|date',
            'total' => 'required|numeric',
        ]);

        $transaction->update([
            'transaction_date' => $request->transaction_date,
            'total' => $request->total,
        ]);

        return redirect()->route('transactions.index')
            ->with('message', 'Transaction updated successfully!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')
            ->with('message', 'Transaction deleted successfully!');
    }
}
