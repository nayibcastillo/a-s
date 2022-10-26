<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubTypeAppointmentResource;
use App\Models\SubTypeAppointment;
use App\Models\TypeAppointment;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class SubTypeAppointmentController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($typeAppointment = '')
    {
        if ($typeAppointment != 'undefined' || is_numeric($typeAppointment)) {
            return  SubTypeAppointmentResource::collection(TypeAppointment::with('subTypeAppointment')->find($typeAppointment)['subTypeAppointment']);
        }
    }

    public function paginate() 
    {
        return $this->success(
            SubTypeAppointment::orderBy('name')
            ->paginate(request()->get('pageSize', 10), ['*'], 'page', request()->get('page', 1))
        );
    }

    /**
     * Show the form for creating a new resource.
     *k
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
     * @param  \App\SubTypeAppointment  $subTypeAppointment
     * @return \Illuminate\Http\Response
     */
    public function show(SubTypeAppointment $subTypeAppointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubTypeAppointment  $subTypeAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(SubTypeAppointment $subTypeAppointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubTypeAppointment  $subTypeAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubTypeAppointment $subTypeAppointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubTypeAppointment  $subTypeAppointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubTypeAppointment $subTypeAppointment)
    {
        //
    }
}
