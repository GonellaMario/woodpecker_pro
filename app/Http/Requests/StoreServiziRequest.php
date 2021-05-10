<?php

namespace App\Http\Requests;

use App\Models\Servizi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreServiziRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('servizi_create');
    }

    public function rules()
    {
        return [
            'nome_servizio' => [
                'string',
                'nullable',
            ],
        ];
    }
}
