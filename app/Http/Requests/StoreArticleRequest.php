<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'titre' => 'required|string|min:5|max:50',
            'domaine' => 'required|string|max:50',
            'contenu' => 'required|string|min:10|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
