<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuti;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\JenisCuti; // Tambahkan model JenisCuti

class HomeController extends Controller
{
    public function index()
    {
        $totalPengajuan = Cuti::count();
        $cutiDisetujui = Cuti::where('status', 'disetujui')->count();
        $cutiDitolak = Cuti::where('status', 'ditolak')->count();
        $totalUsers = User::count();
        $totalKaryawan = Karyawan::count();
        $totalJenisCuti = JenisCuti::count(); // Hitung total jenis cuti

        return view('home', compact('totalPengajuan', 'cutiDisetujui', 'cutiDitolak', 'totalUsers', 'totalKaryawan', 'totalJenisCuti'));
    }
}
