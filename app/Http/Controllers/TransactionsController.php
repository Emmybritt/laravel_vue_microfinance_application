<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Http\Requests\StoreTransactionsRequest;
use App\Http\Requests\UpdateTransactionsRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Account;
// use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionsRequest $request)
    {
        $data = $request->validated();
        $transaction = Transactions::create($data);
        return $transaction;
        

        
    }
    /**
     * @var App\Models\Transactions 
     * fetch debit and credit transactions of a user
     * created by emmy britt
     */

    public function totalCreditAndDebit($id) {
        $num_id = (int)$id;
        $debit = Transactions::where('account_id', '=', $num_id)->where(function($query) {
            $query->where('details', '=', 'debit');
        })->sum('amount_paid');

        $credit = Transactions::where('account_id', '=', $num_id)->where(function($query) {
            $query->where('details', '=', 'credit');
        })->sum('amount_paid');

        return response([
            'debit' => $debit,
            'credit' => $credit,
        ]);
    }


   

   
    // account_id	details	amount_paid	balance	payment_day


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show(Transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionsRequest  $request
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionsRequest $request, Transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transactions $transactions)
    {
        //
    }
}
