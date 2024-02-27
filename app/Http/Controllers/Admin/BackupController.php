<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreBackupRequest;
// use App\Http\Requests\UpdateBackupRequest;
use App\Models\Admin\Backup;
use App\DataTables\Admin\BackupsDataTable;
use Illuminate\Http\Request;
use DB;

class BackupController extends Controller
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
            'backup' => 'bail|required|unique:backups|max:150',

        ]);
        if ($validated->fails())
        {
          return response()->json(['errors'=>$validated->errors()->all()]);
        }
        if ($validated) {
          DB::beginTransaction();
          try {
         //  $Backup = Backup::find($request->id);
           $backup=Backup::create([
             'backup' => strToUpper($request->backup),
             'descripcion' => strToUpper($request->descripción),

           ]);

           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $backup;
     }

    /**
     * Display the specified resource.
     */
    public function show(Backup $backup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Backup $backup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Backup $backup)
     {
       $validated=\Validator::make($request->all(), [
            //'empr_nombre' => 'bail|required|',
            'catOriginal' => 'bail|required|max:150',
            'catActual' => 'bail|required|max:150',
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
            case 'backup':
              $datacToUpdate = 'backup';
            break;
            case 'descripción':
              $datacToUpdate = 'descripcion';
            break;
            default:
              // code...
            break;
          }
          DB::beginTransaction();
          try {
         //  $Backup = Backup::find($request->id);
           $backup->$datacToUpdate = strToUpper($request->catActual);

           $backup->push();
           DB::commit();
          } catch (\Exception $e) {
            DB::rollBack();
            return $e;
          }

        }
        return $backup;
     }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Backup $backup)
    {
     //$backup = Backup::findOrFail($backup->id);
     if (isset($backup)) {
        DB::beginTransaction();
        try {
          $backup->delete();
          // $adscripcion->delete();
          DB::commit();
        } catch (\Exception $e) {
          return $e;
        }

     }

     return $backup->id;
    }
    public function indexdt(BAckupsDataTable $dataTable)
    {
          return $dataTable->render('admin.backupsdt');
    }
}
