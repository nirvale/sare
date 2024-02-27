<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreRdbmsRequest;
// use App\Http\Requests\UpdateRdbmsRequest;
use App\Models\Admin\Rdbms;
use App\DataTables\Admin\RdbmssDataTable;
use Illuminate\Http\Request;
use DB;


class RdbmsController extends Controller
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
         'rdbms' => 'bail|required|unique:rdbmss|max:50',
     ]);
     if ($validated->fails())
     {
       return response()->json(['errors'=>$validated->errors()->all()]);
     }
     if ($validated) {
       DB::beginTransaction();
       try {
      //  $Rdbms = Rdbms::find($request->id);
        $rdbms=Rdbms::create([

          'rdbms' => strToUpper($request->rdbms),

        ]);

        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $rdbms;
  }

  /**
   * Display the specified resource.
   */
  public function show(Rdbms $rdbms)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Rdbms $rdbms)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Rdbms $rdbms)
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
         case 'rdbms':
           $datacToUpdate = 'rdbms';
         break;
         default:
           // code...
         break;
       }
       DB::beginTransaction();
       try {
      //  $Rdbms = Rdbms::find($request->id);
        $rdbms->$datacToUpdate = strToUpper($request->catActual);

        $rdbms->push();
        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $rdbms;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Rdbms $rdbms)
  {
    //$rdbms = Rdbms::findOrFail($rdbms->id);
    if (isset($rdbms)) {
       DB::beginTransaction();
       try {
         $rdbms->delete();
         // $adscripcion->delete();
         DB::commit();
       } catch (\Exception $e) {
         return $e;
       }

    }

    return $rdbms->id;
  }

  public function indexdt(RdbmssDataTable $dataTable)
  {
        return $dataTable->render('admin.rdbmssdt');
  }
}
