<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;
    protected $table = 'cuti';
    protected $primaryKey = 'id_cuti';

    public function dataKaryawan()
    {
        return $this->belongsTo(DataKaryawan::class, 'data_karyawan_id');
    }
}
