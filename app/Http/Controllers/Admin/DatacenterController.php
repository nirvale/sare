<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDatacenterRequest;
use App\Http\Requests\UpdateDatacenterRequest;
use App\Models\Admin\Datacenter;

class DatacenterController extends Controller
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
    public function store(StoreDatacenterRequest $request)
    {
        //
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
}
