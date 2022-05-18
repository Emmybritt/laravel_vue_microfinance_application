<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use App\Http\Requests\StoreBranchesRequest;
use App\Http\Requests\UpdateBranchesRequest;
use App\Http\Resources\BranchesResource;
use Illuminate\Support\Facades\DB;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = DB::table('branches')->orderBy('created_at', 'DESC')->paginate(10);
        return BranchesResource::collection($branches);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBranchesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBranchesRequest $request)
    {
        $data = $request->validated();
        $branch = Branches::create($data);
        return new BranchesResource($branch);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branches  $branches
     * @return \Illuminate\Http\Response
     */
    public function show(Branches $branches)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBranchesRequest  $request
     * @param  \App\Models\Branches  $branches
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBranchesRequest $request, Branches $branches)
    {
        $data =  $request->validated();
        $branches->update($data);

        return new BranchesResource($branches);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branches  $branches
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branches $branches)
    {
        $branches->delete();
        return response('', 204);
    }

    public function DeleteAllBranches() {
        DB::table('branches')->delete();
        return response('deleted', 204);
    }

    public function BranchCounts() 
    {
       $branches = DB::table('branches')->count();
       return [
           'branches' => $branches,
       ];
    }
}
