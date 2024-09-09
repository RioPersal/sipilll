<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoRPS extends Model
{
    use HasFactory;

    protected $table = 'info_rps';
    protected $fillable = ['*'];
    protected $primaryKey = 'id';
}
