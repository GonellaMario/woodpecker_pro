@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.team.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.teams.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="team_name">{{ trans('cruds.team.fields.team_name') }}</label>
                <input class="form-control {{ $errors->has('team_name') ? 'is-invalid' : '' }}" type="text" name="team_name" id="team_name" value="{{ old('team_name', '') }}">
                @if($errors->has('team_name'))
                    <span class="text-danger">{{ $errors->first('team_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.team.fields.team_name_helper') }}</span>
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