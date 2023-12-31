<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExperienceRequest extends FormRequest
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
            'titre' => ['required', 'string', 'max:50'],
            'entreprise' => ['required', 'string', 'max:200'],
            'fichier' => ['nullable', 'file', 'max:1024'],
            'tache' => ['required', 'string', 'max:500'],
            'dateDebut' => ['required', 'date'],
            'dateFin' => ['required', 'date'],
        ];
    }
}
