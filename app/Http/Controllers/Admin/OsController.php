<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Os;
use App\DataTables\Admin\OssDataTable;
use Illuminate\Http\Request;
use DB;


class OsController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Os $os)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Os $os)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request,Os $os)
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
            case 'os':
              $datacToUpdate = 'os';
            break;
            default:
              // code...
            break;
          }
          DB::beginTransaction();
          try {
         //  $Os = Os::find($request->id);
           $os->$datacToUpdate = strToUpper($request->catActual);

           $os->push();
           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $os;
     }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Os $os)
     {
       //$os = Os::findOrFail($os->id);
       if (isset($os)) {
          DB::beginTransaction();
          try {
            $os->delete();
            // $adscripcion->delete();
            DB::commit();
          } catch (\Exception $e) {
            return $e;
          }

       }

       return $os->id;
     }
    public function indexdt(OssDataTable $dataTable)
    {
          return $dataTable->render('admin.ossdt');
    }
}
