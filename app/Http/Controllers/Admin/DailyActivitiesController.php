<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyDailyActivityRequest;
use App\Http\Requests\StoreDailyActivityRequest;
use App\Http\Requests\UpdateDailyActivityRequest;
use App\Models\DailyActivity;
use App\Models\Servizi;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DailyActivitiesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('daily_activity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DailyActivity::with(['user', 'service'])->select(sprintf('%s.*', (new DailyActivity())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'daily_activity_show';
                $editGate = 'daily_activity_edit';
                $deleteGate = 'daily_activity_delete';
                $crudRoutePart = 'daily-activities';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->addColumn('service_nome_servizio', function ($row) {
                return $row->service ? $row->service->nome_servizio : '';
            });

            $table->editColumn('worktime', function ($row) {
                return $row->worktime ? $row->worktime : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'service']);

            return $table->make(true);
        }

        return view('admin.dailyActivities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('daily_activity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Servizi::all()->pluck('nome_servizio', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.dailyActivities.create', compact('users', 'services'));
    }

    public function store(StoreDailyActivityRequest $request)
    {
        $dailyActivity = DailyActivity::create($request->all());

        return redirect()->route('admin.daily-activities.index');
    }

    public function edit(DailyActivity $dailyActivity)
    {
        abort_if(Gate::denies('daily_activity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Servizi::all()->pluck('nome_servizio', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dailyActivity->load('user', 'service');

        return view('admin.dailyActivities.edit', compact('users', 'services', 'dailyActivity'));
    }

    public function update(UpdateDailyActivityRequest $request, DailyActivity $dailyActivity)
    {
        $dailyActivity->update($request->all());

        return redirect()->route('admin.daily-activities.index');
    }

    public function show(DailyActivity $dailyActivity)
    {
        abort_if(Gate::denies('daily_activity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dailyActivity->load('user', 'service');

        return view('admin.dailyActivities.show', compact('dailyActivity'));
    }

    public function destroy(DailyActivity $dailyActivity)
    {
        abort_if(Gate::denies('daily_activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dailyActivity->delete();

        return back();
    }

    public function massDestroy(MassDestroyDailyActivityRequest $request)
    {
        DailyActivity::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
