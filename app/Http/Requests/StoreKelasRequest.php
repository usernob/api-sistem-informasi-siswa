<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKelasRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
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
                Rule::unique("kelas", "suffix")->where("jurusan", $this->jurusan)->where("kelas", $this->kelas),
                "uppercase",
                "max:1"
            ],
        ];
    }
}
