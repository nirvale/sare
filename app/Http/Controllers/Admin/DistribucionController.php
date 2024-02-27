<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreDistribucionRequest;
// use App\Http\Requests\UpdateDistribucionRequest;
use App\Models\Admin\Distribucion;
use App\DataTables\Admin\DistribucionsDataTable;
use Illuminate\Http\Request;
use DB;

class DistribucionController extends Controller
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
          'distribucion' => 'bail|required|unique:distribuciones,distribucion|max:50',
          'sistema_operativo' => 'bail|required|exists:os,id|max:1',

      ]);
      if ($validated->fails())
      {
        return response()->json(['errors'=>$validated->errors()->all()]);
      }
      if ($validated) {
        DB::beginTransaction();
        try {
       //  $Distribucion = Distribucion::find($request->id);
         $distribucion=Distribucion::create([
           'distribucion' => strToUpper($request->distribucion),
           'cve_os' => strToUpper($request->sistema_operativo),
         ]);

         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $distribucion;
   }

  /**
   * Display the specified resource.
   */
  public function show(Distribucion $distribucion)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Distribucion $distribucion)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
   public function update(Request $request, Distribucion $distribucion)
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
          case 'distribución':
            $datacToUpdate = 'distribucion';
          break;
          case 'sistema operativo':
            $datacToUpdate = 'cve_os';
          break;

          default:
            // code...
          break;
        }
        DB::beginTransaction();
        try {
       //  $Distribucion = Distribucion::find($request->id);
         $distribucion->$datacToUpdate = strToUpper($request->catActual);

         $distribucion->push();
         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $distribucion;
   }

  /**
   * Remove the specified resource from storage.
   */
   public function destroy(Distribucion $distribucion)
   {
     //$distribucion = Distribucion::findOrFail($distribucion->id);
     if (isset($distribucion)) {
        DB::beginTransaction();
        try {
          $distribucion->delete();
          // $adscripcion->delete();
          DB::commit();
        } catch (\Exception $e) {
          return $e;
        }

     }

     return $distribucion->id;
   }
  public function indexdt(DistribucionsDataTable $dataTable)
  {
        return $dataTable->render('admin.distribucionsdt');
  }
}
