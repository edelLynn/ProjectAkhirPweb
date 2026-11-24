<?php

namespace App\Http\Requests\Peserta;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Dipakai untuk tambah (store) dan ubah (update) peserta.
 * Kalau di URL ada {participant}, berarti sedang mengubah data.
 */
class ParticipantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // pembatasan akses sudah dilakukan middleware role:admin
    }

    public function rules(): array
    {
        $id = $this->route('participant'); // null saat tambah

        return [
            'name'  => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100', Rule::unique('users', 'email')->ignore($id)],
            'nim'   => ['required', 'digits:12', Rule::unique('users', 'nim')->ignore($id)],
            'prodi' => ['nullable', 'string', 'max:100'],
            'no_hp' => ['nullable', 'digits_between:10,15'],
        ] + ($id ? [] : [
            // Password awal hanya diisi saat tambah. Admin tidak bisa mengubahnya lagi;
            // yang boleh mengganti hanya pemilik akun (lihat PasswordController).
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function attributes(): array
    {
        return [
            'name'     => 'Nama',
            'email'    => 'Email',
            'nim'      => 'NIM',
            'prodi'    => 'Prodi',
            'no_hp'    => 'No HP',
            'password' => 'Password',
        ];
    }

    public function messages(): array
    {
        return [
            'required'       => ':attribute wajib diisi.',
            'email'          => 'Format email tidak valid.',
            'unique'         => ':attribute sudah dipakai peserta lain.',
            'digits'         => ':attribute harus berupa :digits digit angka.',
            'digits_between' => ':attribute harus berupa angka :min sampai :max digit.',
            'max.string'     => ':attribute maksimal :max karakter.',
            'min.string'     => ':attribute minimal :min karakter.',
            'confirmed'      => 'Konfirmasi password tidak sama.',
        ];
    }
}
