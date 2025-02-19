<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryCuti extends Model
{
    protected $table = 'history_cuti';
    protected $fillable = ['nama', 'sisa_cuti'];
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
