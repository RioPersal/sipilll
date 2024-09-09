<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;

    protected $table = 'matkuls';
    protected $fillable = ['kode_matkul','nama_matkul','semester','sks'];
    protected $primaryKey = 'id';
}
