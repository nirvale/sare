<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreMhardwareRequest;
// use App\Http\Requests\UpdateMhardwareRequest;
use App\Models\Admin\Mhardware;
use App\DataTables\Admin\MhardwaresDataTable;
use Illuminate\Http\Request;
use DB;


class MhardwareController extends Controller
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
         'mhardware' => 'bail|required|unique:mhardwares|max:50',
     ]);
     if ($validated->fails())
     {
       return response()->json(['errors'=>$validated->errors()->all()]);
     }
     if ($validated) {
       DB::beginTransaction();
       try {
      //  $Mhardware = Mhardware::find($request->id);
        $mhardware=Mhardware::create([

          'mhardware' => strToUpper($request->mhardware),

        ]);

        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $mhardware;
  }

  /**
   * Display the specified resource.
   */
  public function show(Mhardware $mhardware)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Mhardware $mhardware)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Mhardware $mhardware)
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
         case 'mhardware':
           $datacToUpdate = 'mhardware';
         break;
         default:
           // code...
         break;
       }
       DB::beginTransaction();
       try {
      //  $Mhardware = Mhardware::find($request->id);
        $mhardware->$datacToUpdate = strToUpper($request->catActual);

        $mhardware->push();
        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $mhardware;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Mhardware $mhardware)
  {
    //$mhardware = Mhardware::findOrFail($mhardware->id);
    if (isset($mhardware)) {
       DB::beginTransaction();
       try {
         $mhardware->delete();
         // $adscripcion->delete();
         DB::commit();
       } catch (\Exception $e) {
         return $e;
       }

    }

    return $mhardware->id;
  }

  public function indexdt(MhardwaresDataTable $dataTable)
  {
        return $dataTable->render('admin.mhardwaresdt');
  }
}
