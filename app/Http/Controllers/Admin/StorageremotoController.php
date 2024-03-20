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
          'sistema' => 'bail|required|unique:storageremotos,storageremoto|max:50',
          'tecnologia' => 'bail|required|exists:tecremotadiscos,id|max:2',
          'fabricante' => 'bail|required|exists:mhardwares,id|max:2',
          'utilidades_soportadas.*' => 'bail|required|exists:udremotas,id|max:2',
          'datacenter' => 'bail|required|exists:datacenters,id|max:2',
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
        $multi=0; //variable para definir syncronizacion select multiple
        switch ($request->thead) {
          case 'sistema':
            $datacToUpdate = 'storageremoto';
          break;
          case 'tecnología':
            $datacToUpdate = 'cve_tecremotadisco';
          break;
          case 'fabricante':
            $datacToUpdate = 'cve_mhardware';
          break;
          case 'utilidades soportadas':
            $multi=1;
             $datacToUpdate = 'id';
             $storageremoto->udremotas()->sync(json_decode($request->catActual));
          break;
          case 'datacenter':
            $datacToUpdate = 'cve_datacenter';
          break;
          case 'capacidad (gb)':
            $datacToUpdate = 'capacidad';
            $nup=($storageremoto->usado/$request->catActual)*100;
            //dd($nup);
            DB::beginTransaction();
            try {
             $storageremoto->usadop = $nup;
             $storageremoto->push();
             DB::commit();
            } catch (\Exception $e) {
              DB::rollBack();
              return $e;
            }
          break;
          case 'usado (gb)':
            $datacToUpdate = 'usado';
            $nup=($request->catActual/$storageremoto->capacidad)*100;
            //dd($nup);
            DB::beginTransaction();
            try {
             $storageremoto->usadop = $nup;
             $storageremoto->push();
             DB::commit();
            } catch (\Exception $e) {
              DB::rollBack();
              return $e;
            }
          break;
          default:
            // code...
          break;
        }
        if ($multi==0) {
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
