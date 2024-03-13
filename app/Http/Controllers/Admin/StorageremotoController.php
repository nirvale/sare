<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreStorageremotoRequest;
// use App\Http\Requests\UpdateStorageremotoRequest;
use App\Models\Admin\Storageremoto;
use App\DataTables\Admin\StorageremotosDataTable;
use Illuminate\Http\Request;
use DB;

class StorageremotoController extends Controller
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
          'version' => 'bail|required|unique:rdbms_versions,storageremoto|max:50',
          'manejador' => 'bail|required|exists:rdbms,id|max:2',
      ]);
      if ($validated->fails())
      {
        return response()->json(['errors'=>$validated->errors()->all()]);
      }
      if ($validated) {
        DB::beginTransaction();
        try {
       //  $Storageremoto = Storageremoto::find($request->id);
         $storageremoto=Storageremoto::create([
           'storageremoto' => strToUpper($request->version),
           'cve_rdbms' => strToUpper($request->manejador),
         ]);

         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $storageremoto;
   }

  /**
   * Display the specified resource.
   */
  public function show(Storageremoto $storageremoto)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Storageremoto $storageremoto)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
   public function update(Request $request, Storageremoto $storageremoto)
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
            $datacToUpdate = 'storageremoto';
          break;
          default:
            // code...
          break;
        }
        DB::beginTransaction();
        try {
       //  $Storageremoto = Storageremoto::find($request->id);
         $storageremoto->$datacToUpdate = strToUpper($request->catActual);

         $storageremoto->push();
         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $storageremoto;
   }

  /**
   * Remove the specified resource from storage.
   */
   public function destroy(Storageremoto $storageremoto)
   {
     //$storageremoto = Storageremoto::findOrFail($storageremoto->id);
     if (isset($storageremoto)) {
        DB::beginTransaction();
        try {
          $storageremoto->delete();
          // $adscripcion->delete();
          DB::commit();
        } catch (\Exception $e) {
          return $e;
        }

     }

     return $storageremoto->id;
   }
  public function indexdt(StorageremotosDataTable $dataTable)
  {
        return $dataTable->render('admin.storageremotosdt');
  }
}
