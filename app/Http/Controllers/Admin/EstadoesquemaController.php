<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreEstadoesquemaRequest;
// use App\Http\Requests\UpdateEstadoesquemaRequest;
use App\Models\Admin\Estadoesquema;
use App\DataTables\Admin\EstadoesquemasDataTable;
use Illuminate\Http\Request;
use DB;


class EstadoesquemaController extends Controller
{
  public function __construct(Request $request)
    {
        $this->middleware(['permission:admin|adming']);
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
            'estadoesquema' => 'bail|required|unique:estadoesquemas|max:50',
        ]);
        if ($validated->fails())
        {
          return response()->json(['errors'=>$validated->errors()->all()]);
        }
        if ($validated) {
          DB::beginTransaction();
          try {
         //  $Estadoesquema = Estadoesquema::find($request->id);
           $estadoesquema=Estadoesquema::create([

             'estadoesquema' => strToUpper($request->estadoesquema),

           ]);

           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $estadoesquema;
     }

     /**
      * Display the specified resource.
      */
     public function show(Estadoesquema $estadoesquema)
     {
         //
     }

     /**
      * Show the form for editing the specified resource.
      */
     public function edit(Estadoesquema $estadoesquema)
     {
         //
     }

     /**
      * Update the specified resource in storage.
      */
     public function update(Request $request, Estadoesquema $estadoesquema)
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
            case 'estadoesquema':
              $datacToUpdate = 'estadoesquema';
            break;
            default:
              // code...
            break;
          }
          DB::beginTransaction();
          try {
         //  $Estadoesquema = Estadoesquema::find($request->id);
           $estadoesquema->$datacToUpdate = strToUpper($request->catActual);

           $estadoesquema->push();
           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $estadoesquema;
     }

     /**
      * Remove the specified resource from storage.
      */
     public function destroy(Estadoesquema $estadoesquema)
     {
       //$estadoesquema = Estadoesquema::findOrFail($estadoesquema->id);
       if (isset($estadoesquema)) {
          DB::beginTransaction();
          try {
            $estadoesquema->delete();
            // $adscripcion->delete();
            DB::commit();
          } catch (\Exception $e) {
            return $e;
          }

       }

       return $estadoesquema->id;
     }
    public function indexdt(EstadoesquemasDataTable $dataTable)
    {
          return $dataTable->render('admin.estadoesquemasdt');
    }
}
