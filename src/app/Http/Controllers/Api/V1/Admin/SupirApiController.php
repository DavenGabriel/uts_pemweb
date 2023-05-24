<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupirRequest;
use App\Http\Requests\UpdateSupirRequest;
use App\Http\Resources\Admin\SupirResource;
use App\Models\Supir;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupirApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('supir_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupirResource(Supir::all());
    }

    public function store(StoreSupirRequest $request)
    {
        $supir = Supir::create($request->all());

        return (new SupirResource($supir))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Supir $supir)
    {
        abort_if(Gate::denies('supir_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SupirResource($supir);
    }

    public function update(UpdateSupirRequest $request, Supir $supir)
    {
        $supir->update($request->all());

        return (new SupirResource($supir))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Supir $supir)
    {
        abort_if(Gate::denies('supir_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supir->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
