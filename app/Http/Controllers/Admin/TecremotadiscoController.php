<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreTecremotadiscoRequest;
// use App\Http\Requests\UpdateTecremotadiscoRequest;
use App\Models\Admin\Tecremotadisco;
use App\DataTables\Admin\TecremotadiscosDataTable;
use Illuminate\Http\Request;
use DB;


class TecremotadiscoController extends Controller
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
         'tecremotadisco' => 'bail|required|unique:tecremotadiscos|max:50',
     ]);
     if ($validated->fails())
     {
       return response()->json(['errors'=>$validated->errors()->all()]);
     }
     if ($validated) {
       DB::beginTransaction();
       try {
      //  $Tecremotadisco = Tecremotadisco::find($request->id);
        $tecremotadisco=Tecremotadisco::create([

          'tecremotadisco' => strToUpper($request->tecremotadisco),

        ]);

        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $tecremotadisco;
  }

  /**
   * Display the specified resource.
   */
  public function show(Tecremotadisco $tecremotadisco)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Tecremotadisco $tecremotadisco)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Tecremotadisco $tecremotadisco)
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
         case 'tecremotadisco':
           $datacToUpdate = 'tecremotadisco';
         break;
         default:
           // code...
         break;
       }
       DB::beginTransaction();
       try {
      //  $Tecremotadisco = Tecremotadisco::find($request->id);
        $tecremotadisco->$datacToUpdate = strToUpper($request->catActual);

        $tecremotadisco->push();
        DB::commit();
       } catch (\Exception $e) {
         DB::rollBack();
         return $e;
       }

     }
     return $tecremotadisco;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Tecremotadisco $tecremotadisco)
  {
    //$tecremotadisco = Tecremotadisco::findOrFail($tecremotadisco->id);
    if (isset($tecremotadisco)) {
       DB::beginTransaction();
       try {
         $tecremotadisco->delete();
         // $adscripcion->delete();
         DB::commit();
       } catch (\Exception $e) {
         return $e;
       }

    }

    return $tecremotadisco->id;
  }

  public function indexdt(TecremotadiscosDataTable $dataTable)
  {
        return $dataTable->render('admin.tecremotadiscosdt');
  }
}
