<?php

namespace App\Http\Controllers;

use App\Models\Formality;
use App\Models\TypeService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class TypeServiceController extends Controller
{
	//
	use ApiResponser;

	public function index()
	{
		return $this->success(TypeService::all(['name As text', 'id As value']));
	}
	public function allByFormality($formality)
	{
		return $this->success(Formality::find($formality)->typeServices);
	}
}
