<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\RekapShift;
use Illuminate\Support\Facades\DB;

class RekapShiftController extends Controller
{
    public function index(Request $request)
    {
        $karyawan = Karyawan::all(); // Mengambil semua data karyawan
        $rekapshifts2 = RekapShift::query(); // Query ke tabel rekap_shift
        $rekapshifts = DB::table('shifts')
            ->join('karyawans', 'shifts.karyawan_id', '=', 'karyawans.id')
            ->select(
                'karyawans.nama as karyawan_name',
                DB::raw('SUM(shifts.lama_kerja) as total_menit')
            )
            ->groupBy(
                'shifts.karyawan_id',
                'karyawans.nama'
            );
        
        if ($request->filled('nama')) {
            $rekapshifts->whereHas('karyawan', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->nama . '%');
            });
            $rekapshifts2->whereHas('karyawan', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->nama . '%');
            });
        }

        // Filter berdasarkan tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $rekapshifts->whereBetween('tanggal_shift', [$request->start_date, $request->end_date]);
            $rekapshifts2->whereBetween('tanggal_shift', [$request->start_date, $request->end_date]);
        }
        
        // Mengirimkan data ke view
        return view('rekap-shift.index', [
            'karyawan' => $karyawan,
            'rekapshifts' => $rekapshifts->get(), // Query tetap diarahkan ke tabel rekap_shift
            'rekapshifts2' => $rekapshifts2->get() // Query tetap diarahkan ke tabel rekap_shift
        ]);
    }
}
