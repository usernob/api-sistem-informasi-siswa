<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function defaultRules(): array
    {
        return [
            "nama" => [
                "required",
                "string",
                "max:255"
            ],
            "alamat" => [
                "required",
                "string",
                "max:255"
            ],
            "nomor_telepon" => [
                "required",
                "string",
                "max:255"
            ],
            "jenis_kelamin" => [
                "required",
                Rule::in(["laki-laki", "perempuan"])
            ],
            "kelas_id" => [
                "nullable",
                "exists:App\Models\Kelas,_id"
            ]
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
