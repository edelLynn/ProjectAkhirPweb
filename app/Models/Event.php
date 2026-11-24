<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    public $timestamps = false;

    protected $fillable = ['category_id', 'judul', 'deskripsi', 'tanggal', 'waktu_mulai', 'lokasi'];

    protected function casts(): array
    {
        return ['tanggal' => 'date'];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
}
