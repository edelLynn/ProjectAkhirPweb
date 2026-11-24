<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "registration_id",
        "status",
        "waktu_dicatat",
        "catatan",
    ];

    public function casts(): array
    {
        return [
            "waktu_dicatat" => "datetime",
        ];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
