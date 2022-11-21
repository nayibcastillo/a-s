<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(Department::orderBy('name', 'DESC')->get(['name As text', 'id As value']));
    }

      public function paginate()
    {
        return $this->success(
            Department::orderBy('name')
                ->when(request()->get('name'), function ($q, $fill) {
                    $q->where('name', 'like', '%' . $fill . '%');
                })
                ->paginate(request()->get('pageSize', 10), ['*'], 'page', request()->get('page', 1))
        );
    }

    public function show($country_id)
    {
        return $this->success( Department::where('country_id', $country_id)
                                    ->orderBy('name', 'asc')
                                    ->when(request()->get('name'), function ($q, $fill){
                                        $q->where('name', 'like', '%'.$fill.'%');
                                    })
                                    ->paginate(request()->get('pageSize', 10), ['*'], 'page', request()->get('page', 1)));
                                    //->get(['name as text', 'id as value']);
    }

    /**
     * Esta función sirve para crear y actualizar
     */
    public function store(Request $request)
    {
        try {
            Department::create($request->all());
            return $this->success('creacion exitosa');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 200);
        }
    }
}
