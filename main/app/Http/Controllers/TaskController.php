<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\DB;
use JsonIncrementalParser;

class TaskController extends Controller
{
    use ApiResponser;
    public function getData()
    {
        /* $task = DB::table('task')->get();
        return $task; */
        return $this->success(Task::get());
    }

    public function personTask($id)
    {
        $task = DB::table('tasks')
            ->join('people', 'tasks.id_asignador', '=', 'people.id')
            ->where('id_realizador', $id)
            ->get(['tasks.*', 'people.first_name', 'people.second_name', 'people.first_surname']);
        return $this->success($task);
    }

    public function person($companyId)
    {
        $person = DB::table('people')
            ->where('company_id', $companyId)
            ->get(['id', DB::raw('CONCAT_WS(" ",first_name,second_name,first_surname) as name ')]);
        return $this->success($person);
    }

    public function personTaskFor($id)
    {
        $task = DB::table('tasks')
            ->join('people', 'tasks.id_realizador', '=', 'people.id')
            ->where('id_asignador', $id)
            ->get(['tasks.*', 'people.first_name', 'people.second_name', 'people.first_surname']);
        return $this->success($task);
    }

    public function personTaskPendientes($personId)
    {
        $task = DB::table('tasks')
            ->join('people', 'tasks.id_asignador', '=', 'people.id')
            ->where('id_realizador', $personId)
            ->where('estado', 'Pendiente')
            ->get(['tasks.*', 'people.first_name', 'people.second_name', 'people.first_surname']);
        return $this->success($task);
    }

    public function personTaskEjecucion($personId)
    {
        $task = DB::table('tasks')
            ->join('people', 'tasks.id_asignador', '=', 'people.id')
            ->where('id_realizador', $personId)
            ->where('estado', 'En ejecucion')
            ->get(['tasks.*', 'people.first_name', 'people.second_name', 'people.first_surname']);
        return $this->success($task);
    }

    public function personTaskEspera($personId)
    {
        $task = DB::table('tasks')
            ->join('people', 'tasks.id_asignador', '=', 'people.id')
            ->where('id_realizador', $personId)
            ->where('estado', 'En espera')
            ->get(['tasks.*', 'people.first_name', 'people.second_name', 'people.first_surname']);
        return $this->success($task);
    }

    public function personTaskFinalizado($personId)
    {
        $task = DB::table('tasks')
            ->join('people', 'tasks.id_asignador', '=', 'people.id')
            ->where('id_realizador', $personId)
            ->where('estado', 'Finalizado')
            ->get(['tasks.*', 'people.first_name', 'people.second_name', 'people.first_surname']);
        return $this->success($task);
    }

    public function updateFinalizado($id)
    {
        DB::table('tasks')
            ->where('id', $id)
            ->update(['estado' => "Finalizado"]);
    }
    public function updatePendiente($id)
    {
        DB::table('tasks')
            ->where('id', $id)
            ->update(['estado' => "Pendiente"]);
    }
    public function updateEjecucion($id)
    {
        DB::table('tasks')
            ->where('id', $id)
            ->update(['estado' => "En ejecucion"]);
    }
    public function updateEspera($id)
    {
        DB::table('tasks')
            ->where('id', $id)
            ->update(['estado' => "En espera"]);
    }

    public function taskView($id)
    {
        $task = DB::table('tasks')
            ->join('people', 'tasks.id_realizador', '=', 'people.id')
            ->where('tasks.id', $id)
            ->get(['tasks.*', 'people.first_name', 'people.second_name', 'people.first_surname']);
        return $this->success($task);
    }
    public function newTask($task)
    {
        $datos = json_decode($task);
        $link = str_replace('_', '/', $datos->{'link'});
        /* return $this->success($datos); */
        DB::table('tasks')
            ->insert([
                'id_realizador' => $datos->{'id_realizador'},
                'tipo' => $datos->{'tipo'},
                'titulo' => $datos->{'titulo'},
                'descripcion' => $datos->{'descripcion'},
                'fecha' => $datos->{'fecha'},
                'adjuntos' => $datos->{'adjuntos'},
                'link' => $link,
                'id_asignador' => $datos->{'id_asignador'},
                'hora' => $datos->{'hora'},
                'estado' => $datos->{'estado'},
            ]);
    }

    public function upload(Request $request)
    {
        header('Access-Control-Allow-Origin: *');

        $image = $request->file('image');

        if ($image) {
            $image_path = $image->getClientOriginalName();
        }
        $data = array(

            'image' => $image,
            'status' => 'success'
        );
        return response()->json($data, 200);
    }
    // agregar tarea -- obtener tareas asignadas -- editar tareas asignadas -- 
}


