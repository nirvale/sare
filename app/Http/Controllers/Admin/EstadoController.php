<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreEstadoRequest;
// use App\Http\Requests\UpdateEstadoRequest;
use App\Models\Admin\Estado;
use App\DataTables\Admin\EstadosDataTable;
use Illuminate\Http\Request;
use DB;


class EstadoController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(['permission:admin|admin']);
    }
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
            'estado' => 'bail|required|unique:estados|max:50',
            'id' => 'bail|required|unique:estados|max:1',
        ]);
        if ($validated->fails())
        {
          return response()->json(['errors'=>$validated->errors()->all()]);
        }
        if ($validated) {
          DB::beginTransaction();
          try {
         //  $Estado = Estado::find($request->id);
           $estado=Estado::create([

             'id' => strToUpper($request->id),
             'estado' => strToUpper($request->estado),

           ]);

           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $estado;
     }

    /**
     * Display the specified resource.
     */
    public function show(Estado $estado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estado $estado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Estado $estado)
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
            case 'estado':
              $datacToUpdate = 'estado';
            break;
            default:
              // code...
            break;
          }
          DB::beginTransaction();
          try {
         //  $Estado = Estado::find($request->id);
           $estado->$datacToUpdate = strToUpper($request->catActual);

           $estado->push();
           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $estado;
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estado $estado)
    {
     //$estado = Estado::findOrFail($estado->id);
     if (isset($estado)) {
        DB::beginTransaction();
        try {
          $estado->delete();
          // $adscripcion->delete();
          DB::commit();
        } catch (\Exception $e) {
          return $e;
        }

     }

     return $estado->id;
    }
    public function indexdt(EstadosDataTable $dataTable)
    {
         return $dataTable->render('admin.estadosdt');
    }
}
