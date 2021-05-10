@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.dailyActivity.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.daily-activities.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.dailyActivity.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dailyActivity.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_id">{{ trans('cruds.dailyActivity.fields.service') }}</label>
                <select class="form-control select2 {{ $errors->has('service') ? 'is-invalid' : '' }}" name="service_id" id="service_id">
                    @foreach($services as $id => $entry)
                        <option value="{{ $id }}" {{ old('service_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('service'))
                    <span class="text-danger">{{ $errors->first('service') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dailyActivity.fields.service_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="day">{{ trans('cruds.dailyActivity.fields.day') }}</label>
                <input class="form-control date {{ $errors->has('day') ? 'is-invalid' : '' }}" type="text" name="day" id="day" value="{{ old('day') }}">
                @if($errors->has('day'))
                    <span class="text-danger">{{ $errors->first('day') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dailyActivity.fields.day_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="worktime">{{ trans('cruds.dailyActivity.fields.worktime') }}</label>
                <input class="form-control {{ $errors->has('worktime') ? 'is-invalid' : '' }}" type="number" name="worktime" id="worktime" value="{{ old('worktime', '') }}" step="1">
                @if($errors->has('worktime'))
                    <span class="text-danger">{{ $errors->first('worktime') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.dailyActivity.fields.worktime_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection