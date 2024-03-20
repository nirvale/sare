<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreNicRequest;
// use App\Http\Requests\UpdateNicRequest;
use App\Models\Admin\Nic;
use App\DataTables\Admin\NicsDataTable;
use Illuminate\Http\Request;
use DB;

class NicController extends Controller
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
          // 'version' => 'bail|required|unique:os_versions,nic|max:50',
          // 'distribucion' => 'bail|required|exists:distribuciones,id|max:2',
          'nic' => 'bail|required|',
          'servidor' => 'bail|required|exists:servidores,id|max:2',
          'mac' => 'bail|required|unique:nics,mac',
          'tipo' => 'bail|required|exists:tnics,id|max:2',
          'descripcion' => 'bail|required|',
      ]);
      if ($validated->fails())
      {
        return response()->json(['errors'=>$validated->errors()->all()]);
      }
      if ($validated) {
        DB::beginTransaction();
        try {
       //  $Nic = Nic::find($request->id);
         $nic=Nic::create([
           'nic' => $request->nic,
           'cve_tnic' => strToUpper($request->tipo),
           'cve_servidor' => strToUpper($request->servidor),
           'ip' => strToUpper($request->ip),
           'gateway' => strToUpper($request->gateway),
           'netmask' => strToUpper($request->netmask),
           'cve_dns1' => strToUpper($request->dns1),
           'cve_dns2' => strToUpper($request->dns2),
           'cve_dns3' => strToUpper($request->dns3),
           'mac' => strToUpper($request->mac),
           'descripcion' => $request->descripcion,
         ]);

         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $nic;
   }

  /**
   * Display the specified resource.
   */
  public function show(Nic $nic)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Nic $nic)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
   public function update(Request $request, Nic $nic)
   {
     if ($request->thead == 'dns1' ||$request->thead == 'dns2' || $request->thead == 'dns3' ) {
       $validated=\Validator::make($request->all(), [
            //'empr_nombre' => 'bail|required|',
            //'catOriginal' => 'bail|required|max:50',
            //'catActual' => 'bail|required|max:50',
            //'empeval_fotos.*.file' => 'required|mimes:jpeg,jpg,png|max: 20000',
            // 'cve_oficina' => 'bail|required|max:1',
            // 'id_perfil' => 'bail|required|max:2',
            // 'cve_estado' => 'bail|required|max:1',
            // 'email' => 'bail|required|email:rfc,dns',
            // 'pwd' => 'bail|required|max:10',
        ]);
     }else {
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
     }

      if ($validated->fails())
      {
        return response()->json(['errors'=>$validated->errors()->all()]);
      }
      if ($validated) {
        switch ($request->thead) {
          case 'nic':
            $datacToUpdate = 'nic';
          break;
          case 'ip':
            $datacToUpdate = 'ip';
          break;
          case 'tipo':
            $datacToUpdate = 'cve_tnic';
          break;
          case 'gateway':
            $datacToUpdate = 'gateway';
          break;
          case 'netmask':
            $datacToUpdate = 'netmask';
          break;
          case 'dns1':
            $datacToUpdate = 'cve_dns1';
          break;
          case 'dns2':
            $datacToUpdate = 'cve_dns2';
          break;
          case 'dns3':
            $datacToUpdate = 'cve_dns3';
          break;
          case 'mac':
            $datacToUpdate = 'mac';
            $request->catActual=strToUpper($request->catActual);
          break;
          case 'descripcion':
            $datacToUpdate = 'descripcion';
          break;
          case 'servidor':
            $datacToUpdate = 'cve_servidor';
          break;
          default:
            // code...
          break;
        }
        DB::beginTransaction();
        try {
       //  $Nic = Nic::find($request->id);
         $nic->$datacToUpdate = $request->catActual;

         $nic->push();
         DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
          return $e;
        }

      }
      return $nic;
   }

  /**
   * Remove the specified resource from storage.
   */
   public function destroy(Nic $nic)
   {
     //$nic = Nic::findOrFail($nic->id);
     if (isset($nic)) {
        DB::beginTransaction();
        try {
          $nic->delete();
          // $adscripcion->delete();
          DB::commit();
        } catch (\Exception $e) {
          return $e;
        }

     }

     return $nic->id;
   }
  public function indexdt(NicsDataTable $dataTable)
  {
        return $dataTable->render('admin.nicsdt');
  }
}
