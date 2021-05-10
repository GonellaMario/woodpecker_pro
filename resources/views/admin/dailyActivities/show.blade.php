@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dailyActivity.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daily-activities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyActivity.fields.id') }}
                        </th>
                        <td>
                            {{ $dailyActivity->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyActivity.fields.user') }}
                        </th>
                        <td>
                            {{ $dailyActivity->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyActivity.fields.service') }}
                        </th>
                        <td>
                            {{ $dailyActivity->service->nome_servizio ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyActivity.fields.day') }}
                        </th>
                        <td>
                            {{ $dailyActivity->day }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dailyActivity.fields.worktime') }}
                        </th>
                        <td>
                            {{ $dailyActivity->worktime }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.daily-activities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection