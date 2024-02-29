<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreTipodcRequest;
// use App\Http\Requests\UpdateTipodcRequest;
use App\Models\Admin\Tipodc;
use App\DataTables\Admin\TipodcsDataTable;
use Illuminate\Http\Request;
use DB;

class TipodcController extends Controller
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
            'tipodc' => 'bail|required|unique:tipodcs|max:50',
        ]);
        if ($validated->fails())
        {
          return response()->json(['errors'=>$validated->errors()->all()]);
        }
        if ($validated) {
          DB::beginTransaction();
          try {
         //  $Tipodc = Tipodc::find($request->id);
           $tipodc=Tipodc::create([

             'tipodc' => strToUpper($request->tipodc),

           ]);

           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $tipodc;
     }

    /**
     * Display the specified resource.
     */
    public function show(Tipodc $tipodc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tipodc $tipodc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Tipodc $tipodc)
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
            case 'tipodc':
              $datacToUpdate = 'tipodc';
            break;
            default:
              // code...
            break;
          }
          DB::beginTransaction();
          try {
         //  $Tipodc = Tipodc::find($request->id);
           $tipodc->$datacToUpdate = strToUpper($request->catActual);

           $tipodc->push();
           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $tipodc;
     }


    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Tipodc $tipodc)
     {
       //$tipodc = Tipodc::findOrFail($tipodc->id);
       if (isset($tipodc)) {
          DB::beginTransaction();
          try {
            $tipodc->delete();
            // $adscripcion->delete();
            DB::commit();
          } catch (\Exception $e) {
            return $e;
          }

       }

       return $tipodc->id;
     }

    public function indexdt(TipodcsDataTable $dataTable)
    {
          return $dataTable->render('admin.tipodcsdt');
    }
}
