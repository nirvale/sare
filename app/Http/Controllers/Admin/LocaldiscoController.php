<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreLocaldiscoRequest;
// use App\Http\Requests\UpdateLocaldiscoRequest;
use App\Models\Admin\Localdisco;
use App\DataTables\Admin\LocaldiscosDataTable;
use Illuminate\Http\Request;
use DB;

class LocaldiscoController extends Controller
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
          // 'version' => 'bail|required|unique:os_versions,localdisco|max:50',
          // 'distribucion' => 'bail|required|exists:distribuciones,id|max:2',
          'disco' => 'bail|required|max:15',
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
       //  $Localdisco = Localdisco::find($request->id);
         $localdisco=Localdisco::create([
           'localdisco' => $request->disco,
           'cve_servidor' => $request->servidor,
           'pmontaje' => $request->montaje,
           'capacidad' => $request->capacidad_gb,
           'usado' => $request->usado_gb,
           'usadop' => ($request->usado_gb / $request->capacidad_gb) *100,
           'cve_dformato' => $request->formato,
           'comontaje' => $request->comandos,
           'descripcion' => $request->descripcion,
         ]);

         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $localdisco;
   }

  /**
   * Display the specified resource.
   */
  public function show(Localdisco $localdisco)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Localdisco $localdisco)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
   public function update(Request $request, Localdisco $localdisco)
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
            $datacToUpdate = 'localdisco';
          break;
          case 'servidor':
            $datacToUpdate = 'cve_servidor';
          break;
          case 'montaje':
            $datacToUpdate = 'montaje';
          break;
          case 'capacidad_gb':
            $datacToUpdate = 'capacidad';

            //dd($nup);
            DB::beginTransaction();
            try {
             $localdisco->usadop = ($localdisco->usado/$request->catActual)*100;
             $localdisco->push();
             DB::commit();
            } catch (\Exception $e) {
              DB::rollBack();
              return $e;
            }
          break;
          case 'usado_gb':
            $datacToUpdate = 'usado';
            
            //dd($nup);
            DB::beginTransaction();
            try {
             $localdisco->usadop = ($request->catActual/$localdisco->capacidad)*100;
             $localdisco->push();
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
       //  $Localdisco = Localdisco::find($request->id);
         $localdisco->$datacToUpdate = $request->catActual;

         $localdisco->push();
         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $localdisco;
   }

  /**
   * Remove the specified resource from storage.
   */
   public function destroy(Localdisco $localdisco)
   {
     //$localdisco = Localdisco::findOrFail($localdisco->id);
     if (isset($localdisco)) {
        DB::beginTransaction();
        try {
          $localdisco->delete();
          // $adscripcion->delete();
          DB::commit();
        } catch (\Exception $e) {
          return $e;
        }

     }

     return $localdisco->id;
   }
  public function indexdt(LocaldiscosDataTable $dataTable)
  {
        return $dataTable->render('admin.localdiscosdt');
  }
}
