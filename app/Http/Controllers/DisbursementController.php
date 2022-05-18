<?php

namespace App\Http\Controllers;

use App\Models\Disbursement;
use App\Http\Requests\StoreDisbursementRequest;
use App\Http\Requests\UpdateDisbursementRequest;

class DisbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $request->user();
        if ($user->role == 'super_admin') {
            $disbursement = DB::table('disbursements')->orderBy('id', 'DESC')->paginate(30);
        }else {
           $disbursement = DB::table('disbursements')->where('user_id', '=', $user->id)->paginate(30);
        }
        return $disbursement;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDisbursementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDisbursementRequest $request)
    {
        $data = $request->validated();
        $disbursment = Disbursement::create($data);
        // return new ExpensesResources($expenses);

        return response('Loan disbursement successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disbursement  $disbursement
     * @return \Illuminate\Http\Response
     */
    public function show(Disbursement $disbursement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDisbursementRequest  $request
     * @param  \App\Models\Disbursement  $disbursement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDisbursementRequest $request, Disbursement $disbursement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disbursement  $disbursement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disbursement $disbursement)
    {
        //
    }
}
