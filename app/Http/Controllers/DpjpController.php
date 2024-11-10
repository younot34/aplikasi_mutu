<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dpjp;
use Illuminate\Database\Eloquent\Builder;

class DpjpController extends Controller
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
           $dpjp = Dpjp::latest()->when(request()->q, function($dpjp) {
               $dpjp = $dpjp->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $dpjp = Dpjp::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $dpjp = Dpjp::latest()->when(request()->q, function($dpjp) {
               $dpjp = $dpjp->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $dpjp = Dpjp::latest()->when(request()->q, function($dpjp) {
               $dpjp = $dpjp->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $dpjp = Dpjp::latest()->when(request()->q, function($dpjp) {
               $dpjp = $dpjp->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $dpjp = Dpjp::latest()->when(request()->q, function($dpjp) {
               $dpjp = $dpjp->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $dpjp = Dpjp::latest()->when(request()->q, function($dpjp) {
               $dpjp = $dpjp->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $dpjp = Dpjp::latest()->when(request()->q, function($dpjp) {
               $dpjp = $dpjp->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $dpjp = Dpjp::latest()->when(request()->q, function($dpjp) {
               $dpjp = $dpjp->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $dpjp = Dpjp::latest()->when(request()->q, function($dpjp) {
               $dpjp = $dpjp->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('dpjps.index', compact('dpjp','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('dpjps.create');
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
            'nama_pasien' => 'required|string',
            'terverifikasi' => 'nullable|string',
            'tidak_terverifikasi' => 'nullable|string',
            'dpjp' => 'nullable|string',
        ]);

        try {
            // Simpan data ke tabel ris
            Dpjp::create([
                'tanggal' => $request->tanggal,
                'no_rm' => $request->no_rm,
                'nama_pasien' => $request->nama_pasien,
                'terverifikasi' => $request->terverifikasi,
                'tidak_terverifikasi' => $request->tidak_terverifikasi,
                'dpjp' => $request->dpjp,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('dpjps.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('dpjps.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $dpjp = Dpjp::findOrFail($id);
        return view('dpjps.edit', compact('dpjp'));
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
            'nama_pasien' => 'required|string',
            'terverifikasi' => 'nullable|string',
            'tidak_terverifikasi' => 'nullable|string',
            'dpjp' => 'nullable|string',
        ]);
        try {
            // Simpan data ke tabel ris
            $dpjp = Dpjp::findOrFail($id);
            $dpjp->update([
                'tanggal' => $request->tanggal,
                'no_rm' => $request->no_rm,
                'nama_pasien' => $request->nama_pasien,
                'terverifikasi' => $request->terverifikasi,
                'tidak_terverifikasi' => $request->tidak_terverifikasi,
                'dpjp' => $request->dpjp,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('dpjps.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('dpjps.index')->with(['error' => 'Data Gagal Diubah!']);
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
        $dpjp = Dpjp::findOrFail($id);
        $dpjp->delete();

        if($dpjp){
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
            $dpjp = Dpjp::whereMonth('tanggal', date('m', strtotime($bulan)))->get();
        } else {
            $dpjp = Dpjp::get();
        }
        return view('dpjps.export_dp', compact('dpjp', 'bulan'));
    }

    public function laporanTahunan(Request $request)
    {
        // Ambil tahun dari input, jika tidak ada maka gunakan tahun saat ini
        $tahun = $request->input('tahun', date('Y'));

        // Inisialisasi data per bulan
        $dataPerBulan = [];
        $totalterverifikasiTahun = 0;
        $totaltidak_terverifikasiTahun = 0;

        // Looping untuk setiap bulan dalam satu tahun
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            // Ambil data dari database berdasarkan bulan dan tahun
            $DpjpBulanan = Dpjp::whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->get();

            $totalterverifikasiBulan = 0;
            $totaltidak_terverifikasiBulan = 0;

            // Hitung total jam < 14.00 dan > 14.00 per bulan
            foreach ($DpjpBulanan as $Dpjp) {
                if ($Dpjp->terverifikasi) {
                    $totalterverifikasiBulan++;
                } else {
                    $totaltidak_terverifikasiBulan++;
                }
            }

            // Simpan data bulanan ke dalam array
            $dataPerBulan[$bulan] = [
                'totalterverifikasi' => $totalterverifikasiBulan,
                'totaltidak_terverifikasi' => $totaltidak_terverifikasiBulan,
                'persentase' => ($totalterverifikasiBulan + $totaltidak_terverifikasiBulan) > 0
                    ? ($totalterverifikasiBulan / ($totalterverifikasiBulan + $totaltidak_terverifikasiBulan)) * 100 : 0,
            ];

            // Akumulasi total tahunan
            $totalterverifikasiTahun += $totalterverifikasiBulan;
            $totaltidak_terverifikasiTahun += $totaltidak_terverifikasiBulan;
        }

        // Siapkan data untuk grafik
        $chartData = [
            'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'persentase' => array_column($dataPerBulan, 'persentase'),
            'target' => array_fill(0, 12, 100),
        ];

        return view('dpjps.grafik_dp', compact('tahun', 'chartData', 'dataPerBulan'));
    }
}
