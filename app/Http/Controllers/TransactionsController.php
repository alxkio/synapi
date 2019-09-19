<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{

    public function showTransactionsInPeriod()
    {
        return response()->json(Transaction::all());
    }

    public function create(Request $request)
    {
        $transaction = Transaction::create($request->all());

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        Author::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}