<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cepeel extends Model
{
    use HasFactory;

    protected $table = 'cepeels';
    protected $fillable = ['kode_cpl','keterangan'];
    protected $primaryKey = 'id';
}
