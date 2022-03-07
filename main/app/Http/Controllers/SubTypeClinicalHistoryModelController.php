<?php

namespace App\Http\Controllers;

use App\SubTypeClinicalHistoryModel;
use App\ClinicalHistoryModel;
use Illuminate\Http\Request;

class SubTypeClinicalHistoryModelController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forSelect()
    {
         try {
            $clinicalHistoryModel = ClinicalHistoryModel::find(request()->input('id'))->subTypeClinicalHistoryModel()->get(['name as text', 'id as value']);
            return response()->success($clinicalHistoryModel);
        } catch (\Throwable $th) {
            return response()->error($th->getMessage(), 400);
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubTypeClinicalHistoryModel  $subTypeClinicalHistoryModel
     * @return \Illuminate\Http\Response
     */
    public function show(SubTypeClinicalHistoryModel $subTypeClinicalHistoryModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubTypeClinicalHistoryModel  $subTypeClinicalHistoryModel
     * @return \Illuminate\Http\Response
     */
    public function edit(SubTypeClinicalHistoryModel $subTypeClinicalHistoryModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubTypeClinicalHistoryModel  $subTypeClinicalHistoryModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubTypeClinicalHistoryModel $subTypeClinicalHistoryModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubTypeClinicalHistoryModel  $subTypeClinicalHistoryModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubTypeClinicalHistoryModel $subTypeClinicalHistoryModel)
    {
        //
    }
}
