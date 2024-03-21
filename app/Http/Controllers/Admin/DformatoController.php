<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreDformatoRequest;
// use App\Http\Requests\UpdateDformatoRequest;
use App\Models\Admin\Dformato;
use App\DataTables\Admin\DformatosDataTable;
use Illuminate\Http\Request;
use DB;

class DformatoController extends Controller
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
           'dformato' => 'bail|required|unique:dformatos|max:50',
       ]);
       if ($validated->fails())
       {
         return response()->json(['errors'=>$validated->errors()->all()]);
       }
       if ($validated) {
         DB::beginTransaction();
         try {
        //  $Dformato = Dformato::find($request->id);
          $dformato=Dformato::create([

            'dformato' => strtoUpper($request->dformato),

          ]);

          DB::commit();
         } catch (\Exception $e) {
           DB::rollBack();
           return $e;
         }

       }
       return $dformato;
    }

    /**
     * Display the specified resource.
     */
    public function show(Dformato $dformato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dformato $dformato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dformato $dformato)
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
           case 'formato':
             $datacToUpdate = 'dformato';
           break;
           default:
             // code...
           break;
         }
         DB::beginTransaction();
         try {
        //  $Dformato = Dformato::find($request->id);
          $dformato->$datacToUpdate = strtoUpper($request->catActual);

          $dformato->push();
          DB::commit();
         } catch (\Exception $e) {
           DB::rollBack();
           return $e;
         }

       }
       return $dformato;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dformato $dformato)
    {
      //$dformato = Dformato::findOrFail($dformato->id);
      if (isset($dformato)) {
         DB::beginTransaction();
         try {
           $dformato->delete();
           // $adscripcion->delete();
           DB::commit();
         } catch (\Exception $e) {
           return $e;
         }

      }

      return $dformato->id;
    }

    public function indexdt(DformatosDataTable $dataTable)
    {
          return $dataTable->render('admin.dformatosdt');
    }
}
