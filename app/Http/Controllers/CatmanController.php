<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Tipodc;

class CatmanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function catman(Request $request)
   {
      switch ($request->catman) {
        case 'datacenter':
            switch ($request->theadcombox[0]) {
              case 'tipodc':
                  $theadcomboxr='tipodc';
                  $catmanr[$theadcomboxr]=Tipodc::all();
                //break;
            // case 'descripción':
            //       $theadcomboxr='descripción';
            //       $catmanr[$theadcomboxr]=Tipodc::all();
            //   //break;

              default:
                // code...
                break;
            }

          break;

         default:
           // code...
           break;
       }
       return $catmanr;
   }

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
