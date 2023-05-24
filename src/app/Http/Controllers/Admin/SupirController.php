<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySupirRequest;
use App\Http\Requests\StoreSupirRequest;
use App\Http\Requests\UpdateSupirRequest;
use App\Models\Supir;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SupirController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('supir_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Supir::query()->select(sprintf('%s.*', (new Supir)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'supir_show';
                $editGate      = 'supir_edit';
                $deleteGate    = 'supir_delete';
                $crudRoutePart = 'supirs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id_supir', function ($row) {
                return $row->id_supir ? $row->id_supir : '';
            });
            $table->editColumn('nama', function ($row) {
                return $row->nama ? $row->nama : '';
            });
            $table->editColumn('nomor', function ($row) {
                return $row->nomor ? $row->nomor : '';
            });
            $table->editColumn('gender', function ($row) {
                return $row->gender ? $row->gender : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });
            $table->editColumn('rating', function ($row) {
                return $row->rating ? $row->rating : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.supirs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('supir_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supirs.create');
    }

    public function store(StoreSupirRequest $request)
    {
        $supir = Supir::create($request->all());

        return redirect()->route('admin.supirs.index');
    }

    public function edit(Supir $supir)
    {
        abort_if(Gate::denies('supir_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supirs.edit', compact('supir'));
    }

    public function update(UpdateSupirRequest $request, Supir $supir)
    {
        $supir->update($request->all());

        return redirect()->route('admin.supirs.index');
    }

    public function show(Supir $supir)
    {
        abort_if(Gate::denies('supir_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supirs.show', compact('supir'));
    }

    public function destroy(Supir $supir)
    {
        abort_if(Gate::denies('supir_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supir->delete();

        return back();
    }

    public function massDestroy(MassDestroySupirRequest $request)
    {
        $supirs = Supir::find(request('ids'));

        foreach ($supirs as $supir) {
            $supir->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
