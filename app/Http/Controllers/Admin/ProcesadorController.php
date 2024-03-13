<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreProcesadorRequest;
// use App\Http\Requests\UpdateProcesadorRequest;
use App\Models\Admin\Procesador;
use App\DataTables\Admin\ProcesadorsDataTable;
use Illuminate\Http\Request;
use DB;

class ProcesadorController extends Controller
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
          // 'version' => 'bail|required|unique:os_versions,procesador|max:50',
          // 'distribucion' => 'bail|required|exists:distribuciones,id|max:2',
          'procesador' => 'bail|required|',
          'nucleos' => 'bail|required|',
          'velocidad' => 'bail|required|',
          'fabricante' => 'bail|required|exists:mprocesadores,id|max:2',
          'arquitectura' => 'bail|required|exists:aprocesadores,id|max:2',
      ]);
      if ($validated->fails())
      {
        return response()->json(['errors'=>$validated->errors()->all()]);
      }
      if ($validated) {
        DB::beginTransaction();
        try {
       //  $Procesador = Procesador::find($request->id);
         $procesador=Procesador::create([
           'procesador' => strToUpper($request->procesador),
           'nucleos' => strToUpper($request->nucleos),
           'velocidad' => strToUpper($request->velocidad),
           'cve_mprocesador' => strToUpper($request->fabricante),
           'cve_aprocesador' => strToUpper($request->arquitectura),
         ]);

         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $procesador;
   }

  /**
   * Display the specified resource.
   */
  public function show(Procesador $procesador)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Procesador $procesador)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
   public function update(Request $request, Procesador $procesador)
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
          case 'procesador':
            $datacToUpdate = 'procesador';
          break;
          case 'núcleos':
            $datacToUpdate = 'nucleos';
          break;
          case 'velocidad':
            $datacToUpdate = 'velocidad';
          break;
          case 'fabricante':
            $datacToUpdate = 'cve_mprocesador';
          break;
          case 'arquitectura':
            $datacToUpdate = 'cve_aprocesador';
          break;
          default:
            // code...
          break;
        }
        DB::beginTransaction();
        try {
       //  $Procesador = Procesador::find($request->id);
         $procesador->$datacToUpdate = strToUpper($request->catActual);

         $procesador->push();
         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $procesador;
   }

  /**
   * Remove the specified resource from storage.
   */
   public function destroy(Procesador $procesador)
   {
     //$procesador = Procesador::findOrFail($procesador->id);
     if (isset($procesador)) {
        DB::beginTransaction();
        try {
          $procesador->delete();
          // $adscripcion->delete();
          DB::commit();
        } catch (\Exception $e) {
          return $e;
        }

     }

     return $procesador->id;
   }
  public function indexdt(ProcesadorsDataTable $dataTable)
  {
        return $dataTable->render('admin.procesadorsdt');
  }
}
