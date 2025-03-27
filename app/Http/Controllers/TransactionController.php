<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // 1. Tampilkan daftar transaksi
    public function index()
    {
        $transactions = Transaction::all();

        if (request()->wantsJson()) {
            return response()->json($transactions);
        }


        return view('transactions.index', compact('transactions'));
    }
    // 2. Form buat transaksi baru
    public function create()
    {
        return view('transactions.create');
    }

    // 3. Simpan transaksi baru
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

    // 4. Tampilkan form edit
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transactions.edit', compact('transaction'));
    }

    // 5. Update transaksi
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

    // 6. Hapus transaksi
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')
            ->with('message', 'Transaction deleted successfully!');
    }
}
