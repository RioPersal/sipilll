<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengampu extends Model
{
    use HasFactory;

    protected $table = 'pengampu';
    protected $fillable = ['id_matkul','id_pengampu','id_koordinator'];
    protected $primaryKey = 'id';
}
