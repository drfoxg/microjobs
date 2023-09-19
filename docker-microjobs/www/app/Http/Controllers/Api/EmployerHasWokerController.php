<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\EmployerHasWoker;
use App\Http\Resources;

class EmployerHasWokerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Resources\EmployerHasWokerResources::collection(EmployerHasWoker::all());
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
    public function show(EmployerHasWoker $employerHasWoker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployerHasWoker $employerHasWoker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployerHasWoker $employerHasWoker)
    {
        //
    }
}
