<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreCompartidodiscoRequest;
// use App\Http\Requests\UpdateLocaldiscoRequest;
use App\Models\Admin\Compartidodisco;
use App\DataTables\Admin\CompartidodiscosDataTable;
use Illuminate\Http\Request;
use DB;
use App\Models\Admin\Storageremoto;

class CompartidodiscoController extends Controller
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
          // 'version' => 'bail|required|unique:os_versions,compartidodisco|max:50',
          // 'distribucion' => 'bail|required|exists:distribuciones,id|max:2',
          'disco' => 'bail|required|max:15',
          'tipo' => 'bail|required|exists:udremotas,id|max:2',
          'storage' => 'bail|required|exists:storageremotos,id|max:2',
          'servidor' => 'bail|required|exists:servidores,id|max:2',
          'montaje' => 'bail|required|max:50',
          'capacidad_gb' => 'bail|required|numeric|between:0,999000',
          'usado_gb' => 'bail|required|numeric|lt:capacidad_gb',
          'formato' => 'bail|required|exists:dformatos,id|max:2',
          'comandos' => 'bail|required',

      ]);
      if ($validated->fails())
      {
        return response()->json(['errors'=>$validated->errors()->all()]);
      }
      if ($validated) {
        DB::beginTransaction();
        try {
       //  $Compartidodisco = Compartidodisco::find($request->id);
         $compartidodisco=Compartidodisco::create([
           'compartidodisco' => $request->disco,
           'cve_udremota' => $request->tipo,
           'cve_storageremoto' => $request->storage,
           'cve_servidor' => $request->servidor,
           'pmontaje' => $request->montaje,
           'capacidad' => $request->capacidad_gb,
           'usado' => $request->usado_gb,
           'usadop' => ($request->usado_gb / $request->capacidad_gb) *100,
           'cve_dformato' => $request->formato,
           'comontaje' => $request->comandos,
           'descripcion' => $request->descripcion,
         ]);
         $storageremoto=Storageremoto::findOrFail($compartidodisco->cve_storageremoto);
         $storageremoto->usado = $storageremoto->usado+$request->capacidad_gb;
         $storageremoto->usadop = ($storageremoto->usado/$storageremoto->capacidad)*100;
         $storageremoto->push();

         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $compartidodisco;
   }

  /**
   * Display the specified resource.
   */
  public function show(Compartidodisco $compartidodisco)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Compartidodisco $compartidodisco)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
   public function update(Request $request, Compartidodisco $compartidodisco)
   {
     $validated=\Validator::make($request->all(), [
          //'empr_nombre' => 'bail|required|',
          'catOriginal' => 'bail|required|max:350',
          'catActual' => 'bail|required|max:350',
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
          case 'disco':
            $datacToUpdate = 'compartidodisco';
          break;
          case 'tipo':
            $datacToUpdate = 'cve_udremota';
          break;
          case 'storage':
            $datacToUpdate = 'cve_storageremoto';
            $storageremoto=Storageremoto::findOrFail($compartidodisco->cve_storageremoto);
            $storageremoton=Storageremoto::findOrFail($request->catActual);
            DB::beginTransaction();
            try {
             $storageremoto->usado = $storageremoto->usado-$compartidodisco->capacidad;
             $storageremoto->usadop = ($storageremoto->usado/$storageremoto->capacidad)*100;
             $storageremoto->push();
             $storageremoton->usado = $storageremoton->usado + $compartidodisco->capacidad;
             $storageremoton->usadop = ($storageremoton->usado/$storageremoton->capacidad)*100;
             $storageremoton->push();

             DB::commit();
            } catch (\Exception $e) {
              DB::rollBack();
              return $e;
            }

          break;
          case 'servidor':
            $datacToUpdate = 'cve_servidor';
          break;
          case 'montaje':
            $datacToUpdate = 'montaje';
          break;
          case 'capacidad_gb':
            $datacToUpdate = 'capacidad';
            $storageremoto=Storageremoto::findOrFail($compartidodisco->cve_storageremoto);

            DB::beginTransaction();
            try {
             $compartidodisco->usadop = ($compartidodisco->usado/$request->catActual)*100;
             $compartidodisco->push();
             $storageremoto->usado = $storageremoto->usado-$request->catOriginal+$request->catActual;
             $storageremoto->usadop = ($storageremoto->usado/$storageremoto->capacidad)*100;
             $storageremoto->push();
             DB::commit();
            } catch (\Exception $e) {
              DB::rollBack();
              return $e;
            }
          break;
          case 'usado_gb':
            $datacToUpdate = 'usado';

            DB::beginTransaction();
            try {
             $compartidodisco->usadop = ($request->catActual/$compartidodisco->capacidad)*100;
             $compartidodisco->push();
             DB::commit();
            } catch (\Exception $e) {
              DB::rollBack();
              return $e;
            }
          break;
          case 'formato':
            $datacToUpdate = 'cve_dformato';
          break;
          case 'comandos':
            $datacToUpdate = 'comontaje';
          break;
          case 'descripcion':
            $datacToUpdate = 'descripcion';
          break;
          default:
            // code...
          break;
        }
        DB::beginTransaction();
        try {
       //  $Compartidodisco = Compartidodisco::find($request->id);
         $compartidodisco->$datacToUpdate = $request->catActual;

         $compartidodisco->push();
         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $compartidodisco;
   }

  /**
   * Remove the specified resource from storage.
   */
   public function destroy(Compartidodisco $compartidodisco)
   {
     //$compartidodisco = Compartidodisco::findOrFail($compartidodisco->id);
     if (isset($compartidodisco)) {
        DB::beginTransaction();
        try {
          $compartidodisco->delete();
          // $adscripcion->delete();
          DB::commit();
        } catch (\Exception $e) {
          return $e;
        }

     }

     return $compartidodisco->id;
   }
  public function indexdt(CompartidodiscosDataTable $dataTable)
  {
        return $dataTable->render('admin.compartidodiscosdt');
  }
}
