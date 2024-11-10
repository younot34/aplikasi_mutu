<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MonitoringLab;
use Illuminate\Database\Eloquent\Builder;

class MonitoringLabController extends Controller
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
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $monitoring = MonitoringLab::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas8')){
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas9')){
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas10')){
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas11')){
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas12')){
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas13')){
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $monitoring = MonitoringLab::latest()->when(request()->q, function($monitoring) {
               $monitoring = $monitoring->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

        $user = new User();

        return view('monitorings.index', compact('monitoring', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('monitorings.create');
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
        // Validasi data yang masuk
        $request->validate([
            'tanggal' => 'nullable|date',
            'nama_pasien' => 'nullable|string',
            'no_rm' => 'nullable|string',
            'patuh' => 'nullable|string',
        ]);
        try { MonitoringLab::create([
                'tanggal' => $request->tanggal,
                'nama_pasien' => $request->nama_pasien,
                'no_rm' => $request->no_rm,
                'patuh' => $request->patuh,
            ]);
            return redirect()->route('monitorings.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            return redirect()->route('monitorings.index')->with(['error' => 'Data Gagal Disimpan! ' . $e->getMessage()]);
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
        $monitorings = MonitoringLab::findOrFail($id);
        return view('monitorings.edit', compact('monitorings'));
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
        // Validasi data yang masuk
        $request->validate([
            'tanggal' => 'nullable|date',
            'nama_pasien' => 'nullable|string',
            'no_rm' => 'nullable|string',
            'patuh' => 'nullable|string',
        ]);
        try {
            // Cari dan update data utama di tabel
            $monitorings = MonitoringLab::findOrFail($id);
            $monitorings->update([
                'tanggal' => $request->tanggal,
                'nama_pasien' => $request->nama_pasien,
                'no_rm' => $request->no_rm,
                'patuh' => $request->patuh,
            ]);
            // Redirect dengan pesan sukses
            return redirect()->route('monitorings.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('monitorings.index')->with(['error' => 'Data Gagal Diubah! ' . $e->getMessage()]);
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
        $monitorings = MonitoringLab::findOrFail($id);
        $monitorings->delete();

        if($monitorings){
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
            $monitoring = MonitoringLab::whereMonth('tanggal', date('m', strtotime($bulan)))->with(['monitoring_lab_pertanggals'])->get();
        } else {
            $monitoring = MonitoringLab::get();
        }
        return view('monitorings.export_moni', compact('monitoring', 'bulan'));
    }

    public function laporanTahunan(Request $request)
    {
        // Ambil tahun dari input, jika tidak ada maka gunakan tahun saat ini
        $tahun = $request->input('tahun', date('Y'));

        // Inisialisasi data per bulan
        $dataPerBulan = [];
        $totalpatuhTahun = 0;
        $totaltidak_patuhTahun = 0;

        // Looping untuk setiap bulan dalam satu tahun
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            // Ambil data dari database berdasarkan bulan dan tahun
            $monitoringBulanan = MonitoringLab::whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->get();

            $totalpatuhBulan = 0;
            $totaltidak_patuhBulan = 0;

            // Hitung total jam < 14.00 dan > 14.00 per bulan
            foreach ($monitoringBulanan as $monitoring) {
                if ($monitoring->patuh == '✔️') {
                    $totalpatuhBulan++;
                } else {
                    $totaltidak_patuhBulan++;
                }
            }

            // Simpan data bulanan ke dalam array
            $dataPerBulan[$bulan] = [
                'totalpatuh' => $totalpatuhBulan,
                'totaltidak_patuh' => $totaltidak_patuhBulan,
                'persentase' => ($totalpatuhBulan + $totaltidak_patuhBulan) > 0
                    ? ($totalpatuhBulan / ($totalpatuhBulan + $totaltidak_patuhBulan)) * 100 : 0,
            ];

            // Akumulasi total tahunan
            $totalpatuhTahun += $totalpatuhBulan;
            $totaltidak_patuhTahun += $totaltidak_patuhBulan;
        }

        // Siapkan data untuk grafik
        $chartData = [
            'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'persentase' => array_column($dataPerBulan, 'persentase'),
            'target' => array_fill(0, 12, 100),
        ];

        return view('monitorings.grafik_moni', compact('tahun', 'chartData', 'dataPerBulan'));
    }
}
