<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function rekapEvent()
{
    // Mengambil semua data event untuk direkap
    $events = \App\Models\Event::all();
    
    // Pastikan mengarah ke 'reports.rekap' (sesuai folder dan nama file)
    return view('reports.rekap', compact('events'));
}
}