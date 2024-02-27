<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreTipoRequest;
// use App\Http\Requests\UpdateTipoRequest;
use App\Models\Admin\Tipo;
use App\DataTables\Admin\TiposDataTable;
use Illuminate\Http\Request;
use DB;


class TipoController extends Controller
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
         'tipo' => 'bail|required|unique:tipos|max:50',
     ]);
     if ($validated->fails())
     {
       return response()->json(['errors'=>$validated->errors()->all()]);
     }
     if ($validated) {
       DB::beginTransaction();
       try {
      //  $Tipo = Tipo::find($request->id);
        $tipo=Tipo::create([

          'tipo' => strToUpper($request->tipo),

        ]);

        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $tipo;
  }

  /**
   * Display the specified resource.
   */
  public function show(Tipo $tipo)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Tipo $tipo)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Tipo $tipo)
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
         case 'tipo':
           $datacToUpdate = 'tipo';
         break;
         default:
           // code...
         break;
       }
       DB::beginTransaction();
       try {
      //  $Tipo = Tipo::find($request->id);
        $tipo->$datacToUpdate = strToUpper($request->catActual);

        $tipo->push();
        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $tipo;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Tipo $tipo)
  {
    //$tipo = Tipo::findOrFail($tipo->id);
    if (isset($tipo)) {
       DB::beginTransaction();
       try {
         $tipo->delete();
         // $adscripcion->delete();
         DB::commit();
       } catch (\Exception $e) {
         return $e;
       }

    }

    return $tipo->id;
  }

  public function indexdt(TiposDataTable $dataTable)
  {
        return $dataTable->render('admin.tiposdt');
  }
}
