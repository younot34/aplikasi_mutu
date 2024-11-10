<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clinical;
use Illuminate\Database\Eloquent\Builder;

class ClinicalController extends Controller
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
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $clinical = Clinical::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('clinicals.index', compact('clinical','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('clinicals.create');
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
            'no_rm' => 'required|string',
            'nama_px' => 'required|string',
            'diagnosa' => 'nullable|string',
            'patuh' => 'nullable|string',
            'masuk' => 'nullable|date',
            'keluar' => 'nullable|date',
        ]);

        try {
            Clinical::create([
                'no_rm' => $request->no_rm,
                'nama_px' => $request->nama_px,
                'diagnosa' => $request->diagnosa,
                'patuh' => $request->patuh,
                'masuk' => $request->masuk,
                'keluar' => $request->keluar,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('clinicals.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('clinicals.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $clinical = Clinical::findOrFail($id);
        return view('clinicals.edit', compact('clinical'));
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
            'no_rm' => 'required|string',
            'nama_px' => 'required|string',
            'diagnosa' => 'nullable|string',
            'patuh' => 'nullable|string',
            'masuk' => 'nullable|date',
            'keluar' => 'nullable|date',
        ]);
        try {
            // Simpan data ke tabel ris
            $clinical = Clinical::findOrFail($id);
            $clinical->update([
                'no_rm' => $request->no_rm,
                'nama_px' => $request->nama_px,
                'diagnosa' => $request->diagnosa,
                'patuh' => $request->patuh,
                'masuk' => $request->masuk,
                'keluar' => $request->keluar,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('clinicals.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('clinicals.index')->with(['error' => 'Data Gagal Diubah!']);
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
        $clinical = Clinical::findOrFail($id);
        $clinical->delete();

        if($clinical){
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
            $clinical = Clinical::whereMonth('masuk', date('m', strtotime($bulan)))->get();
        } else {
            $clinical = Clinical::get();
        }
        return view('clinicals.export_c', compact('clinical', 'bulan'));
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
            $ClinicalBulanan = Clinical::whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->get();

            $totalpatuhBulan = 0;
            $totaltidak_patuhBulan = 0;

            // Hitung total jam < 14.00 dan > 14.00 per bulan
            foreach ($ClinicalBulanan as $Clinical) {
                if ($Clinical->patuh == '✔️') {
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
            'target' => array_fill(0, 12, 80),
        ];

        return view('Clinicals.grafik_c', compact('tahun', 'chartData', 'dataPerBulan'));
    }
}
