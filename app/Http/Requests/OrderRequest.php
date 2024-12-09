<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'total' => 'required|numeric|min:0',
            'date' => 'required',
            'route' => 'nullable|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'El cliente es obligatorio.',
            'client_id.exists' => 'El cliente no existe.',
            'total.required' => 'El total es obligatorio.',
            'total.numeric' => 'El total debe ser un número.',
            'fecha.required' => 'La fecha es obligatoria.',
            'ruta.required' => 'La ruta es obligatoria.',
            'product_id.required' => 'Debe agregar al menos un producto.',
            'quantity.*.min' => 'La cantidad debe ser al menos 1.'
        ];
    }
}
