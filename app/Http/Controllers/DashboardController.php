<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Mengalihkan halaman otomatis sesuai role setelah login
        if ($user->role == 'hima') {
            return redirect()->route('tracking.status'); // Otomatis ke tracking HIMA
        } elseif ($user->role == 'sekjur') {
            return redirect()->route('sekjur.endorsement'); // Otomatis ke meja Sekjur
        } elseif ($user->role == 'kaprodi') {
            return redirect()->route('kaprodi.review'); // Otomatis ke meja Kaprodi
        } elseif ($user->role == 'dekan') {
            return redirect()->route('dekan.approval'); // Otomatis ke meja Dekan
        }

        return abort(403, 'Role tidak dikenali');
    }
}