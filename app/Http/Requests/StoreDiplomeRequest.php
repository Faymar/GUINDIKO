<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiplomeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'libele'=>'required|string',
            // 'fichier'=>'nullable|mimes:pdf,doc,docx,png,jpeg,jpg',
            'description'=>'nullable|string',
            'dateObtention'=>'required|date',
        ];
    }
}
