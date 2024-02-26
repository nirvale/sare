<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreAmbienteRequest;
// use App\Http\Requests\UpdateAmbienteRequest;
use App\Models\Admin\Ambiente;
use App\DataTables\Admin\AmbientesDataTable;
use Illuminate\Http\Request;
use DB;

class AmbienteController extends Controller
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
            'ambiente' => 'bail|required|unique:ambientes|max:50',
        ]);
        if ($validated->fails())
        {
          return response()->json(['errors'=>$validated->errors()->all()]);
        }
        if ($validated) {
          DB::beginTransaction();
          try {
         //  $Ambiente = Ambiente::find($request->id);
           $ambiente=Ambiente::create([

             'ambiente' => strToUpper($request->ambiente),

           ]);

           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $ambiente;
     }


    /**
     * Display the specified resource.
     */
    public function show(Ambiente $ambiente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ambiente $ambiente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Ambiente $ambiente)
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
            case 'ambiente':
              $datacToUpdate = 'ambiente';
            break;
            default:
              // code...
            break;
          }
          DB::beginTransaction();
          try {
         //  $Ambiente = Ambiente::find($request->id);
           $ambiente->$datacToUpdate = strToUpper($request->catActual);

           $ambiente->push();
           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $ambiente;
     }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Ambiente $ambiente)
     {
       //$ambiente = Ambiente::findOrFail($ambiente->id);
       if (isset($ambiente)) {
          DB::beginTransaction();
          try {
            $ambiente->delete();
            // $adscripcion->delete();
            DB::commit();
          } catch (\Exception $e) {
            return $e;
          }

       }

       return $ambiente->id;
     }

    public function indexdt(AmbientesDataTable $dataTable)
    {
          return $dataTable->render('admin.ambientesdt');
    }
}
