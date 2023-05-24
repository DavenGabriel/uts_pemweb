<?php

namespace App\Http\Requests;

use App\Models\Supir;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSupirRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('supir_create');
    }

    public function rules()
    {
        return [
            'nama' => [
                'string',
                'required',
            ],
            'nomor' => [
                'string',
                'required',
            ],
            'gender' => [
                'string',
                'required',
            ],
            'status' => [
                'string',
                'required',
            ],
            'rating' => [
                'string',
                'required',
            ],
        ];
    }
}
