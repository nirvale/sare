<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreTdiscoRequest;
// use App\Http\Requests\UpdateTdiscoRequest;
use App\Models\Admin\Tdisco;
use App\DataTables\Admin\TdiscosDataTable;
use Illuminate\Http\Request;
use DB;


class TdiscoController extends Controller
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
         'tdisco' => 'bail|required|unique:tdiscos|max:50',
     ]);
     if ($validated->fails())
     {
       return response()->json(['errors'=>$validated->errors()->all()]);
     }
     if ($validated) {
       DB::beginTransaction();
       try {
      //  $Tdisco = Tdisco::find($request->id);
        $tdisco=Tdisco::create([

          'tdisco' => strToUpper($request->tdisco),

        ]);

        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $tdisco;
  }

  /**
   * Display the specified resource.
   */
  public function show(Tdisco $tdisco)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Tdisco $tdisco)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Tdisco $tdisco)
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
         case 'tdisco':
           $datacToUpdate = 'tdisco';
         break;
         default:
           // code...
         break;
       }
       DB::beginTransaction();
       try {
      //  $Tdisco = Tdisco::find($request->id);
        $tdisco->$datacToUpdate = strToUpper($request->catActual);

        $tdisco->push();
        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $tdisco;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Tdisco $tdisco)
  {
    //$tdisco = Tdisco::findOrFail($tdisco->id);
    if (isset($tdisco)) {
       DB::beginTransaction();
       try {
         $tdisco->delete();
         // $adscripcion->delete();
         DB::commit();
       } catch (\Exception $e) {
         return $e;
       }

    }

    return $tdisco->id;
  }

  public function indexdt(TdiscosDataTable $dataTable)
  {
        return $dataTable->render('admin.tdiscosdt');
  }
}
