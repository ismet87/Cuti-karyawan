<?php
namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShiftController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Query shifts dengan pagination
        $shifts = Shift::with('karyawan')
            ->when($search, function ($query, $search) {
                return $query->whereHas('karyawan', function ($query) use ($search) {
                    $query->where('nama', 'like', '%' . $search . '%');
                });
            })
            ->when($startDate, function ($query, $startDate) {
                return $query->where('tanggal_shift', '>=', $startDate);
            })
            ->when($endDate, function ($query, $endDate) {
                return $query->where('tanggal_shift', '<=', $endDate);
            })
            ->orderBy('tanggal_shift', 'asc')
            ->paginate(10);
    
        // Transformasi data shifts untuk menghitung lama kerja
        $shifts->getCollection()->transform(function ($shift) {
            // if ($shift->jam_masuk && $shift->jam_keluar) {
            //     $jamMasuk = Carbon::parse($shift->jam_masuk);
            //     $jamKeluar = Carbon::parse($shift->jam_keluar);
        
            //     // Tangani kasus lintas hari
            //     if ($jamKeluar->lessThan($jamMasuk)) {
            //         $jamKeluar->addDay(); // Tambahkan satu hari ke jam keluar
            //     }
        
            //     // Hitung lama kerja dalam menit
            //     $lamaKerja = $jamKeluar->diffInMinutes($jamMasuk);
        
            //     // Simpan hasil lama kerja (dalam menit) ke shift
            //     $shift->lama_kerja = $lamaKerja;
            // } else {
            //     $shift->lama_kerja = 0; // Jika jam tidak tersedia
            // }
        
            return $shift;
        });
        
        return view('shifts.index', compact('shifts', 'search', 'startDate', 'endDate'));
    }
    
    
    public function create()
    {
        $karyawans = Karyawan::all();
        return view('shifts.create', compact('karyawans'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal_shift' => 'required|date',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'required|date_format:H:i',
        ]);

        // Logika menentukan shift
        $waktu_shift = $this->tentukanShift($request->jam_masuk, $request->jam_keluar);
        $lama_kerja = $this->hitungLamaKerja($request->jam_masuk, $request->jam_keluar);

        Shift::create([
            'karyawan_id' => $request->karyawan_id,
            'tanggal_shift' => $request->tanggal_shift,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'waktu_shift' => $waktu_shift,
            'lama_kerja' => $lama_kerja,  // Pastikan ini ada
        ]);

        return redirect()->route('shifts.index')->with('success', 'Shift berhasil ditambahkan!');
    }

    private function tentukanShift($jam_masuk, $jam_keluar)
    {
        $shift_times = [
            'Pagi' => ['start' => '06:00', 'end' => '12:00'],
            'Siang' => ['start' => '12:00', 'end' => '18:00'],
            'Sore' => ['start' => '18:00', 'end' => '24:00'],
            'Malam' => ['start' => '00:00', 'end' => '06:00'],
        ];

        foreach ($shift_times as $shift => $time) {
            if (
                $jam_masuk >= $time['start'] &&
                $jam_masuk < $time['end'] &&
                $jam_keluar <= $time['end']
            ) {
                return $shift;
            }
        }

        return 'Tidak Diketahui'; // Jika tidak sesuai aturan
    }
   private function hitungLamaKerja($jam_masuk, $jam_keluar, $tampilkan_menit_saja = false)
{
    // // Mengonversi jam_masuk dan jam_keluar menjadi objek DateTime
    // $masuk = \Carbon\Carbon::createFromFormat('H:i', $jam_masuk);
    // $keluar = \Carbon\Carbon::createFromFormat('H:i', $jam_keluar);

    // if ($tampilkan_menit_saja) {
    //     // Mengembalikan total menit saja
    //     return $keluar->diffInMinutes($masuk);
    // }

    // // Menghitung selisih waktu
    // $lama_kerja = $keluar->diff($masuk);
    
    // echo $selisih->days." Hari";

    // // Mengembalikan dalam format "x jam y menit"
    // // return $lama_kerja->format('%h jam %i menit');
    // return $lama_kerja;

    $tgl = date("Y-m-d");
    $masuk  = strtotime($tgl.' '.$jam_masuk.':00');
    $keluar = strtotime($tgl.' '.$jam_keluar.':00');
                                        
    $selisih  = $keluar - $masuk;
    $menit = floor($selisih/60);
    return $menit;								
}

    public function destroy($id)
    {
        // Mencari data shift berdasarkan ID
        $shifts = Shift::findOrFail($id);

        // Menghapus data shift
        $shifts->delete();

        // Mengarahkan kembali ke halaman shift dengan pesan sukses
        return redirect()->route('shifts.index')->with('success', 'Shift berhasil dihapus!');
    }
}
