<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKaryawan extends Model
{
    use HasFactory;
    protected $table = 'data_karyawan';
    protected $primaryKey = 'id_data_karyawan';
    public function rekrutmen()
    {
        return $this->belongsTo(Rekrutmen::class, 'rekrutmen_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
