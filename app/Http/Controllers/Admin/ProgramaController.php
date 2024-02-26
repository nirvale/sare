<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreProgramaRequest;
// use App\Http\Requests\UpdateProgramaRequest;
use App\Models\Admin\Programa;
use App\DataTables\Admin\ProgramasDataTable;
use Illuminate\Http\Request;
use DB;


class ProgramaController extends Controller
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
            'id' => 'bail|required|unique:programas|max:10',
            'programa' => 'bail|required|unique:programas|max:150',
            'dependencia' => 'bail|required|unique:dependencias|max:10',
        ]);
        if ($validated->fails())
        {
          return response()->json(['errors'=>$validated->errors()->all()]);
        }
        if ($validated) {
          DB::beginTransaction();
          try {
         //  $Programa = Programa::find($request->id);
           $programa=Programa::create([
             'id' => strToUpper($request->id),
             'programa' => strToUpper($request->programa),
             'cve_dependencia' => strToUpper($request->dependencia),
           ]);

           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $programa;
     }

    /**
     * Display the specified resource.
     */
    public function show(Programa $programa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Programa $programa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Programa $programa)
     {
       $validated=\Validator::make($request->all(), [
            //'empr_nombre' => 'bail|required|',
            'catOriginal' => 'bail|required|max:150',
            'catActual' => 'bail|required|max:150',
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
            case 'programa':
              $datacToUpdate = 'programa';
            break;
            case 'dependencia':
              $datacToUpdate = 'cve_dependencia';
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
         //  $Programa = Programa::find($request->id);
           $programa->$datacToUpdate = strToUpper($request->catActual);

           $programa->push();
           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $programa;
     }

     public function destroy(Programa $programa)
     {
       //$programa = Programa::findOrFail($programa->id);
       if (isset($programa)) {
          DB::beginTransaction();
          try {
            $programa->delete();
            // $adscripcion->delete();
            DB::commit();
          } catch (\Exception $e) {
            return $e;
          }

       }

       return $programa;
     }

    /**
     * Remove the specified resource from storage.
     */
     public function indexdt(ProgramasDataTable $dataTable)
     {
           return $dataTable->render('admin.programasdt');
     }
}
