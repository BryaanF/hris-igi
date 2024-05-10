<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKaryawan extends Model
{
    use HasFactory;
    protected $table = 'data_karyawan';
    protected $primaryKey = 'id_data_karyawan';
    public function Rekrutmen()
    {
        return $this->belongsTo(Rekrutmen::class);
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
