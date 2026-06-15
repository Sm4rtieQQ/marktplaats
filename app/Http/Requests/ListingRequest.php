<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:24',
            'description' => 'required|min:3',
            'price' => 'gte:0|lte:1000'
        ];
    }


    public function messages(): array
    {
        $requireMessage = 'Dit veld is verplicht';
        return [
            'name.required' => $requireMessage,
            'name.min' => 'Dit veld moet ten minste 3 karakters bevatten.',
            'name.max' => 'Dit veld mag maximaal 24 karakters bevatten',
            'description.required' => $requireMessage,
            'price.gte' => 'De vraagprijs mag niet negatief zijn',
            'price.lte' => 'De vraagprijs kan niet hoger dan €1.000 euro zijn',
        ];
    }
}
