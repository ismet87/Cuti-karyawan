<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['karyawan_id', 'tanggal_shift', 'jam_masuk', 'jam_keluar', 'waktu_shift','lama_kerja'];

    // Relasi ke tabel Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}

