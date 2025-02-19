<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    protected $table = 'karyawans';
    protected $fillable = ['nik', 'nama', 'tgl_lahir', 'status', 'tgl_masuk'];
}
