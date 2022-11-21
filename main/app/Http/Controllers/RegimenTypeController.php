<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\RegimenType;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class RegimenTypeController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(RegimenType::get(['name As text', 'id As value']));
    }

    public function paginate()
    {
        return $this->success(
            RegimenType::when(request()->get('name'), function ($q, $fill) {
                $q->where('name', 'like', '%' . $fill . '%');
            })->when(request()->get('code'), function ($q, $fill) {
                $q->where('code', 'like', '%' . $fill . '%');
            })->paginate(request()->get('pageSize', 10), ['*'], 'page', request()->get('page', 1))
        );
    }

    public function regimenesConNiveles($id)
    {
        return $this->success(
            Level::where('regimen_id', $id)
            ->when(request()->get('name'), function ($q, $fill) {
                $q->where('name', 'like', '%' . $fill . '%');
            })
            ->when(request()->get('code'), function ($q, $fill) {
                $q->where('code', 'like', '%' . $fill . '%' );
            })
            ->when(request()->get('cuote'), function ($q, $fill) {
                $q->where('cuote', 'like', '%' . $fill . '%' );
            })->paginate(request()->get('pageSize', 5), ['*'], 'page', request()->get('page', 1)));
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
     * @param  \App\Models\RegimenType  $regimenType
     * @return \Illuminate\Http\Response
     */
    public function show(RegimenType $regimenType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RegimenType  $regimenType
     * @return \Illuminate\Http\Response
     */
    public function edit(RegimenType $regimenType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RegimenType  $regimenType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RegimenType $regimenType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RegimenType  $regimenType
     * @return \Illuminate\Http\Response
     */
    public function destroy(RegimenType $regimenType)
    {
        //
    }
}
