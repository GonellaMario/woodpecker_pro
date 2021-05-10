<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyServiziRequest;
use App\Http\Requests\StoreServiziRequest;
use App\Http\Requests\UpdateServiziRequest;
use App\Models\Servizi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiziController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('servizi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servizis = Servizi::all();

        return view('admin.servizis.index', compact('servizis'));
    }

    public function create()
    {
        abort_if(Gate::denies('servizi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.servizis.create');
    }

    public function store(StoreServiziRequest $request)
    {
        $servizi = Servizi::create($request->all());

        return redirect()->route('admin.servizis.index');
    }

    public function edit(Servizi $servizi)
    {
        abort_if(Gate::denies('servizi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.servizis.edit', compact('servizi'));
    }

    public function update(UpdateServiziRequest $request, Servizi $servizi)
    {
        $servizi->update($request->all());

        return redirect()->route('admin.servizis.index');
    }

    public function show(Servizi $servizi)
    {
        abort_if(Gate::denies('servizi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servizi->load('serviceDailyActivities');

        return view('admin.servizis.show', compact('servizi'));
    }

    public function destroy(Servizi $servizi)
    {
        abort_if(Gate::denies('servizi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servizi->delete();

        return back();
    }

    public function massDestroy(MassDestroyServiziRequest $request)
    {
        Servizi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
