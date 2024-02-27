<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreVirtualizadorRequest;
// use App\Http\Requests\UpdateVirtualizadorRequest;
use App\Models\Admin\Virtualizador;
use App\DataTables\Admin\VirtualizadorsDataTable;
use Illuminate\Http\Request;
use DB;


class VirtualizadorController extends Controller
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
         'virtualizador' => 'bail|required|unique:virtualizadores|max:50',
     ]);
     if ($validated->fails())
     {
       return response()->json(['errors'=>$validated->errors()->all()]);
     }
     if ($validated) {
       DB::beginTransaction();
       try {
      //  $Virtualizador = Virtualizador::find($request->id);
        $virtualizador=Virtualizador::create([

          'virtualizador' => strToUpper($request->virtualizador),

        ]);

        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $virtualizador;
  }

  /**
   * Display the specified resource.
   */
  public function show(Virtualizador $virtualizador)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Virtualizador $virtualizador)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Virtualizador $virtualizador)
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
         case 'virtualizador':
           $datacToUpdate = 'virtualizador';
         break;
         default:
           // code...
         break;
       }
       DB::beginTransaction();
       try {
      //  $Virtualizador = Virtualizador::find($request->id);
        $virtualizador->$datacToUpdate = strToUpper($request->catActual);

        $virtualizador->push();
        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $virtualizador;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Virtualizador $virtualizador)
  {
    //$virtualizador = Virtualizador::findOrFail($virtualizador->id);
    if (isset($virtualizador)) {
       DB::beginTransaction();
       try {
         $virtualizador->delete();
         // $adscripcion->delete();
         DB::commit();
       } catch (\Exception $e) {
         return $e;
       }

    }

    return $virtualizador->id;
  }

  public function indexdt(VirtualizadorsDataTable $dataTable)
  {
        return $dataTable->render('admin.virtualizadorsdt');
  }
}
