<?php

namespace App\Http\Requests\Kehadiran;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SimpanKehadiranRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', 'in:hadir,izin,alpa'],
            'catatan' => ['nullable', 'string', 'max:255'],
        ];
    }

        public function messages(): array
    {
        return [
            'status.required' => 'Status kehadiran wajib dipilih.',
            'status.in' => 'Status kehadiran tidak valid.',
            'catatan.max' => 'Catatan maksimal 255 karakter.',
        ];
    }
}
