<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use App\Models;
use App\Enum;
use App\Http\Resources;

class JobController extends Controller
{
    private Enum\State $state;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $employer_id = $request->query('employer_id');

        if (isset($employer_id)) {
            Log::debug("employer_id: " . $employer_id);
            $c = collect(['data' => $employer_id]);

            $validator = Validator::make($request->query(), [
                'employer_id' => 'numeric',
            ]);

            if ($validator->fails()) {
                Log::debug("error on employer_id: " . $employer_id);

                return $validator->errors()->all();
            }

            $validated = $validator->validated();

            if (isset($validated['employer_id'])) {
                //$result = Resources\JobResource::collection(Models\Job::all()->where('employer_has_worker_employer_id', $validated['employer_id']));

                $result = Models\Job::with('jobState')->where('employer_has_worker_employer_id', $validated['employer_id'])->get();

                //Log::debug("result on employer_id: " . $employer_id . ":" . $result->toJson() . " count:" .$result->count() );
                //Log::debug("result on employer_id: " . $employer_id . ":" . $result->toJson() . " count:" .$result->count() );

                if ($result->count() == 0) {
                    return response()->noContent();
                }

                $data = collect(['data' => $result]);

                //Log::debug("result on employer_id [" . $employer_id . "]:" . $data->toJson(JSON_UNESCAPED_UNICODE) . " | count:" .$result->count() );
                //$result = $data->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

                $result = response()->json($data);

            } else {
                $result = Resources\JobResource::collection(Models\Job::all());
            }
        }

        $worker_id = $request->query('worker_id');

        if (isset($worker_id)) {
            Log::debug("worker_id: " . $worker_id);
            $c = collect(['data' => $worker_id]);

            $validator = Validator::make($request->query(), [
                'worker_id' => 'numeric',
            ]);

            if ($validator->fails()) {
                Log::debug("error on worker_id: " . $worker_id);

                return $validator->errors()->all();
            }

            $validated = $validator->validated();

            Log::debug("State:" . Enum\State::Created->value);

            if (isset($validated['worker_id']) && $validated['worker_id'] != 0) {
                $result = Models\Job::with('jobState')
                    ->where('employer_has_worker_worker_id', $validated['worker_id'])
                    ->where('job_state_id', '!=', Enum\State::Returned)
                    ->get();

                if ($result->count() == 0) {
                    return response()->noContent();
                }

                $data = collect(['data' => $result]);

                Log::debug("result on worker_id [" . $worker_id . "]:" . $data->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . " | count:" .$result->count() );
                //$result = $data->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                $result = response()->json($data);
            } else {
                $result = Resources\JobResource::collection(Models\Job::all());
            }

            if (isset($validated['worker_id']) && $validated['worker_id'] == 0) {
                $result = Models\Job::with('jobState')
                    ->where('job_state_id', Enum\State::Created)
                    ->get();

                if ($result->count() == 0) {
                    return response()->noContent();
                }

                $data = collect(['data' => $result]);

                Log::debug("result on worker_id [" . $worker_id . "]:" . $data->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . " | count:" .$result->count() );
                //$result = $data->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                $result = response()->json($data);

            }
        }

        $not_worker_id = $request->query('not_worker_id');

        if (isset($not_worker_id)) {

            $validator = Validator::make($request->query(), [
                'not_worker_id' => 'numeric',
            ]);

            if ($validator->fails()) {
                Log::debug("error on not_worker_id: " . $not_worker_id);

                return $validator->errors()->all();
            }

            $validated = $validator->validated();

            if (isset($validated['not_worker_id']) && $validated['not_worker_id'] != 0) {
                $result = Models\Job::with('jobState')
                    ->where('employer_has_worker_employer_id', "!=", $validated['not_worker_id'])
                    ->where('job_state_id', Enum\State::Created)
                    ->get();

                if ($result->count() == 0) {
                    return response()->noContent();
                }

                $data = collect(['data' => $result]);

                Log::debug("result on not_worker_id [" . $worker_id . "]:" . $data->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . " | count:" .$result->count() );
                //$result = $data->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                $result = response()->json($data);
            } else {
                $result = Resources\JobResource::collection(Models\Job::all());
            }

        }

        //return $c->toJson();



        return $result;
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
    public function show(Models\Job $job)
    {
        return new Resources\JobResource($job);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Models\Job $job)
    {
        $worker_id = $request->worker_id;
        $employer_id = $request->employer_id;
        $job_state_id = $request->job_state_id;
        //$id = $request->id;

        Log::debug("request:" . $request->collect()->toJson());
        Log::debug("id:" . $job->id);

        if (isset($worker_id)) {
            Log::debug("worker_id:" . $worker_id);
        }

        if (isset($employer_id)) {
            Log::debug("employer_id:" . $employer_id);
        }

        Log::debug("job_state_id:" . $job_state_id);

        if (isset($worker_id)) {
            $job->update([
                'job_state_id' => $job_state_id,
                'employer_has_worker_worker_id' => $worker_id,
            ]);
        }

        if (isset($employer_id)) {
            $job->update([
                'job_state_id' => $job_state_id,
            ]);
        }

        if (isset($worker_id)) {
            $result = Models\Job::where('employer_has_worker_employer_id', "!=", $worker_id)->where('job_state_id', Enum\State::Created)->get();
        }

        if (isset($employer_id)) {
            $result = Models\Job::where('employer_has_worker_worker_id', "!=", $employer_id)->where('job_state_id', '!=', Enum\State::Created)->get();
        }

        if ($result->count() == 0) {
            return response()->noContent();
        }

        $data = collect(['data' => $result]);

        Log::debug("result on not_worker_id [" . $worker_id . "]:" . $data->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . " | count:" .$result->count() );
        $result = $data->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Models\Job $job)
    {
        //
    }
}
