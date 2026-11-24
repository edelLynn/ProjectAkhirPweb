<?php

namespace App\Http\Requests\Peserta;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // route sudah dilindungi middleware auth
    }

    public function rules(): array
    {
        return [
            // 'current_password' = cocokkan dengan password akun yang sedang login
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'string', 'min:8', 'confirmed', 'different:current_password'],
        ];
    }

    public function attributes(): array
    {
        return [
            'current_password' => 'Password saat ini',
            'password'         => 'Password baru',
        ];
    }

    public function messages(): array
    {
        return [
            'required'         => ':attribute wajib diisi.',
            'current_password' => 'Password saat ini salah.',
            'min.string'       => ':attribute minimal :min karakter.',
            'confirmed'        => 'Konfirmasi password baru tidak sama.',
            'different'        => 'Password baru harus berbeda dari password saat ini.',
        ];
    }
}
