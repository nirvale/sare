<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreUdremotaRequest;
// use App\Http\Requests\UpdateUdremotaRequest;
use App\Models\Admin\Udremota;
use App\DataTables\Admin\UdremotasDataTable;
use Illuminate\Http\Request;
use DB;

class UdremotaController extends Controller
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
         'utilidad' => 'bail|required|unique:udremotas,udremota|max:50',
     ]);
     if ($validated->fails())
     {
       return response()->json(['errors'=>$validated->errors()->all()]);
     }
     if ($validated) {
       DB::beginTransaction();
       try {
      //  $Udremota = Udremota::find($request->id);
        $udremota=Udremota::create([

          'udremota' => strtoUpper($request->utilidad),

        ]);

        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $udremota;
  }

  /**
   * Display the specified resource.
   */
  public function show(Udremota $udremota)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Udremota $udremota)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Udremota $udremota)
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
         case 'utilidad':
           $datacToUpdate = 'udremota';
         break;
         default:
           // code...
         break;
       }
       DB::beginTransaction();
       try {
      //  $Udremota = Udremota::find($request->id);
        $udremota->$datacToUpdate = strtoUpper($request->catActual);

        $udremota->push();
        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $udremota;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Udremota $udremota)
  {
    //$udremota = Udremota::findOrFail($udremota->id);
    if (isset($udremota)) {
       DB::beginTransaction();
       try {
         $udremota->delete();
         // $adscripcion->delete();
         DB::commit();
       } catch (\Exception $e) {
         return $e;
       }

    }

    return $udremota->id;
  }

  public function indexdt(UdremotasDataTable $dataTable)
  {
        return $dataTable->render('admin.udremotasdt');
  }
}
