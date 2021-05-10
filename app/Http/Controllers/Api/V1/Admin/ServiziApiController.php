<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiziRequest;
use App\Http\Requests\UpdateServiziRequest;
use App\Http\Resources\Admin\ServiziResource;
use App\Models\Servizi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiziApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('servizi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServiziResource(Servizi::all());
    }

    public function store(StoreServiziRequest $request)
    {
        $servizi = Servizi::create($request->all());

        return (new ServiziResource($servizi))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Servizi $servizi)
    {
        abort_if(Gate::denies('servizi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ServiziResource($servizi);
    }

    public function update(UpdateServiziRequest $request, Servizi $servizi)
    {
        $servizi->update($request->all());

        return (new ServiziResource($servizi))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Servizi $servizi)
    {
        abort_if(Gate::denies('servizi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $servizi->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
