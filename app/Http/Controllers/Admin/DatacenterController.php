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
            //'descripción' => 'bail|required|unique:datacenters|max:50',
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
    public function update(UpdateDatacenterRequest $request, Datacenter $datacenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Datacenter $datacenter)
    {
        //
    }
    public function indexdt(DatacentersDataTable $dataTable)
    {
          return $dataTable->render('admin.datacentersdt');
    }
}
