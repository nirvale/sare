<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDominioRequest;
use App\Http\Requests\UpdateDominioRequest;
use App\Models\Admin\Dominio;
use App\DataTables\Admin\DominiosDataTable;

class DominioController extends Controller
{
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
    public function store(StoreDominioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dominio $dominio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dominio $dominio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDominioRequest $request, Dominio $dominio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dominio $dominio)
    {
        //
    }

    public function indexdt(DominiosDataTable $dataTable)
    {
          return $dataTable->render('admin.dominiosdt');
    }
}
