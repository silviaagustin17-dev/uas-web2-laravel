<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    // Ini kuncinya: Menentukan tabel mana yang ditarik
    protected $table = 'prodis'; 
    protected $fillable = ['nama_prodi', 'kode_prodi'];
}