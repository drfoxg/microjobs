<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources;
use App\Models\JobState;


class JobStateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Resources\JobStateResource::collection(JobState::all());
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
    public function show(JobState $jobStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobState $jobStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobState $jobStatus)
    {
        //
    }
}
