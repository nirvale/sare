<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreMprocesadorRequest;
// use App\Http\Requests\UpdateMprocesadorRequest;
use App\Models\Admin\Mprocesador;
use App\DataTables\Admin\MprocesadorsDataTable;
use Illuminate\Http\Request;
use DB;

class MprocesadorController extends Controller
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
         'mprocesador' => 'bail|required|unique:mprocesadores|max:50',
     ]);
     if ($validated->fails())
     {
       return response()->json(['errors'=>$validated->errors()->all()]);
     }
     if ($validated) {
       DB::beginTransaction();
       try {
      //  $Mprocesador = Mprocesador::find($request->id);
        $mprocesador=Mprocesador::create([

          'mprocesador' => strToUpper($request->mprocesador),

        ]);

        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $mprocesador;
  }

  /**
   * Display the specified resource.
   */
  public function show(Mprocesador $mprocesador)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Mprocesador $mprocesador)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Mprocesador $mprocesador)
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
         case 'mprocesador':
           $datacToUpdate = 'mprocesador';
         break;
         default:
           // code...
         break;
       }
       DB::beginTransaction();
       try {
      //  $Mprocesador = Mprocesador::find($request->id);
        $mprocesador->$datacToUpdate = strToUpper($request->catActual);

        $mprocesador->push();
        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $mprocesador;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Mprocesador $mprocesador)
  {
    //$mprocesador = Mprocesador::findOrFail($mprocesador->id);
    if (isset($mprocesador)) {
       DB::beginTransaction();
       try {
         $mprocesador->delete();
         // $adscripcion->delete();
         DB::commit();
       } catch (\Exception $e) {
         return $e;
       }

    }

    return $mprocesador->id;
  }

  public function indexdt(MprocesadorsDataTable $dataTable)
  {
        return $dataTable->render('admin.mprocesadorsdt');
  }
}
