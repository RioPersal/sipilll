<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianRPS extends Model
{
    use HasFactory;

    protected $table = 'rincian_rps';
    protected $fillable = ['*'];
    protected $primaryKey = 'id';
}
