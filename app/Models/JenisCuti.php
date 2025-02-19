<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    protected $table = 'jenis_cuti';
    protected $fillable = ['nama', 'is_wajib', 'keterangan'];

    public function cutis()
{
    return $this->hasMany(Cuti::class, 'jenis_cuti_id');
}

}
