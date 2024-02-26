<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreTnicRequest;
// use App\Http\Requests\UpdateTnicRequest;
use App\Models\Admin\Tnic;
use App\DataTables\Admin\TnicsDataTable;
use Illuminate\Http\Request;
use DB;


class TnicController extends Controller
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
            'tnic' => 'bail|required|unique:tnics|max:50',
        ]);
        if ($validated->fails())
        {
          return response()->json(['errors'=>$validated->errors()->all()]);
        }
        if ($validated) {
          DB::beginTransaction();
          try {
         //  $Tnic = Tnic::find($request->id);
           $tnic=Tnic::create([

             'tnic' => strToUpper($request->tnic),

           ]);

           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $tnic;
     }

    /**
     * Display the specified resource.
     */
    public function show(Tnic $tnic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tnic $tnic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Tnic $tnic)
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
            case 'tnic':
              $datacToUpdate = 'tnic';
            break;
            default:
              // code...
            break;
          }
          DB::beginTransaction();
          try {
         //  $Tnic = Tnic::find($request->id);
           $tnic->$datacToUpdate = mb_strtoupper($request->catActual);

           $tnic->push();
           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $tnic;
     }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Tnic $tnic)
     {
       //$tnic = Tnic::findOrFail($tnic->id);
       if (isset($tnic)) {
          DB::beginTransaction();
          try {
            $tnic->delete();
            // $adscripcion->delete();
            DB::commit();
          } catch (\Exception $e) {
            return $e;
          }

       }

       return $tnic->id;
     }
    public function indexdt(TnicsDataTable $dataTable)
    {
          return $dataTable->render('admin.tnicsdt');
    }
}
