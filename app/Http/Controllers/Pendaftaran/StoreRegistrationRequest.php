<?php

namespace App\Http\Requests\Pendaftaran;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'event_id' => ['required', 'integer', 'exists:events,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'event_id.required' => 'Silakan pilih kegiatan terlebih dahulu.',
            'event_id.integer' => 'Pilihan kegiatan tidak valid.',
            'event_id.exists' => 'Kegiatan yang dipilih tidak ditemukan.',
        ];
    }
}