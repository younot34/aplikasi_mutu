<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jatuh;
use Illuminate\Database\Eloquent\Builder;

class JatuhController extends Controller
{
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
           $jatuh = Jatuh::latest()->when(request()->q, function($jatuh) {
               $jatuh = $jatuh->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $jatuh = Jatuh::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $jatuh = Jatuh::latest()->when(request()->q, function($jatuh) {
               $jatuh = $jatuh->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $jatuh = Jatuh::latest()->when(request()->q, function($jatuh) {
               $jatuh = $jatuh->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $jatuh = Jatuh::latest()->when(request()->q, function($jatuh) {
               $jatuh = $jatuh->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $jatuh = Jatuh::latest()->when(request()->q, function($jatuh) {
               $jatuh = $jatuh->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $jatuh = Jatuh::latest()->when(request()->q, function($jatuh) {
               $jatuh = $jatuh->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $jatuh = Jatuh::latest()->when(request()->q, function($jatuh) {
               $jatuh = $jatuh->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $jatuh = Jatuh::latest()->when(request()->q, function($jatuh) {
               $jatuh = $jatuh->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $jatuh = Jatuh::latest()->when(request()->q, function($jatuh) {
               $jatuh = $jatuh->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('jatuhs.index', compact('jatuh','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('jatuhs.create');
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
            'nama_px' => 'required|string',
            'rendah' => 'nullable|string',
            'tinggi' => 'nullable|string',
            'kancing' => 'nullable|string',
            'segitiga' => 'nullable|string',
            'handreal' => 'nullable|string',
        ]);

        try {
            Jatuh::create([
                'tanggal' => $request->tanggal,
                'no_rm' => $request->no_rm,
                'nama_px' => $request->nama_px,
                'rendah' => $request->rendah,
                'tinggi' => $request->tinggi,
                'kancing' => $request->kancing,
                'segitiga' => $request->segitiga,
                'handreal' => $request->handreal,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('jatuhs.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('jatuhs.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $jatuh = Jatuh::findOrFail($id);
        return view('jatuhs.edit', compact('jatuh'));
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
            'tanggal' => 'required|date',
            'no_rm' => 'required|string',
            'nama_px' => 'required|string',
            'rendah' => 'nullable|string',
            'tinggi' => 'nullable|string',
            'kancing' => 'nullable|string',
            'segitiga' => 'nullable|string',
            'handreal' => 'nullable|string',
        ]);
        try {
            // Simpan data ke tabel ris
            $jatuh = Jatuh::findOrFail($id);
            $jatuh->update([
                'tanggal' => $request->tanggal,
                'no_rm' => $request->no_rm,
                'nama_px' => $request->nama_px,
                'rendah' => $request->rendah,
                'tinggi' => $request->tinggi,
                'kancing' => $request->kancing,
                'segitiga' => $request->segitiga,
                'handreal' => $request->handreal,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('jatuhs.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('jatuhs.index')->with(['error' => 'Data Gagal Diubah!']);
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
        $jatuh = Jatuh::findOrFail($id);
        $jatuh->delete();

        if($jatuh){
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
            $jatuh = Jatuh::whereMonth('tanggal', date('m', strtotime($bulan)))->get();
        } else {
            $jatuh = Jatuh::get();
        }
        return view('jatuhs.export_j', compact('jatuh', 'bulan'));
    }
    
        public function laporanTahunan(Request $request)
    {
        // Ambil tahun dari input, jika tidak ada maka gunakan tahun saat ini
        $tahun = $request->input('tahun', date('Y'));

        // Inisialisasi data per bulan
        $dataPerBulan = [];
        $totalLengkapTahun = 0;
        $totalTidakLengkapTahun = 0;

        // Looping untuk setiap bulan dalam satu tahun
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            // Ambil data dari database berdasarkan bulan dan tahun
            $jatuhBulanan = Jatuh::whereYear('tanggal', $tahun)
                                ->whereMonth('tanggal', $bulan)
                                ->get();

            $totalLengkapBulanan = 0;
            $totalTidakLengkapBulanan = 0;

            // Hitung total lengkap dan tidak lengkap per bulan
            foreach ($jatuhBulanan as $jatuhs) {
                if (
                    $jatuhs->tinggi == '✔️' &&
                    $jatuhs->kancing == '✔️' &&
                    $jatuhs->segitiga == '✔️' &&
                    $jatuhs->handreal == '✔️'
                ) {
                    $totalLengkapBulanan++;
                } else {
                    $totalTidakLengkapBulanan++;
                }
            }

            // Simpan data bulanan ke dalam array
            $dataPerBulan[$bulan] = [
                'total_lengkap' => $totalLengkapBulanan,
                'total_tidak_lengkap' => $totalTidakLengkapBulanan,
                'persentase' => ($totalLengkapBulanan + $totalTidakLengkapBulanan) > 0
                                ? ($totalLengkapBulanan / ($totalLengkapBulanan + $totalTidakLengkapBulanan)) * 100 : 0,
            ];

            // Akumulasi total lengkap dan tidak lengkap tahunan
            $totalLengkapTahun += $totalLengkapBulanan;
            $totalTidakLengkapTahun += $totalTidakLengkapBulanan;
        }

        // Hitung persentase tahunan
        $persentaseTahunan = ($totalLengkapTahun + $totalTidakLengkapTahun) > 0
                            ? ($totalLengkapTahun / ($totalLengkapTahun + $totalTidakLengkapTahun)) * 100 : 0;

        // Siapkan data untuk grafik
        $chartData = [
            'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'persentase' => array_column($dataPerBulan, 'persentase'),
            'target' => array_fill(0, 12, 100), // Target 80% setiap bulan
        ];

        return view('jatuhs.grafik_j', compact('tahun', 'chartData', 'dataPerBulan'));
    }
}
