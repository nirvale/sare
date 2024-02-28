<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreRdbmsVersionRequest;
// use App\Http\Requests\UpdateRdbmsVersionRequest;
use App\Models\Admin\RdbmsVersion;
use App\DataTables\Admin\Rdbms_versionsDataTable;
use Illuminate\Http\Request;
use DB;

class RdbmsVersionController extends Controller
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
          'version' => 'bail|required|unique:rdbms_versions,rdbmsversion|max:50',
          'manejador' => 'bail|required|exists:rdbms,id|max:2',
      ]);
      if ($validated->fails())
      {
        return response()->json(['errors'=>$validated->errors()->all()]);
      }
      if ($validated) {
        DB::beginTransaction();
        try {
       //  $Rdbmsversion = Rdbmsversion::find($request->id);
         $rdbmsversion=Rdbmsversion::create([
           'rdbmsversion' => strToUpper($request->version),
           'cve_rdbms' => strToUpper($request->manejador),
         ]);

         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $rdbmsversion;
   }

  /**
   * Display the specified resource.
   */
  public function show(Rdbmsversion $rdbmsversion)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Rdbmsversion $rdbmsversion)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
   public function update(Request $request, Rdbmsversion $rdbmsversion)
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
          case 'manejador':
            $datacToUpdate = 'cve_rdbms';
          break;
          case 'versión':
            $datacToUpdate = 'rdbmsversion';
          break;
          default:
            // code...
          break;
        }
        DB::beginTransaction();
        try {
       //  $Rdbmsversion = Rdbmsversion::find($request->id);
         $rdbmsversion->$datacToUpdate = strToUpper($request->catActual);

         $rdbmsversion->push();
         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $rdbmsversion;
   }

  /**
   * Remove the specified resource from storage.
   */
   public function destroy(Rdbmsversion $rdbmsversion)
   {
     //$rdbmsversion = Rdbmsversion::findOrFail($rdbmsversion->id);
     if (isset($rdbmsversion)) {
        DB::beginTransaction();
        try {
          $rdbmsversion->delete();
          // $adscripcion->delete();
          DB::commit();
        } catch (\Exception $e) {
          return $e;
        }

     }

     return $rdbmsversion->id;
   }
  public function indexdt(Rdbms_versionsDataTable $dataTable)
  {
        return $dataTable->render('admin.rdbmsversionsdt');
  }
}
