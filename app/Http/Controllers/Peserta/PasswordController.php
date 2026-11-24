<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Http\Requests\Peserta\ChangePasswordRequest;
use Illuminate\Http\RedirectResponse;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('auth.password');
    }

    public function update(ChangePasswordRequest $request): RedirectResponse
    {
        // Selalu akun yang sedang login, bukan id dari URL/form,
        // jadi tidak ada cara mengubah password akun orang lain.
        $request->user()->update(['password' => $request->validated('password')]);

        return redirect()->route('password.edit')
            ->with('success', 'Password berhasil diganti.');
    }
}
