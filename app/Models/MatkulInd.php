<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatkulInd extends Model
{
    use HasFactory;

    protected $table = 'matkul_inds';
    protected $fillable = ['id_matkul','id_indikator','bobot_indikator'];
    protected $primaryKey = 'id';
}
