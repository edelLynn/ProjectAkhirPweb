<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = false;
    protected $fillable = ['name', 'email', 'password', 'role', 'nim', 'no_hp', 'prodi'];

    protected $hidden = ['password', 'remember_token'];

    // 'hashed' = password otomatis di-hash saat disimpan
    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    // Filter: hanya user dengan role mahasiswa (= "peserta")
    public function scopeMahasiswa(Builder $query): Builder
    {
        return $query->where('role', 'mahasiswa');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
}
