<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiswaRequest extends StoreSiswaRequest
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
        return array_map(function ($value) {
            if (in_array("required", $value)) {
                $value = array_diff($value, ["required"]); // Hapus "required"
                array_unshift($value, "nullable"); // Tambahkan "nullable" di awal
            }
            return $value;
        }, $this->defaultRules());
    }
}
