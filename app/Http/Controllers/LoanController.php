<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use App\Http\Resources\LoanResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\GuarantorsForm;
use App\Models\UserLoanNextOfKin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LoanController extends Controller
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
          $loans = DB::table('loans')->orderBy('id', 'DESC')->paginate(20);
        }else{
           $loans = DB::table('loans')->where('user_id', '=', $user->id)->paginate(20);
        }
        
        return response([
            'loans' => $loans,
        ]);
    }

    public function allLoansCount(Request $request)
    {
        $user = $request->user();

        if ($user->role == 'super_admin') {
            $AllLoans = DB::table('loans')->count();
            
        }else{
            
            $AllLoans = DB::table('loans')->where('user_id', '=', $user->id)->count();
        }
        return $AllLoans;
    }

    public function getAllLoanUser(){
        $data = DB::table('loans')->pluck('id','full_name');
        return $data->toArray();
        // var_dump($data->toArray());
    }

    public function postLoanUsersPayment(Request $request) {
        // $data = $request->pay
    }
    

    public function fetchTotalLoanUser(Request $request) {
        $user = $request->user();

        if ($user->role == 'super_admin') {
            $normalLoans = DB::table('loans')->where('loan_type', '=', 'normalloan')->count();
            $quickloans = DB::table('loans')->where('loan_type', '=', 'quickloan')->count();

        }else{
            $normalLoans = DB::table('loans')->where('user_id', '=', $user->id)->where(function ($query){
                $query->where('loan_type', '=', 'normalloan');
            })->count();
            $quickloans = DB::table('loans')->where('user_id', '=', $user->id)->where(function ($query){
                $query->where('loan_type', '=', 'quickloan');
            })->count();
        }

        return response([
            'quickloans' => $quickloans,
            'normalloans' => $normalLoans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLoanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoanRequest $request)
    {
        $data = $request->validated();

        $lastloanNumber = DB::table('loans')->latest()->first();

        if (empty($lastloanNumber->loan_number)) {
            $incrementedloanNumber = 1000000001;
        }else{
            $incrementedloanNumber = $lastloanNumber->loan_number + 1;
        }


        // var_dump($lastAccountNumber);

        
        $data['loan_number'] = $incrementedloanNumber;

        if (isset($data['image'])) {
            $relativePath = $this->if($data['image']);
            $data['image'] = $relativePath;
        }


        $loan = Loan::create($data);
        $data['nextOfKin']['loan_id'] = $loan->id;
        
        $this->createNextOfKin($data['nextOfKin']);
        

        foreach ($data['guarantors'] as $guarantor) {
            $guarantor['loan_id'] = $loan->id;
            $this->createGuarantor($guarantor);
            
        }
        return new LoanResource($loan);
    }

    private function if($image) {
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            $image = substr($image, strpos($image, ',') + 1);

            $type = strtolower($type[1]);

            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        }else{
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'loanImages/';
        $file = Str::random() . '.' .$type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;

        if (!File::exists($absolutePath)) {
           File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);
        return $relativePath;
    }
    
    private function createGuarantor($data) {
        
        $validator = Validator::make($data, [
            'guarantors_image' => 'required',
            'full_name' => 'required|string',
            'age' => 'required',
            'gender' => 'required', 
            'state' => 'required',
            'lga' => 'required', 
            'residential_address' => 'required', 
            'occupation' => 'required',
            'phone_no' => 'required',
            'nature_of_business' => 'required',
            'address_of_business'=> 'required',
            'relationship' => 'required',
            'loan_id' => 'exists:Loans,id'
        ]);

        if (isset($data['guarantors_image'])) {
            $relativePath = $this->if($data['guarantors_image']);
            $data['guarantors_image'] = $relativePath;
        }

        return GuarantorsForm::create($validator->validated());
    }
    private function createNextOfKin($data) {
        $validator = Validator::make($data,  [
            'loan_id' => 'exists:Loans,id',
            'address' => 'required',
            'name' => 'required|string',
            'phone_no' => 'required|numeric',
            'relationship' => 'required|string',
        ]);
        return UserLoanNextOfKin::create($validator->validated());
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan, Request $request)
    {
        $user = $request->user();
        if ($user->role !== "super_admin" || $user->id !== $loan->user_id) {
            return abort(403, 'Unauthorised Action.');
        }
        return new LoanResource($loan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoanRequest  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        $data = $request->validated();

        if (isset($data['image'])) {
            $relativePath = $this->if($data['image']);
            $data['image'] = $relativePath;

            if($loan->image){
                $absolutePath = public_path($loan->image);
                File::delete($absolutePath);
            }
        }

        // return gettype((object)($data['nextOfKin']));

        // $this->updateNextOfKin((object)$data['nextOfKin']);

        $loan->update($data);
        $existingIds = $loan->guarantors()->pluck('id')->toArray();

        $newIds = Arr::pluck($data['guarantors'], 'id');

        $toDelete = array_diff($existingIds, $newIds);

        $toAdd = array_diff($newIds, $existingIds);

        GuarantorsForm::destroy($toDelete);

        

        foreach ($data['guarantors'] as $guarantor) {
            if (in_array($guarantor['id'], $toAdd)) {
                $guarantor['loan_id'] = $loan->id;
                $this->createGuarantor($guarantor);
            }
        }

        $guarantorMap = collect($data['guarantors'])->keyBy('id');

        foreach ($loan->guarantors as $guarantor) {
            if (isset($guarantorMap[$guarantor->id])) {
                $this->updateGuarantor($guarantor, $guarantorMap[$guarantor->id]);
            }
        }

        return new LoanResource($loan);


    }

    public function payLoan()
    {
        
    }
    public function returnAllPayment()
    {

    }

    private function updateGuarantor(GuarantorsForm $guarantor, $data) {

        $validator = Validator::make($data, [
            'guarantors_image' => 'required',
            'full_name' => 'required|string',
            'age' => 'required',
            'gender' => 'required', 
            'state' => 'required',
            'lga' => 'required', 
            'residential_address' => 'required', 
            'occupation' => 'required',
            'phone_no' => 'required',
            'nature_of_business' => 'required',
            'address_of_business'=> 'required',
            'relationship' => 'required',
            'loan_id' => 'exists:Loans,id'
        ]);

        if (isset($data['guarantors_image'])) {
            $relativePath = $this->if($data['guarantors_image']);
            $data['guarantors_image'] = $relativePath;
        }

        return $guarantor->update($validator->validated());
    }

    // public function updateNextOfKin($nextOfKin) {
        
    //     $validator = Validator::make($nextOfKin,  [
    //         'loan_id' => 'exists:Loans,id',
    //         'address' => 'required',
    //         'name' => 'required|string',
    //         'phone_no' => 'required|numeric',
    //         'relationship' => 'required|string',
    //     ]);

    //     // UserLoanNextOfKin

    //     // return $next->update($validator->validated());
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan, Request $request)
    {
        $user = $request->user();
        
        if($user->id !== $loan->user_id) {
            abort('Unauthorised Action', 403);
        }
        $loan->delete();

        return response('success', 204);

    }
}
