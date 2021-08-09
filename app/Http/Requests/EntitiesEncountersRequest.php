<?php

namespace App\Http\Requests;

use App\Models\Chapter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EntitiesEncountersRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'entities.*' => 'exists:entities,name',
            'type' => [
                'required',
                Rule::in(Chapter::getAvailableTypes()),
            ],
        ];
    }
}
