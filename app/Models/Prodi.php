<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    
    // Pastikan kepala_prodi sudah didaftarkan di sini
    protected $fillable = ['nama_prodi', 'kode_prodi', 'kepala_prodi'];
}