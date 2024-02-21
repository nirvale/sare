<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreDominioRequest;
// use App\Http\Requests\UpdateDominioRequest;
use App\Models\Admin\Dominio;
use App\DataTables\Admin\DominiosDataTable;
use Illuminate\Http\Request;
use DB;

class DominioController extends Controller
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
           'dominio' => 'bail|required|unique:dominios|max:50',
       ]);
       if ($validated->fails())
       {
         return response()->json(['errors'=>$validated->errors()->all()]);
       }
       if ($validated) {
         DB::beginTransaction();
         try {
        //  $Dominio = Dominio::find($request->id);
          $dominio=Dominio::create([

            'dominio' => strtolower($request->dominio),

          ]);

          DB::commit();
         } catch (\Exception $e) {
           DB::rollBack();
           return $e;
         }

       }
       return $dominio;
    }

    /**
     * Display the specified resource.
     */
    public function show(Dominio $dominio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dominio $dominio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dominio $dominio)
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
           case 'dominio':
             $datacToUpdate = 'dominio';
           break;
           default:
             // code...
           break;
         }
         DB::beginTransaction();
         try {
        //  $Dominio = Dominio::find($request->id);
          $dominio->$datacToUpdate = strtolower($request->catActual);

          $dominio->push();
          DB::commit();
         } catch (\Exception $e) {
           DB::rollBack();
           return $e;
         }

       }
       return $dominio;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dominio $dominio)
    {
      //$dominio = Dominio::findOrFail($dominio->id);
      if (isset($dominio)) {
         DB::beginTransaction();
         try {
           $dominio->delete();
           // $adscripcion->delete();
           DB::commit();
         } catch (\Exception $e) {
           return $e;
         }

      }

      return $dominio->id;
    }

    public function indexdt(DominiosDataTable $dataTable)
    {
          return $dataTable->render('admin.dominiosdt');
    }
}
