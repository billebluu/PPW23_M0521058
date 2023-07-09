<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $table = "admission";

    protected $fillable = [
        'user_id',
        'program_studi',
        'status',
        'payment_status',
        'tgl_pendaftaran',
        'jalur_ujian',
        'sertif_utbk',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
