<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreServidorRequest;
// use App\Http\Requests\UpdateServidorRequest;
use App\Models\Admin\Servidor;
use App\DataTables\Admin\ServidorsDataTable;
use Illuminate\Http\Request;
use DB;

class ServidorController extends Controller
{
  public function __construct(Request $request)
  {
      $this->middleware(['permission:admin|admin']);
  }
  /**
   * Display a listing of the resource.
   */
   public function qtest()
   {
     $model = Servidor::select(
                   'servidores.id',
                   'servidores.hostname',
                   'servidores.memoria',
                   'servidores.procesadores',
                   'servidores.cve_procesador',
                     'procesadores.procesador as nomprocesador',
                     'procesadores.nucleos',
                     'procesadores.velocidad',
                     // 'servidores.nucleos',
                     // 'servidores.cve_procesador',
                     // 'servidores.velocidad_procesador',

                      'mprocesadores.mprocesador',
                      'aprocesadores.aprocesador',
                      'os.os',
                      'distribuciones.distribucion',
                      'os_versions.osversion',
                      'ambientes.ambiente',
                      'datacenters.datacenter',
                      'tipos.tipo',
                      'virtualizadores.virtualizador',
                      'mhardwares.mhardware',
                      'dominios.dominio',
                    'servidores.descripcion',
           )
            ->join('procesadores','procesadores.id','=','servidores.cve_procesador')
            ->join('mprocesadores','mprocesadores.id','=','procesadores.cve_mprocesador')
            ->join('aprocesadores','aprocesadores.id','=','procesadores.cve_aprocesador')
            ->join('os_versions','os_versions.id','=','servidores.cve_osversion')
            ->join('distribuciones','distribuciones.id','=','os_versions.cve_distribucion')
            ->join('os','os.id','=','distribuciones.cve_os')
            ->join('ambientes','ambientes.id','=','servidores.cve_ambiente')
            ->join('datacenters','datacenters.id','=','servidores.cve_datacenter')
            ->join('tipos','tipos.id','=','servidores.cve_tipo')
            ->join('virtualizadores','virtualizadores.id','=','servidores.cve_virtualizador')
            ->join('mhardwares','mhardwares.id','=','servidores.cve_mhardware')
            ->join('dominios','dominios.id','=','servidores.cve_dominio')
            ->with('nics')
           ->get();
//   $modelo =Servidor::select('*')->get();
 return $model;
   }
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
          'version' => 'bail|required|unique:os_versions,servidor|max:50',
          'distribucion' => 'bail|required|exists:distribuciones,id|max:2',
      ]);
      if ($validated->fails())
      {
        return response()->json(['errors'=>$validated->errors()->all()]);
      }
      if ($validated) {
        DB::beginTransaction();
        try {
       //  $Servidor = Servidor::find($request->id);
         $servidor=Servidor::create([
           'servidor' => strToUpper($request->version),
           'cve_distribucion' => strToUpper($request->distribucion),
         ]);

         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $servidor;
   }

  /**
   * Display the specified resource.
   */
  public function show(Servidor $servidor)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Servidor $servidor)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
   public function update(Request $request, Servidor $servidor)
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
            $datacToUpdate = 'cve_distribucion';
          break;
          case 'versión':
            $datacToUpdate = 'servidor';
          break;
          default:
            // code...
          break;
        }
        DB::beginTransaction();
        try {
       //  $Servidor = Servidor::find($request->id);
         $servidor->$datacToUpdate = strToUpper($request->catActual);

         $servidor->push();
         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $servidor;
   }

  /**
   * Remove the specified resource from storage.
   */
   public function destroy(Servidor $servidor)
   {
     //$servidor = Servidor::findOrFail($servidor->id);
     if (isset($servidor)) {
        DB::beginTransaction();
        try {
          $servidor->delete();
          // $adscripcion->delete();
          DB::commit();
        } catch (\Exception $e) {
          return $e;
        }

     }

     return $servidor->id;
   }
  public function indexdt(ServidorsDataTable $dataTable)
  {
        return $dataTable->render('admin.servidorsdt');
  }
}
