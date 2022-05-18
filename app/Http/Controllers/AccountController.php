<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\AccountResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Transactions;



class AccountController extends Controller
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
            $accounts = DB::table('accounts')->orderBy('created_at', 'DESC')->paginate(5);
        }
        else{
            $accounts = DB::table('accounts')->where('user_id', '=', $user->id)->paginate(5);
        }
        
        return response([
            'accounts' => $accounts,
        ]);
    }

    // This is method gets all accounts in the database
    public function AllAccounts(Request $request) {
        $user = $request->user();
        if ($user->role == 'super_admin') {
            $total_accounts = DB::table('accounts')->orderBy('created_at', 'DESC')->paginate(30);
        }else {
            $total_accounts = DB::table('accounts')->orderBy('created_at', 'DESC')->where('user_id', '=', $user->id)->paginate(30);
        }
        

        return response([
            'total_accounts' => $total_accounts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountRequest $request)
    {
        $account = $request->validated();

        $lastAccountNumber = DB::table('accounts')->latest()->first();

        if (empty($lastAccountNumber->account_number)) {
            $incrementedAccountNumber = 3000000001;
        }else{
            $incrementedAccountNumber = $lastAccountNumber->account_number + 1;
        }


        // var_dump($lastAccountNumber);

        
        $account['account_number'] = $incrementedAccountNumber;

        if (isset($account['image'])) {
            $relativePath = $this->saveImage($account['image']);
            $account['image'] = $relativePath;
        }
        $account = Account::create($account);
        
        return new AccountResource($account);

        
    }

    public function searchAccounts(Request $request, $details) {
        $user = $request->user();
        if ($user->role == 'super_admin') {
            $result = DB::table('accounts')->
            where('account_name', 'LIKE', '%'. $details . '%')
            ->orWhere('other_name', 'LIKE', '%'. $details.'%')
            ->orWhere('account_number', 'LIKE', '%'. $details.'%')
            ->orWhere('email_address', 'LIKE', '%'. $details.'%')
            ->orWhere('phone_number', 'LIKE', '%'. $details.'%')
            ->orWhere('account_type', 'LIKE', '%'. $details.'%')
            ->paginate(30);

        }else{
            $result = DB::table('accounts')->
            where('account_name', 'LIKE', '%'. $details . '%')
            ->orWhere('other_name', 'LIKE', '%'. $details.'%')
            ->orWhere('account_number', 'LIKE', '%'. $details.'%')
            ->orWhere('email_address', 'LIKE', '%'. $details.'%')
            ->orWhere('phone_number', 'LIKE', '%'. $details.'%')
            ->orWhere('account_type', 'LIKE', '%'. $details.'%')
            ->paginate(30);
        }
        
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account, Request $request)
    {
        $user = $request->user();
        $account_id = (int)$account->user_id;
        if ($user->role !== 'super_admin' || $user->id !== $account_id) {
            return abort(403, 'Unauthorised action');
        }
        // return response([
        //     'registered_by' => $this->user,
        // ]);

        return new AccountResource($account);
    }

    public function GetAccountDetail(Request $request, $account_number) {
        // var_dump($account_number);
        $account_num = (int) $account_number;
        // var_dump($account_num);
        $account_detail = DB::table('accounts')->where('account_number', 'LIKE', '%' .$account_num. '%')->get();

        return response([
            'account_details' => $account_detail,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountRequest  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        $data = $request->validated();

        if (isset($data['image'])) {
            $relativePath = $this->if($data['image']);
            $data['image'] = $relativePath;

            // If There is an old image
            if ($data->image) {
                $absolutePath = public_path($data->image);
                File::delete($absolutePath);
            }
        }

        $account->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account, Request $request)
    {
        $user = $request->user();
        $account_id = (int)$account->user_id;
        if ($user->role !== 'super_admin' || $user->id !== $account_id) {
            return abort(403, 'Unauthorised action');
        }

        $account->delete();
        
        if ($account->image) {
            $absolutePath = public_path($account->image);
            File::delete($absolutePath);
        }

        $role = $user->role;
        

        return response([
            'role' => $role,
            'message' => 'success',
            'id' => $user->id,
            'user_id' => $account_id
        ]);
    }

    public function AcountTransactions($id) {
        $num_id = (int)$id;
        // var_dump(gettype($num_id));
        $account_trans = DB::table('transactions')->where('account_id', '=', $num_id)->get();

        return response([
            'account_trans' => $account_trans,
        ]);
    }

    protected function saveImage($image)
    {
        // check if the image is a valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            
            // Take out the base64 encoded text without mime type
            $image = substr($image, strpos($image, ',') + 1);

            // get the file extension
            $type = strtolower($type[1]);

            // Check if file is an image
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        }else{
            throw new \Exception('Did not match data URI with image data');
        }
        $dir = 'images/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }

        file_put_contents($relativePath, $image);
        return $relativePath;
    }

    private function if($image){
        if(preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            $image = substr($image, strpos($image, ',') + 1);

            $type = strtolower($type[1]);

            if (!in_array($type, ['jpeg', 'jpg', 'png', 'gif'])) {
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

        $dir = 'images/';
        $file = Str::random() . '.' .$type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }

    public function getAccountsCount() {
       $accountsCount =  DB::table('accounts')->count();

       return response([
           'accountsCount' => $accountsCount
       ]);
    }
}
