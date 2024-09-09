<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaprodi extends Model
{
    use HasFactory;

    protected $table = 'kaprodis';
    protected $fillable = ['nama','gelar_depan','gelar_belakang'];
    protected $primaryKey = 'id';
}
