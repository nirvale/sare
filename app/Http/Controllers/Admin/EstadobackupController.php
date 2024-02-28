<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreEstadobackupRequest;
// use App\Http\Requests\UpdateEstadobackupRequest;
use App\Models\Admin\Estadobackup;
use App\DataTables\Admin\EstadobackupsDataTable;
use Illuminate\Http\Request;
use DB;

class EstadobackupController extends Controller
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
         'estado_backup' => 'bail|required|unique:estadobackups,estadobackup|max:50',
     ]);
     if ($validated->fails())
     {
       return response()->json(['errors'=>$validated->errors()->all()]);
     }
     if ($validated) {
       DB::beginTransaction();
       try {
      //  $Estadobackup = Estadobackup::find($request->id);
        $estadobackup=Estadobackup::create([

          'estadobackup' => strToUpper($request->estado_backup),

        ]);

        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $estadobackup;
  }

  /**
   * Display the specified resource.
   */
  public function show(Estadobackup $estadobackup)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Estadobackup $estadobackup)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Estadobackup $estadobackup)
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
         case 'estado backup':
           $datacToUpdate = 'estadobackup';
         break;
         default:
           // code...
         break;
       }
       DB::beginTransaction();
       try {
      //  $Estadobackup = Estadobackup::find($request->id);
        $estadobackup->$datacToUpdate = strToUpper($request->catActual);

        $estadobackup->push();
        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $estadobackup;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Estadobackup $estadobackup)
  {
    //$estadobackup = Estadobackup::findOrFail($estadobackup->id);
    if (isset($estadobackup)) {
       DB::beginTransaction();
       try {
         $estadobackup->delete();
         // $adscripcion->delete();
         DB::commit();
       } catch (\Exception $e) {
         return $e;
       }

    }

    return $estadobackup->id;
  }

  public function indexdt(EstadobackupsDataTable $dataTable)
  {
        return $dataTable->render('admin.estadobackupsdt');
  }
}
