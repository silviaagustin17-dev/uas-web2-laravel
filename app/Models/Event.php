<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    // Kolom wajib didaftarkan agar $request->all() bisa berfungsi
    protected $fillable = [
        'nama_event', 
        'tanggal', 
        'lokasi', 
        'deskripsi'
    ];
}