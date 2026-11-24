<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Event extends Model
{
    public $timestamps = false;

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

}
