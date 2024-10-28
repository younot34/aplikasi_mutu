<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NilaiKritisLab;
use Illuminate\Database\Eloquent\Builder;

class NilaiKritisLabController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:nilai_kritiss.index|nilai_kritiss.create|nilai_kritiss.edit|nilai_kritiss.delete|nilai_kritiss.export_lab|nilai_kritiss.grafik_lab_tahunan']);
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $currentUser = User::findOrFail(Auth()->id());
       if($currentUser->hasRole('admin')){
           $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
               $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $nilai_kritis = NilaiKritisLab::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
            $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
               $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
               $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
               $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
               $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
               $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
               $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
               $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
               $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas8')){
            $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
                $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
            })->paginate(10);
       }elseif($currentUser->hasRole('petugas9')){
            $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
                $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
            })->paginate(10);
       }elseif($currentUser->hasRole('petugas10')){
            $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
                $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
            })->paginate(10);
       }elseif($currentUser->hasRole('petugas11')){
            $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
                $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
            })->paginate(10);
       }elseif($currentUser->hasRole('petugas12')){
            $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
                $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
            })->paginate(10);
       }elseif($currentUser->hasRole('petugas13')){
            $nilai_kritis = NilaiKritisLab::latest()->when(request()->q, function($nilai_kritis) {
                $nilai_kritis = $nilai_kritis->where('tanggal', 'like', '%'. request()->q . '%');
            })->paginate(10);
       }

       $user = new User();

       return view('nilai_kritiss.index', compact('nilai_kritis','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('nilai_kritiss.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'no_rm' => 'required|string',
            'nama_pasien' => 'nullable|string',
            'unit_asal' => 'nullable|string',
            'dokter_pengirim' => 'nullable|string',
            'jenis_pelayanan' => 'nullable|string',
            'waktu_sampling' => 'nullable|date_format:H:i',
            'waktu_selsai' => 'nullable|date_format:H:i',
            'waktu_diterima' => 'nullable|date_format:H:i',
            'selisih_waktu' => 'nullable|string',
            'hasil_pemeriksaan_nilai_kritis' => 'nullable|string',
            'pemberi_informasi' => 'nullable|string',
            'penerima_informasi' => 'nullable|string',
        ]);

        try {
            // Simpan data ke tabel ris
            NilaiKritisLab::create([
                'tanggal' => $request->tanggal,
                'no_rm' => $request->no_rm,
                'nama_pasien' => $request->nama_pasien,
                'unit_asal' => $request->unit_asal,
                'dokter_pengirim' => $request->dokter_pengirim,
                'jenis_pelayanan' => $request->jenis_pelayanan,
                'waktu_sampling' => $request->waktu_sampling,
                'waktu_selsai' => $request->waktu_selsai,
                'waktu_diterima' => $request->waktu_diterima,
                'selisih_waktu' => $request->selisih_waktu,
                'hasil_pemeriksaan_nilai_kritis' => $request->hasil_pemeriksaan_nilai_kritis,
                'pemberi_informasi' => $request->pemberi_informasi,
                'penerima_informasi' => $request->penerima_informasi,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('nilai_kritiss.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('nilai_kritiss.index')->with(['error' => 'Data Gagal Diperbarui!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $nilai_kritis = NilaiKritisLab::findOrFail($id);
        return view('nilai_kritiss.edit', compact('nilai_kritis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nialai_kritis.*.tanggal' => 'required|date',
            'nialai_kritis.*.no_rm' => 'required|string',
            'nialai_kritis.*.nama_pasien' => 'nullable|string',
            'nialai_kritis.*.unit_asal' => 'nullable|string',
            'nialai_kritis.*.dokter_pengirim' => 'nullable|string',
            'nialai_kritis.*.jenis_pelayanan' => 'nullable|string',
            'nialai_kritis.*.waktu_sampling' => 'nullable|date_format:H:i',
            'nialai_kritis.*.waktu_selsai' => 'nullable|date_format:H:i',
            'nialai_kritis.*.waktu_diterima' => 'nullable|date_format:H:i',
            'nialai_kritis.*.selisih_waktu' => 'nullable|string',
            'nialai_kritis.*.hasil_pemeriksaan_nilai_kritis' => 'nullable|string',
            'nialai_kritis.*.pemberi_informasi' => 'nullable|string',
            'nialai_kritis.*.penerima_informasi' => 'nullable|string',
        ]);

        try {
            $nilai_kritis = NilaiKritisLab::findOrFail($id);
            $nilai_kritis->update($request->all());

            return redirect()->route('nilai_kritiss.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            return redirect()->route('nilai_kritiss.index')->with(['error' => 'Data Gagal Diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nilai_kritis = NilaiKritisLab::findOrFail($id);
        $nilai_kritis->delete();

        if($nilai_kritis){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function laporanBulanan(Request $request)
    {
        $bulan = $request->input('bulan' );
        if ($bulan) {
            $nilai_kritis = NilaiKritisLab::whereMonth('tanggal', date('m', strtotime($bulan)))->paginate(10);
        } else {
            $nilai_kritis = NilaiKritisLab::get();
        }
        return view('nilai_kritiss.export_lab', compact('nilai_kritis', 'bulan'));
    }
    
    public function laporanTahunanLaboratorium(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));

        // Ambil data Laboratorium berdasarkan tahun
        $nilai_kritis = NilaiKritisLab::whereYear('tanggal', $tahun)->get();

        // Array untuk menyimpan data per bulan
        $dataPerBulan = array_fill(1, 12, [
            'jumlah_waktu_kurang_dari_30' => 0,
            'total_data' => 0
        ]);

        foreach ($nilai_kritis as $nilai_kriti) {
            $bulan = (int)date('m', strtotime($nilai_kriti->tanggal));

            // Hitung selisih waktu
            $waktuSelesai = \Carbon\Carbon::parse($nilai_kriti->waktu_selsai);
            $waktuDiterima = \Carbon\Carbon::parse($nilai_kriti->waktu_diterima);
            $selisih = $waktuSelesai->diffInMinutes($waktuDiterima);

            // Jumlahkan data dengan selisih waktu <= 30 menit
            if ($selisih <= 30) {
                $dataPerBulan[$bulan]['jumlah_waktu_kurang_dari_30']++;
            }

            // Total data per bulan
            $dataPerBulan[$bulan]['total_data']++;
        }

        // Menghitung persentase per bulan
        foreach ($dataPerBulan as $bulan => $data) {
            $dataPerBulan[$bulan]['persentase'] = $data['total_data'] > 0 ? ($data['jumlah_waktu_kurang_dari_30'] / $data['total_data']) * 100 : 0;
        }

        // Data untuk Chart.js
        $chartData = [
            'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'persentase' => array_column($dataPerBulan, 'persentase'),
            'target' => array_fill(0, 12, 100), // Target 100%
        ];

        return view('nilai_kritiss.grafik_lab_tahunan', compact('chartData', 'tahun', 'dataPerBulan'));
    }
}
