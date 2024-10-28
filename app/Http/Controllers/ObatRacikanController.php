<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Obat_racikan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
// use App\Exports\ObatracikanExport;
use Maatwebsite\Excel\Facades\Excel;

class ObatRacikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $currentUser = User::findOrFail(Auth()->id());
       if($currentUser->hasRole('admin')){
           $obat_racikans = Obat_racikan::latest()->when(request()->q, function($obat_racikans) {
               $obat_racikans = $obat_racikans->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $obat_racikans = Obat_racikan::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $obat_racikans = Obat_racikan::latest()->when(request()->q, function($obat_racikans) {
               $obat_racikans = $obat_racikans->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $obat_racikans = Obat_racikan::latest()->when(request()->q, function($obat_racikans) {
               $obat_racikans = $obat_racikans->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $obat_racikans = Obat_racikan::latest()->when(request()->q, function($obat_racikans) {
               $obat_racikans = $obat_racikans->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $obat_racikans = Obat_racikan::latest()->when(request()->q, function($obat_racikans) {
               $obat_racikans = $obat_racikans->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $obat_racikans = Obat_racikan::latest()->when(request()->q, function($obat_racikans) {
               $obat_racikans = $obat_racikans->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $obat_racikans = Obat_racikan::latest()->when(request()->q, function($obat_racikans) {
               $obat_racikans = $obat_racikans->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $obat_racikans = Obat_racikan::latest()->when(request()->q, function($obat_racikans) {
               $obat_racikans = $obat_racikans->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $obat_racikans = Obat_racikan::latest()->when(request()->q, function($obat_racikans) {
               $obat_racikans = $obat_racikans->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();
        $bulan = $request->input('bulan', date('Y-m'));
        $tanggal = Carbon::parse($bulan . '-01');
        $akhirBulan = $tanggal->copy()->endOfMonth();

       return view('obat_racikans.index', compact('obat_racikans','user','bulan', 'tanggal', 'akhirBulan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('obat_racikans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse
     */ // Tambahkan ini di bagian atas controller

     public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'nullable|date',
            'nama_pasien' => 'nullable|string',
            'resep_masuk' => 'nullable|date_format:H:i',
            'resep_diserahkan' => 'nullable|date_format:H:i',
            'waktu_pelayanan' => 'nullable|string',
        ]);

        try {
            // Simpan data ke tabel
            Obat_racikan::create([
                'tanggal' =>$request->tanggal,
                'nama_pasien' =>$request->nama_pasien,
                'resep_masuk' =>$request->resep_masuk,
                'resep_diserahkan' =>$request->resep_diserahkan,
                'waktu_pelayanan' =>$request->waktu_pelayanan,
            ]);


            // Redirect dengan pesan sukses
            return redirect()->route('obat_racikans.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('obat_racikans.index')->with(['error' => 'Data Gagal Disimpan! Error: ' . $e->getMessage()]);
            // return redirect()->route('rmrs.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $obat_racikans = Obat_racikan::findOrFail($id);
        return view('obat_racikans.edit', compact('obat_racikans'));
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
            'tanggal' => 'nullable|date',
            'nama_pasien' => 'nullable|string',
            'resep_masuk' => 'nullable|date_format:H:i',
            'resep_diserahkan' => 'nullable|date_format:H:i',
            'waktu_pelayanan' => 'nullable|string',
        ]);

        try {
            $obat_racikans = Obat_racikan::findOrFail($id);
            $obat_racikans->update([
                'tanggal' =>$request->tanggal,
                'nama_pasien' =>$request->nama_pasien,
                'resep_masuk' =>$request->resep_masuk,
                'resep_diserahkan' =>$request->resep_diserahkan,
                'waktu_pelayanan' =>$request->waktu_pelayanan,
            ]);

            return redirect()->route('obat_racikans.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('obat_racikans.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $obat_racikans = Obat_racikan::findOrFail($id);
        $obat_racikans->delete();

        if($obat_racikans){
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
            $obat_racikans = Obat_racikan::whereMonth('tanggal', date('m', strtotime($bulan)))->get();
        } else {
            $obat_racikans = Obat_racikan::get();
        }
        return view('obat_racikans.export_or', compact('obat_racikans', 'bulan'));
    }
    
    public function laporanTahunanObatRacikan(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));

        // Ambil data obat racikan berdasarkan tahun yang dipilih
        $obatRacikans = Obat_racikan::whereYear('tanggal', $tahun)->get();

        // Data per bulan
        $dataPerBulan = array_fill(1, 12, ['count_less_than_60' => 0, 'total_data' => 0]);

        foreach ($obatRacikans as $obatRacikan) {
            $bulan = (int)date('m', strtotime($obatRacikan->tanggal));
            $waktu_pelayanan = \Carbon\Carbon::parse($obatRacikan->resep_diserahkan)
                                ->diffInMinutes(\Carbon\Carbon::parse($obatRacikan->resep_masuk));

            if ($waktu_pelayanan <= 60) {
                $dataPerBulan[$bulan]['count_less_than_60'] += 1;
            }
            $dataPerBulan[$bulan]['total_data'] += 1;
        }

        // Menghitung persentase per bulan
        $capaian = [];
        foreach ($dataPerBulan as $bulan => $data) {
            if ($data['total_data'] > 0) {
                $capaian[$bulan] = ($data['count_less_than_60'] / $data['total_data']) * 100;
            } else {
                $capaian[$bulan] = 0;
            }
        }

        // Data untuk Chart.js
        $chartData = [
            'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'capaian' => array_values($capaian),
            'target' => array_fill(0, 12, 80), // Target 100%
            'dataPerBulan' => $dataPerBulan
        ];

        return view('obat_racikans.grafik_or', compact('chartData', 'tahun'));
    }
}
