<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';
    protected $fillable = [
        'karyawan_id', 'tgl_awal', 'tgl_akhir', 'lama_cuti', 'keterangan', 'jenis_cuti_id', 'tgl_entri'
    ];

    public function jenisCuti()
    {
        return $this->belongsTo(JenisCuti::class, 'jenis_cuti_id');
    }
     // Relasi ke model Karyawan
     public function karyawan()
     {
         return $this->belongsTo(Karyawan::class, 'karyawan_id');
     }
}
