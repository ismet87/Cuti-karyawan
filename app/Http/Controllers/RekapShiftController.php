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
        // Mengambil semua data karyawan
        $karyawan = Karyawan::all();

        // Query ke tabel rekap_shift menggunakan model RekapShift
        $rekapshifts2 = RekapShift::query();

        // Query menggunakan Query Builder
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

        // Filter berdasarkan nama (menggunakan query builder untuk `$rekapshifts`)
        if ($request->filled('nama')) {
            $rekapshifts->where('karyawans.nama', 'like', '%' . $request->nama . '%');
            $rekapshifts2->whereHas('karyawan', function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->nama . '%');
            });
        }

        // Filter berdasarkan tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $rekapshifts->whereBetween('shifts.tanggal_shift', [$request->start_date, $request->end_date]);
            $rekapshifts2->whereBetween('tanggal_shift', [$request->start_date, $request->end_date]);
        }

        // Mengirimkan data ke view
        return view('rekap-shift.index', [
            'karyawan' => $karyawan,
            'rekapshifts' => $rekapshifts->get(), // Data query builder
            'rekapshifts2' => $rekapshifts2->get() // Data Eloquent model RekapShift
        ]);
    }
}
