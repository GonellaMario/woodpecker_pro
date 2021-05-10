@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.servizi.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.servizis.update", [$servizi->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nome_servizio">{{ trans('cruds.servizi.fields.nome_servizio') }}</label>
                <input class="form-control {{ $errors->has('nome_servizio') ? 'is-invalid' : '' }}" type="text" name="nome_servizio" id="nome_servizio" value="{{ old('nome_servizio', $servizi->nome_servizio) }}">
                @if($errors->has('nome_servizio'))
                    <span class="text-danger">{{ $errors->first('nome_servizio') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.servizi.fields.nome_servizio_helper') }}</span>
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