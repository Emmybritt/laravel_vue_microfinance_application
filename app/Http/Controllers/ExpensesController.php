<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Http\Requests\StoreExpensesRequest;
use App\Http\Requests\UpdateExpensesRequest;
use App\Http\Resources\ExpensesResources;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->role == 'super_admin') {
            $expenses = DB::table('expenses')->orderBy('id', 'DESC')->paginate(30);
        }else {
           $expenses = DB::table('expenses')->where('user_id', '=', $user->id)->paginate(30);
        }
        return $expenses;
    }

    public function checkRecentExpenses(Request $request) 
    {
        $user = $request->user();
        if ($user->role == 'super_admin') {
          $expenses = DB::table('expenses')->orderBy('id', 'DESC')->paginate(5);
        }else{
           $expenses = DB::table('expenses')->where('user_id', '=', $user->id)->paginate(5);
        }
        
        return response([
            'expenses' => $expenses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExpensesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpensesRequest $request)
    {
        $data = $request->validated();
        $expenses = Expenses::create($data);
        return new ExpensesResources($expenses);
    }

    public function searchExpenses(Request $request, $query) {
        $user = $request->user();
        if ($user->role == 'super_admin') {
            $results = DB::table('expenses')
            ->where('service_paid_for', 'LIKE', '%' .$query. '%')
            ->orWhere('trans_date', 'LIKE', '%' .$query. '%')
            ->orWhere('total_amount_spent', 'LIKE', '%' .$query. '%')
            ->get();
        }else{
            $results = DB::table('expenses')
            ->where('service_paid_for', 'LIKE', '%' .$query. '%')
            ->orWhere('trans_date', 'LIKE', '%' .$query. '%')
            ->orWhere('total_amount_spent', 'LIKE', '%' .$query. '%')
            ->get();
        }


        return response([
            'result' => $results,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show(Expenses $expenses, $id)
    {
        $expense = Expenses::find($id);
        return response([
            'expenses' => $expense,
            'branch' => $expense->branch,
            'posted_by' => $expense->user
        ]);
    }

    public function calculateTotalExpenses(Request $request) {
        $user = $request->user();
        if ($user->role == 'super_admin') {
            $expensesSum = DB::table('expenses')->sum('total_amount_spent');
        }else{
            $expensesSum = DB::table('expenses')->sum('total_amount_spent')->where('branch_id', '=', $user->branch_id);
        }
        
        return (int)$expensesSum;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExpensesRequest  $request
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpensesRequest $request, Expenses $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenses $expenses, Request $request, $id)
    {
    //    print($expenses);
        DB::table('expenses')->where('id', '=', $id)->delete();
    
    }
}
