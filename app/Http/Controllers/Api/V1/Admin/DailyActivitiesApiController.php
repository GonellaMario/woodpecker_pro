<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDailyActivityRequest;
use App\Http\Requests\UpdateDailyActivityRequest;
use App\Http\Resources\Admin\DailyActivityResource;
use App\Models\DailyActivity;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DailyActivitiesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('daily_activity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DailyActivityResource(DailyActivity::with(['user', 'service'])->get());
    }

    public function store(StoreDailyActivityRequest $request)
    {
        $dailyActivity = DailyActivity::create($request->all());

        return (new DailyActivityResource($dailyActivity))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DailyActivity $dailyActivity)
    {
        abort_if(Gate::denies('daily_activity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DailyActivityResource($dailyActivity->load(['user', 'service']));
    }

    public function update(UpdateDailyActivityRequest $request, DailyActivity $dailyActivity)
    {
        $dailyActivity->update($request->all());

        return (new DailyActivityResource($dailyActivity))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DailyActivity $dailyActivity)
    {
        abort_if(Gate::denies('daily_activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dailyActivity->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
