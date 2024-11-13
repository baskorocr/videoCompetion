<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Karya;
use App\Models\transaction;
use App\services\TripayServices;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = transaction::where('idNPK', auth()->user()->npk)->get();

        return view('transaction.index', compact('transactions'));
    }

    public function show($id)
    {

        $tripay = new TripayServices();
        $data = $tripay->detailTransaction($id);


        return view('transaction.show', compact('data'));

    }

    public function store(Request $request)
    {

        $request->validate([
            'channel' => ['required', 'string'],
        ]);

        $karya = Karya::findOrFail($request->input('id'));
        $tripay = new TripayServices();
        $transactionRequest = json_decode($tripay->requestTransaction($request->input('channel'), $karya->title, $request->input('amount'), auth()->user()->name, auth()->user()->email));

        transaction::create([
            'idKarya' => $request->input('id'),
            'total_amount' => $request->input('amount'),
            'idNPK' => auth()->user()->npk,
            'reference' => $transactionRequest->data->reference,
            'merchant_reference' => $transactionRequest->data->merchant_ref

        ]);


    }
}