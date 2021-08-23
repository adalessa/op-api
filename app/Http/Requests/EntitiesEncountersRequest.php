<?php

namespace App\Http\Requests;

use App\EntityTypesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EntitiesEncountersRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'entities.*' => 'required|exists:aliases,name',
            'type' => [
                'required',
                Rule::in(array_keys(EntityTypesEnum::map)),
            ],
        ];
    }
}
