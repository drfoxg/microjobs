<?php

namespace App\Http\Resources;

use App\Http\Resources\JobStateResource as ResourcesJobStateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models;
use App\Models\JobState;
use Illuminate\Support\Facades\Log;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //Log::debug(Models\Job::find($this->id)->jobState);
        //$result = Models\Job::with('jobState')->get();
        //Log::debug(count($result));


        //return [
            //'id' => $this->id,
            //'title' => $this->title,
            //'job_state_id' => $this->job_state_id,
            //'job_state_name' => Models\Job::find($this->id)->jobState->name,
            //'job_state_id' => Models\Job::with('jobState')->get(),
            //'job_state_id_res' => new JobStateResource(collect($this->job_state_id)),

        //];
        return parent::toArray($request);
    }
}

