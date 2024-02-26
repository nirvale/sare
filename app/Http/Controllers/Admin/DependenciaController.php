<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreDependenciaRequest;
// use App\Http\Requests\UpdateDependenciaRequest;
use App\Models\Admin\Dependencia;
use App\DataTables\Admin\DependenciasDataTable;
use Illuminate\Http\Request;
use DB;


class DependenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
     {
       $validated=\Validator::make($request->all(), [
            //'empr_nombre' => 'bail|required|',
            'dependencia' => 'bail|required|unique:dependencias|max:50',
            'id' => 'bail|required|unique:dependencias|max:50',
        ]);
        if ($validated->fails())
        {
          return response()->json(['errors'=>$validated->errors()->all()]);
        }
        if ($validated) {
          DB::beginTransaction();
          try {
         //  $Dependencia = Dependencia::find($request->id);
           $dependencia=Dependencia::create([

              'id' => strToUpper($request->id),
              'dependencia' => strToUpper($request->dependencia),

           ]);

           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $dependencia;
     }

    /**
     * Display the specified resource.
     */
    public function show(Dependencia $dependencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dependencia $dependencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Dependencia $dependencia)
     {

       $validated=\Validator::make($request->all(), [
            //'empr_nombre' => 'bail|required|',
            'catOriginal' => 'bail|required|max:50',
            'catActual' => 'bail|required|max:50',
            //'empeval_fotos.*.file' => 'required|mimes:jpeg,jpg,png|max: 20000',
            // 'cve_oficina' => 'bail|required|max:1',
            // 'id_perfil' => 'bail|required|max:2',
            // 'cve_estado' => 'bail|required|max:1',
            // 'email' => 'bail|required|email:rfc,dns',
            // 'pwd' => 'bail|required|max:10',
        ]);
        if ($validated->fails())
        {
          return response()->json(['errors'=>$validated->errors()->all()]);
        }
        if ($validated) {
          switch ($request->thead) {
            case 'dependencia':
              $datacToUpdate = 'dependencia';
            break;
            case 'id':
              $datacToUpdate = 'id';
            break;
            default:
              // code...
            break;
          }
          DB::beginTransaction();
          try {
         //  $Dependencia = Dependencia::find($request->id);
           $dependencia->$datacToUpdate = strToUpper($request->catActual);

           $dependencia->push();
           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $dependencia;
     }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Dependencia $dependencia)
     {
       //$dependencia = Dependencia::findOrFail($dependencia->id);
       if (isset($dependencia)) {
          DB::beginTransaction();
          try {
            $dependencia->delete();
            // $adscripcion->delete();
            DB::commit();
          } catch (\Exception $e) {
            return $e;
          }

       }

       return $dependencia;
     }


    public function indexdt(DependenciasDataTable $dataTable)
    {
          return $dataTable->render('admin.dependenciasdt');
    }
}
