<?php

namespace App\Http\Controllers\Admin;

// use App\Http\Requests\StoreAprocesadorRequest;
// use App\Http\Requests\UpdateAprocesadorRequest;
use App\Models\Admin\Aprocesador;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\AprocesadorsDataTable;
use Illuminate\Http\Request;
use DB;

class AprocesadorController extends Controller
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
         'aprocesador' => 'bail|required|unique:aprocesadores|max:50',
     ]);
     if ($validated->fails())
     {
       return response()->json(['errors'=>$validated->errors()->all()]);
     }
     if ($validated) {
       DB::beginTransaction();
       try {
      //  $Aprocesador = Aprocesador::find($request->id);
        $aprocesador=Aprocesador::create([

          'aprocesador' => strToUpper($request->aprocesador),

        ]);

        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $aprocesador;
  }

  /**
   * Display the specified resource.
   */
  public function show(Aprocesador $aprocesador)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Aprocesador $aprocesador)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Aprocesador $aprocesador)
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
         case 'aprocesador':
           $datacToUpdate = 'aprocesador';
         break;
         default:
           // code...
         break;
       }
       DB::beginTransaction();
       try {
      //  $Aprocesador = Aprocesador::find($request->id);
        $aprocesador->$datacToUpdate = strToUpper($request->catActual);

        $aprocesador->push();
        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $aprocesador;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Aprocesador $aprocesador)
  {
    //$aprocesador = Aprocesador::findOrFail($aprocesador->id);
    if (isset($aprocesador)) {
       DB::beginTransaction();
       try {
         $aprocesador->delete();
         // $adscripcion->delete();
         DB::commit();
       } catch (\Exception $e) {
         return $e;
       }

    }

    return $aprocesador->id;
  }

  public function indexdt(AprocesadorsDataTable $dataTable)
  {
        return $dataTable->render('admin.aprocesadorsdt');
  }
}
