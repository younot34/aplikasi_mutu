<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemberianObat;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class PemberianObatController extends Controller
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
           $pemberian_obats = PemberianObat::latest()->when(request()->q, function($pemberian_obats) {
               $pemberian_obats = $pemberian_obats->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $pemberian_obats = PemberianObat::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $pemberian_obats = PemberianObat::latest()->when(request()->q, function($pemberian_obats) {
               $pemberian_obats = $pemberian_obats->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $pemberian_obats = PemberianObat::latest()->when(request()->q, function($pemberian_obats) {
               $pemberian_obats = $pemberian_obats->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $pemberian_obats = PemberianObat::latest()->when(request()->q, function($pemberian_obats) {
               $pemberian_obats = $pemberian_obats->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $pemberian_obats = PemberianObat::latest()->when(request()->q, function($pemberian_obats) {
               $pemberian_obats = $pemberian_obats->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $pemberian_obats = PemberianObat::latest()->when(request()->q, function($pemberian_obats) {
               $pemberian_obats = $pemberian_obats->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $pemberian_obats = PemberianObat::latest()->when(request()->q, function($pemberian_obats) {
               $pemberian_obats = $pemberian_obats->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $pemberian_obats = PemberianObat::latest()->when(request()->q, function($pemberian_obats) {
               $pemberian_obats = $pemberian_obats->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $pemberian_obats = PemberianObat::latest()->when(request()->q, function($pemberian_obats) {
               $pemberian_obats = $pemberian_obats->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();
        $bulan = $request->input('bulan', date('Y-m'));
        $tanggal = Carbon::parse($bulan . '-01');
        $akhirBulan = $tanggal->copy()->endOfMonth();

       return view('pemberian_obats.index', compact('pemberian_obats','user','bulan', 'tanggal', 'akhirBulan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('pemberian_obats.create');
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
            'no_rm' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'tidakSalah' => 'nullable|string',
        ]);

        try {
            // Simpan data ke tabel
            PemberianObat::create([
                'tanggal' =>$request->tanggal,
                'nama_pasien' =>$request->nama_pasien,
                'no_rm' =>$request->no_rm,
                'keterangan' =>$request->keterangan,
                'tidakSalah' =>$request->tidakSalah,
            ]);


            // Redirect dengan pesan sukses
            return redirect()->route('pemberian_obats.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('pemberian_obats.index')->with(['error' => 'Data Gagal Disimpan! Error: ' . $e->getMessage()]);
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
        $pemberian_obats = PemberianObat::findOrFail($id);
        return view('pemberian_obats.edit', compact('pemberian_obats'));
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
            'no_rm' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'tidakSalah' => 'nullable|string',
        ]);

        try {
            $pemberian_obats = PemberianObat::findOrFail($id);
            $pemberian_obats->update([
                'tanggal' =>$request->tanggal,
                'nama_pasien' =>$request->nama_pasien,
                'no_rm' =>$request->no_rm,
                'keterangan' =>$request->keterangan,
                'tidakSalah' =>$request->tidakSalah,
            ]);

            return redirect()->route('pemberian_obats.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('pemberian_obats.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $pemberian_obats = PemberianObat::findOrFail($id);
        $pemberian_obats->delete();

        if($pemberian_obats){
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
            $pemberian_obats = PemberianObat::whereMonth('tanggal', date('m', strtotime($bulan)))->get();
        } else {
            $pemberian_obats = PemberianObat::get();
        }
        return view('pemberian_obats.export_po', compact('pemberian_obats', 'bulan'));
    }

    public function laporanTahunanObatRacikan(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));

        // Ambil data obat racikan berdasarkan tahun yang dipilih
        $obatRacikans = PemberianObat::whereYear('tanggal', $tahun)->get();

        // Data per bulan
        $dataPerBulan = array_fill(1, 12, ['count_less_than_60' => 0, 'total_data' => 0]);

        foreach ($obatRacikans as $obatRacikan) {
            $bulan = (int)date('m', strtotime($obatRacikan->tanggal));
            $tidakSalah = \Carbon\Carbon::parse($obatRacikan->keterangan)
                                ->diffInMinutes(\Carbon\Carbon::parse($obatRacikan->no_rm));

            if ($tidakSalah <= 60) {
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

        return view('pemberian_obats.grafik_or', compact('chartData', 'tahun'));
    }
}
