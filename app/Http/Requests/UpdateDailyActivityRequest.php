<?php

namespace App\Http\Requests;

use App\Models\DailyActivity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDailyActivityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('daily_activity_edit');
    }

    public function rules()
    {
        return [
            'day' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'worktime' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
