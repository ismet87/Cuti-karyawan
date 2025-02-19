<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapShift extends Model
{
    use HasFactory;

    protected $table = 'shifts'; // Nama tabel di database
    protected $fillable = ['tanggal', 'karyawan_id', 'shift']; // Sesuaikan dengan kolom yang ada di tabel

     // Relasi ke tabel Karyawan
     public function karyawan()
     {
         return $this->belongsTo(Karyawan::class);
     }
}
