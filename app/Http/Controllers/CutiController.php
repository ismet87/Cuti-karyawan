<?php
namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Karyawan;
use App\Models\JenisCuti;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class CutiController extends Controller
{
    public function index(Request $request)
    {
        
        $search = $request->input('search');
        $cutis = cuti::when($search, function ($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%');
        });

        // Ambil data cuti dengan join ke tabel karyawans dan jenis_cutis
        $cutis = DB::table('cuti')
            ->join('karyawans', 'cuti.karyawan_id', '=', 'karyawans.id')
            ->join('jenis_cuti', 'cuti.jenis_cuti_id', '=', 'jenis_cuti.id')
            ->select(
                'cuti.*',
                'karyawans.nama as karyawan_name',
                'jenis_cuti.nama as jenis_cuti_name',
                'cuti.status', // Tambahkan status
                DB::raw('( 
                    SELECT 12 - COALESCE(SUM(c.lama_cuti), 0) 
                    FROM cuti as c 
                    JOIN jenis_cuti as jc ON jc.id = c.jenis_cuti_id 
                    WHERE c.karyawan_id = karyawans.id 
                      AND YEAR(c.tgl_entri) = ' . date("Y") . ' 
                      AND jc.is_wajib = 0
                ) as sisa_cuti')
            )
            ->when($search, function ($query, $search) {
                return $query->where('karyawans.nama', 'like', '%' . $search . '%');
            })
            ->paginate(10); // Pagination untuk 5 data per halaman
    
        // Kirim data ke view
        return view('cuti.index', compact('cutis'));
    }
    

    public function approve($id)
    {
        // Ambil data cuti yang diajukan
        $cuti = DB::table('cuti')->where('id', $id)->first();
    
        if (!$cuti) {
            return redirect()->back()->with('error', 'Data cuti tidak ditemukan.');
        }
    
        // Hitung sisa cuti hanya dari cuti yang sudah disetujui
        $sisaCuti = DB::table('cuti')
            ->where('karyawan_id', $cuti->karyawan_id)
            ->whereYear('tgl_entri', '=', date('Y'))
            ->where('status', 'disetujui') // Hanya cuti yang sudah disetujui yang dihitung
            ->sum('lama_cuti');
    
        // Total cuti dalam setahun (misalnya 12 hari)
        $totalCutiTahunan = 12;
        $sisaCutiTersedia = $totalCutiTahunan - $sisaCuti;
    
        // Pastikan sisa cuti cukup sebelum menyetujui
        if ($cuti->lama_cuti > $sisaCutiTersedia) {
            return redirect()->back()->with('error', 'Sisa cuti tidak mencukupi.');
        }
    
        // Set status cuti menjadi "disetujui" dan kurangi sisa cuti
        DB::table('cuti')
            ->where('id', $id)
            ->update([
                'status' => 'disetujui',
                'sisa_cuti' => $sisaCutiTersedia - $cuti->lama_cuti, // Kurangi sisa cuti
            ]);
    
        return redirect()->route('cuti.index')->with('success', 'Cuti berhasil disetujui.');
    }
    

    

    public function reject($id)
    {
        $cuti = Cuti::findOrFail($id);
    
        if (strtolower($cuti->status) === 'pending') {
            // Jangan kurangi sisa cuti jika ditolak
            $cuti->status = 'ditolak';
            $cuti->save();
        }
    
        return redirect()->back()->with('error', 'Cuti telah ditolak.');
    }
    

    public function create()
    {
        $karyawans = Karyawan::all();
        $jenis_cutis = JenisCuti::all();
        return view('cuti.create', compact('karyawans', 'jenis_cutis'));
    }

   public function store(Request $request)
{
    $request->validate([
        'karyawan_id' => 'required',
        'tgl_awal' => 'required|date',
        'tgl_akhir' => 'required|date',
        'lama_cuti' => 'required|integer',
        'keterangan' => 'nullable|string',
        'jenis_cuti_id' => 'required',
    ]);

    // Simpan data ke database tanpa mengurangi sisa cuti
    DB::table('cuti')->insert([
        'karyawan_id' => $request->karyawan_id,
        'tgl_awal' => $request->tgl_awal,
        'tgl_akhir' => $request->tgl_akhir,
        'lama_cuti' => $request->lama_cuti,
        'jenis_cuti_id' => $request->jenis_cuti_id,
        'keterangan' => $request->keterangan,
        'tgl_entri' => now(),
        'status' => 'pending', // Cuti masih pending, tidak mengurangi sisa cuti
        'sisa_cuti' => 0, // Tambahkan nilai default
    ]);

    return redirect()->route('cuti.index')->with('success', 'Cuti berhasil diajukan, menunggu persetujuan.');
}

    
    public function edit($id)
    {
        $cuti = Cuti::findOrFail($id);
        $karyawans = Karyawan::all();
        $jenis_cutis = JenisCuti::all();
        return view('cuti.edit', compact('cuti', 'karyawans', 'jenis_cutis'));  // Pastikan variabel yang digunakan sesuai
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'lama_cuti' => 'required|integer',
            'keterangan' => 'nullable|string',
            'jenis_cuti_id' => 'required|exists:jenis_cutis,id',
        ]);

        $cuti = Cuti::findOrFail($id);
        $cuti->update($request->all());

        return redirect()->route('cuti.index')->with('success', 'Cuti berhasil diperbarui');
    }

    public function destroy($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->delete();

        return redirect()->route('cuti.index')->with('success', 'Cuti berhasil dihapus');
    }
}
