<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNilaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'nilai_latsoal_1' => (int)$this->nilai_latsoal_1 ?? 0,
            'nilai_latsoal_2' => (int)$this->nilai_latsoal_2 ?? 0,
            'nilai_latsoal_3' => (int)$this->nilai_latsoal_3 ?? 0,
            'nilai_latsoal_4' => (int)$this->nilai_latsoal_4 ?? 0,
            'nilai_uh_1' => (int)$this->nilai_uh_1 ?? 0,
            'nilai_uh_2' => (int)$this->nilai_uh_2 ?? 0,
            'nilai_uts' => (int)$this->nilai_uts ?? 0,
            'nilai_uas' => (int)$this->nilai_uas ?? 0
        ]);
    }

    public function defaultRules()
    {
        return [
            "nilai_latsoal_1" => [
                "nullable",
                "integer",
                "between:0,100"
            ],
            "nilai_latsoal_2" => [
                "nullable",
                "integer",
                "between:0,100"
            ],
            "nilai_latsoal_3" => [
                "nullable",
                "integer",
                "between:0,100"
            ],
            "nilai_latsoal_4" => [
                "nullable",
                "integer",
                "between:0,100"
            ],
            "nilai_uh_1" => [
                "nullable",
                "integer",
                "between:0,100"
            ],
            "nilai_uh_2" => [
                "nullable",
                "integer",
                "between:0,100"
            ],
            "nilai_uts" => [
                "nullable",
                "integer",
                "between:0,100"
            ],
            "nilai_uas" => [
                "nullable",
                "integer",
                "between:0,100"
            ],
            "mapel" => [
                "required",
                "string",
                "max:255",
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
