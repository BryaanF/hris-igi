<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekrutmen extends Model
{
    use HasFactory;
    protected $table = 'rekrutmen';
    protected $primaryKey = 'id_rekrutmen';
    public function DataKaryawan()
    {
        return $this->belongsTo(DataKaryawan::class);
    }

}
