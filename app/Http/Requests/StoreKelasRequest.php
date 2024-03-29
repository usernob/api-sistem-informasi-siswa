<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKelasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function defaultRules()
    {
        return [
            "kelas" => [
                "required",
                Rule::in(["X", "XI", "XII"])
            ],
            "jurusan" => [
                "required",
                Rule::in(["RPL", "DPIB", "KGSP", "TB", "AKL", "TPTU"])
            ],
            "suffix" => [
                "required",
                "uppercase",
                "max:1"
            ],
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->defaultRules();
    }
}
