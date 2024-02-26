<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreOficinaRequest;
// use App\Http\Requests\UpdateOficinaRequest;
use App\Models\Admin\Oficina;
use App\DataTables\Admin\OficinasDataTable;
use Illuminate\Http\Request;
use DB;


class OficinaController extends Controller
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
            'oficina' => 'bail|required|unique:oficinas|max:50',
        ]);
        if ($validated->fails())
        {
          return response()->json(['errors'=>$validated->errors()->all()]);
        }
        if ($validated) {
          DB::beginTransaction();
          try {
         //  $Oficina = Oficina::find($request->id);
           $oficina=Oficina::create([

             'oficina' => strToUpper($request->oficina),

           ]);

           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $oficina;
     }

    /**
     * Display the specified resource.
     */
    public function show(Oficina $oficina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Oficina $oficina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Oficina $oficina)
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
            case 'oficina':
              $datacToUpdate = 'oficina';
            break;
            default:
              // code...
            break;
          }
          DB::beginTransaction();
          try {
         //  $Oficina = Oficina::find($request->id);
           $oficina->$datacToUpdate = strtoupper($request->catActual);

           $oficina->push();
           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $oficina;
     }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Oficina $oficina)
     {
       //$oficina = Oficina::findOrFail($oficina->id);
       if (isset($oficina)) {
          DB::beginTransaction();
          try {
            $oficina->delete();
            // $adscripcion->delete();
            DB::commit();
          } catch (\Exception $e) {
            return $e;
          }

       }

       return $oficina->id;
     }

    public function indexdt(OficinasDataTable $dataTable)
    {
          return $dataTable->render('admin.oficinasdt');
    }
}
