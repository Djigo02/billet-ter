<?php

namespace App\Http\Controllers;

use App\Models\Gare;
use App\Http\Requests\StoreGareRequest;
use App\Http\Requests\UpdateGareRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GareController extends Controller
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
    public function store(StoreGareRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Gare $gare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gare $gare)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGareRequest $request, Gare $gare)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gare $gare)
    {
        //
    }
}
