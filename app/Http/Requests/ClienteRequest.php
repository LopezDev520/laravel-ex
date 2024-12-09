<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
        if (request()->isMethod("POST")) {
            return [
                "name" => "required",
                "document" => "required|unique:clients",
                "address" => "required",
                "phone" => "required",
                "email" => "required",
                "photo" => "nullable|mimes:jpg,jpeg,png|max:6000",
                "email" => "required",
                "status" => "nullable",
                "registered_by" => "nullable"
            ];
        } else if (request()->isMethod("PUT")) {
            return [];
        }
    }
}
