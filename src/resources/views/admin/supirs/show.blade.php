@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.supir.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supirs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.supir.fields.id_supir') }}
                        </th>
                        <td>
                            {{ $supir->id_supir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supir.fields.nama') }}
                        </th>
                        <td>
                            {{ $supir->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supir.fields.nomor') }}
                        </th>
                        <td>
                            {{ $supir->nomor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supir.fields.gender') }}
                        </th>
                        <td>
                            {{ $supir->gender }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supir.fields.status') }}
                        </th>
                        <td>
                            {{ $supir->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supir.fields.rating') }}
                        </th>
                        <td>
                            {{ $supir->rating }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supirs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection