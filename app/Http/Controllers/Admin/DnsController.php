<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreDnsRequest;
// use App\Http\Requests\UpdateDnsRequest;
use App\Models\Admin\Dns;
use App\DataTables\Admin\DnssDataTable;
use Illuminate\Http\Request;
use DB;


class DnsController extends Controller
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
         'nombre' => 'bail|required|unique:dns,dnsname|max:50',
         'ip' => 'bail|required|unique:dns,dnsip|max:50',
         'servidor' => 'bail|required|exists:servidores,id|max:2',
     ]);
     if ($validated->fails())
     {
       return response()->json(['errors'=>$validated->errors()->all()]);
     }
     if ($validated) {
       DB::beginTransaction();
       try {
      //  $Dns = Dns::find($request->id);
        $dns=Dns::create([

          'dnsname' => strToUpper($request->nombre),
          'dnsip' => strtolower($request->ip),
          'cve_servidor' => $request->servidor,
        ]);

        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $dns;
  }

  /**
   * Display the specified resource.
   */
  public function show(Dns $dns)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Dns $dns)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Dns $dns)
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
         case 'nombre':
           $datacToUpdate = 'dnsname';
           $request->catActual=strToUpper($request->catActual);
         break;
         case 'ip':
           $datacToUpdate = 'dnsip';
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
      //  $Dns = Dns::find($request->id);
        $dns->$datacToUpdate = $request->catActual;

        $dns->push();
        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $dns;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Dns $dns)
  {
    //$dns = Dns::findOrFail($dns->id);
    if (isset($dns)) {
       DB::beginTransaction();
       try {
         $dns->delete();
         // $adscripcion->delete();
         DB::commit();
       } catch (\Exception $e) {
         return $e;
       }

    }

    return $dns->id;
  }

  public function indexdt(DnssDataTable $dataTable)
  {
        return $dataTable->render('admin.dnssdt');
  }
}
