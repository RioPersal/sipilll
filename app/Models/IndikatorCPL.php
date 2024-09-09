<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorCPL extends Model
{
    use HasFactory;

    protected $table = 'indikator_cpl';
    protected $fillable = ['id_cpl','indikator','ket_indikator'];
    protected $primaryKey = 'id';
}
