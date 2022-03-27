<?php

namespace App\Http\Controllers;

use App\TransactionRecord;
use Illuminate\Http\Request;

class TransactionRecordController extends Controller
{
    //
    public function getAllTransaction()
    {
        return TransactionRecord::all();
    }

    public function addTransaction(Request $req)
    {
        $transaction = new TransactionRecord();
        $transaction->fin_report_id = $req->input('fin_report_id');
        $transaction->thu_chi = $req->input('thu_chi');
        $transaction->chi_phi = $req->input('chi_phi');
        $transaction->noi_dung = $req->input('noi_dung');
        $transaction->save();
        return response()->json(['transaction' => $transaction], 201);
    }

    public function updateTransaction(Request $req)
    {
        $transaction = TransactionRecord::find($req->id);
        if(!$transaction)
        {
            return response()->json(['message' => "Transaction record not found"], 404);
        }
        $transaction->fin_report_id = $req->input('fin_report_id');
        $transaction->thu_chi = $req->input('thu_chi');
        $transaction->chi_phi = $req->input('chi_phi');
        $transaction->noi_dung = $req->input('noi_dung');
        $transaction->save();
        return response()->json(['transaction' => $transaction], 201);
    }
}
