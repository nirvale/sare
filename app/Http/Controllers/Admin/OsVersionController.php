<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreOsVersionRequest;
// use App\Http\Requests\UpdateOsVersionRequest;
use App\Models\Admin\OsVersion;
use App\DataTables\Admin\Os_versionsDataTable;
use Illuminate\Http\Request;
use DB;

class OsVersionController extends Controller
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
          'version' => 'bail|required|unique:os_versions,osversion|max:50',
          'distribucion' => 'bail|required|exists:distribuciones,id|max:2',
      ]);
      if ($validated->fails())
      {
        return response()->json(['errors'=>$validated->errors()->all()]);
      }
      if ($validated) {
        DB::beginTransaction();
        try {
       //  $Osversion = Osversion::find($request->id);
         $osversion=Osversion::create([
           'osversion' => strToUpper($request->version),
           'cve_distribucion' => strToUpper($request->distribucion),
         ]);

         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $osversion;
   }

  /**
   * Display the specified resource.
   */
  public function show(Osversion $osversion)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Osversion $osversion)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
   public function update(Request $request, Osversion $osversion)
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
          case 'distribucion':
            $datacToUpdate = 'cve_distribucion';
          break;
          case 'version':
            $datacToUpdate = 'osversion';
          break;
          default:
            // code...
          break;
        }
        DB::beginTransaction();
        try {
       //  $Osversion = Osversion::find($request->id);
         $osversion->$datacToUpdate = strToUpper($request->catActual);

         $osversion->push();
         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $osversion;
   }

  /**
   * Remove the specified resource from storage.
   */
   public function destroy(Osversion $osversion)
   {
     //$osversion = Osversion::findOrFail($osversion->id);
     if (isset($osversion)) {
        DB::beginTransaction();
        try {
          $osversion->delete();
          // $adscripcion->delete();
          DB::commit();
        } catch (\Exception $e) {
          return $e;
        }

     }

     return $osversion->id;
   }
  public function indexdt(Os_versionsDataTable $dataTable)
  {
        return $dataTable->render('admin.osversionsdt');
  }
}
