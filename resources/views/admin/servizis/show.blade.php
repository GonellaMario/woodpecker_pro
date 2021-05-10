@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.servizi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.servizis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.servizi.fields.id') }}
                        </th>
                        <td>
                            {{ $servizi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.servizi.fields.nome_servizio') }}
                        </th>
                        <td>
                            {{ $servizi->nome_servizio }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.servizis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#service_daily_activities" role="tab" data-toggle="tab">
                {{ trans('cruds.dailyActivity.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="service_daily_activities">
            @includeIf('admin.servizis.relationships.serviceDailyActivities', ['dailyActivities' => $servizi->serviceDailyActivities])
        </div>
    </div>
</div>

@endsection