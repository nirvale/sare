<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreDatacenterRequest;
// use App\Http\Requests\UpdateDatacenterRequest;
use App\Models\Admin\Datacenter;
use App\DataTables\Admin\DatacentersDataTable;
use Illuminate\Http\Request;
use DB;

class DatacenterController extends Controller
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
            'datacenter' => 'bail|required|unique:datacenters|max:50',
            'tipodc' => 'bail|required|unique:tipodcs|max:50',
        ]);
        if ($validated->fails())
        {
          return response()->json(['errors'=>$validated->errors()->all()]);
        }
        if ($validated) {
          DB::beginTransaction();
          try {
         //  $Datacenter = Datacenter::find($request->id);
           $datacenter=Datacenter::create([
             'datacenter' => strToUpper($request->datacenter),
             'desc_datacenter' => strToUpper($request->descripción),
             'cve_tipodc' => strToUpper($request->tipodc),
           ]);

           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $datacenter;
     }

    /**
     * Display the specified resource.
     */
    public function show(Datacenter $datacenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Datacenter $datacenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Datacenter $datacenter)
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
            case 'datacenter':
              $datacToUpdate = 'datacenter';
            break;
            case 'descripción':
              $datacToUpdate = 'desc_datacenter';
            break;
            case 'tipodc':
              $datacToUpdate = 'cve_tipodc';
            break;
            default:
              // code...
            break;
          }
          DB::beginTransaction();
          try {
         //  $Datacenter = Datacenter::find($request->id);
           $datacenter->$datacToUpdate = strToUpper($request->catActual);

           $datacenter->push();
           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $datacenter;
     }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Datacenter $datacenter)
     {
       //$datacenter = Datacenter::findOrFail($datacenter->id);
       if (isset($datacenter)) {
          DB::beginTransaction();
          try {
            $datacenter->delete();
            // $adscripcion->delete();
            DB::commit();
          } catch (\Exception $e) {
            return $e;
          }

       }

       return $datacenter->id;
     }
    public function indexdt(DatacentersDataTable $dataTable)
    {
          return $dataTable->render('admin.datacentersdt');
    }
}
