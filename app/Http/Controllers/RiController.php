<?php

namespace App\Http\Controllers;

use App\Models\Pdarah;
use App\Models\Pobat;
use App\Models\Psample;
use App\Models\Ptindakan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ri;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;

class RiController extends Controller
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
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $ri = Ri::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('ris.index', compact('ri','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('ris.create');
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
            'sift' => 'required|string',
            'no_rm' => 'required|string',
            'nama_px' => 'required|string',
            'alamat' => 'required|string',
            'benar_namao' => 'required|array',
            'benar_alamato' => 'required|array',
            'benar_namad' => 'required|array',
            'benar_alamatd' => 'required|array',
            'benar_namas' => 'required|array',
            'benar_alamats' => 'required|array',
            'benar_namat' => 'required|array',
            'benar_alamatt' => 'required|array',
        ]);

        try {
            // Simpan data ke tabel ris
            $ri = Ri::create([
                'tanggal' => $request->tanggal,
                'sift' => $request->sift,
                'no_rm' => $request->no_rm,
                'nama_px' => $request->nama_px,
                'alamat' => $request->alamat,
            ]);

            // Loop melalui input array dan simpan ke tabel pobats
            foreach ($request->benar_namao as $index => $benar_namao) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namao' => $benar_namao,
                    'benar_alamato' => $request->benar_alamato[$index],
                ];

                // Simpan data ke tabel obats
                Pobat::create($data);
            }
            // Loop melalui input array dan simpan ke tabel pdarahs
            foreach ($request->benar_namad as $index => $benar_namad) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namad' => $benar_namad,
                    'benar_alamatd' => $request->benar_alamatd[$index],
                ];

                // Simpan data ke tabel obats
                Pdarah::create($data);
            }
            // Loop melalui input array dan simpan ke tabel psamples
            foreach ($request->benar_namas as $index => $benar_namas) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namas' => $benar_namas,
                    'benar_alamats' => $request->benar_alamats[$index],
                ];

                // Simpan data ke tabel obats
                Psample::create($data);
            }
            // Loop melalui input array dan simpan ke tabel ptindakans
            foreach ($request->benar_namat as $index => $benar_namat) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namat' => $benar_namat,
                    'benar_alamatt' => $request->benar_alamatt[$index],
                ];

                // Simpan data ke tabel obats
                Ptindakan::create($data);
            }

            // Redirect dengan pesan sukses
            return redirect()->route('ris.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('ris.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $ri = Ri::with('pobats','pdarahs','psamples','ptindakans')->findOrFail($id);
        return view('ris.edit', compact('ri'));
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
            'sift' => 'required|string',
            'no_rm' => 'required|string',
            'nama_px' => 'required|string',
            'alamat' => 'required|string',
            'benar_namao' => 'required|array',
            'benar_alamato' => 'required|array',
            'benar_namad' => 'required|array',
            'benar_alamatd' => 'required|array',
            'benar_namas' => 'required|array',
            'benar_alamats' => 'required|array',
            'benar_namat' => 'required|array',
            'benar_alamatt' => 'required|array',
        ]);
        try {
            // Simpan data ke tabel ris
            $ri = Ri::findOrFail($id);
            $ri->update([
                'tanggal' => $request->tanggal,
                'sift' => $request->sift,
                'no_rm' => $request->no_rm,
                'nama_px' => $request->nama_px,
                'alamat' => $request->alamat,
            ]);

            $ri->pobats()->delete();
            $ri->pdarahs()->delete();
            $ri->psamples()->delete();
            $ri->ptindakans()->delete();
            // Loop melalui input array dan simpan ke tabel pobats
            foreach ($request->benar_namao as $index => $benar_namao) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namao' => $benar_namao,
                    'benar_alamato' => $request->benar_alamato[$index],
                ];

                // Simpan data ke tabel obats
                Pobat::create($data);
            }
            // Loop melalui input array dan simpan ke tabel pdarahs
            foreach ($request->benar_namad as $index => $benar_namad) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namad' => $benar_namad,
                    'benar_alamatd' => $request->benar_alamatd[$index],
                ];

                // Simpan data ke tabel obats
                Pdarah::create($data);
            }
            // Loop melalui input array dan simpan ke tabel psamples
            foreach ($request->benar_namas as $index => $benar_namas) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namas' => $benar_namas,
                    'benar_alamats' => $request->benar_alamats[$index],
                ];

                // Simpan data ke tabel obats
                Psample::create($data);
            }
            // Loop melalui input array dan simpan ke tabel ptindakans
            foreach ($request->benar_namat as $index => $benar_namat) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namat' => $benar_namat,
                    'benar_alamatt' => $request->benar_alamatt[$index],
                ];

                // Simpan data ke tabel obats
                Ptindakan::create($data);
            }

            // Redirect dengan pesan sukses
            return redirect()->route('ris.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('ris.index')->with(['success' => 'Data Berhasil Diubah!']);
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
        $ri = Ri::findOrFail($id);
        $ri->delete();

        if($ri){
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
            $ri = Ri::whereMonth('tanggal', date('m', strtotime($bulan)))->with(['pobats','pdarahs','psamples','ptindakans'])->paginate(10);
        } else {
            $ri = Ri::with(['pobats','pdarahs','psamples','ptindakans'])->paginate(10);
        }
        return view('ris.export_ri', compact('ri', 'bulan'));
    }
    
    public function laporanTahunan(Request $request)
    {
        // Ambil tahun dari input, jika tidak ada maka gunakan tahun saat ini
        $tahun = $request->input('tahun', date('Y'));

        // Inisialisasi data per bulan
        $dataPerBulan = [];
        $totalPatuhTahun = 0;
        $totalPeluangTahun = 0;

        // Looping untuk setiap bulan dalam satu tahun
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            // Ambil data dari database berdasarkan bulan dan tahun
            $riBulanan = Ri::whereYear('tanggal', $tahun)
                            ->whereMonth('tanggal', $bulan)
                            ->get();

            $totalPatuhBulanan = 0;
            $totalPeluangBulanan = 0;

            // Hitung patuh dan peluang per bulan
            foreach ($riBulanan as $ris) {
                $patuh = 0;
                $peluang = 0;

                foreach (['pobats', 'pdarahs', 'psamples', 'ptindakans'] as $type) {
                    foreach ($ris->$type as $item) {
                        // Perhitungan patuh
                        if (
                            ($type == 'pobats' && $item->benar_namao == '✔️' && $item->benar_alamato == '✔️') ||
                            ($type == 'pdarahs' && $item->benar_namad == '✔️' && $item->benar_alamatd == '✔️') ||
                            ($type == 'psamples' && $item->benar_namas == '✔️' && $item->benar_alamats == '✔️') ||
                            ($type == 'ptindakans' && $item->benar_namat == '✔️' && $item->benar_alamatt == '✔️')
                        ) {
                            $patuh++;
                        }

                        // Perhitungan peluang
                        if (
                            ($type == 'pobats' && ($item->benar_namao == '✔️' || $item->benar_alamato == '✔️')) ||
                            ($type == 'pdarahs' && ($item->benar_namad == '✔️' || $item->benar_alamatd == '✔️')) ||
                            ($type == 'psamples' && ($item->benar_namas == '✔️' || $item->benar_alamats == '✔️')) ||
                            ($type == 'ptindakans' && ($item->benar_namat == '✔️' || $item->benar_alamatt == '✔️'))
                        ) {
                            $peluang++;
                        }
                    }
                }

                // Hitung total patuh dan peluang bulanan
                $totalPatuhBulanan += $patuh > 0 ? 1 : 0;
                $totalPeluangBulanan += $peluang > 0 ? 1 : 0;
            }

            // Simpan data bulanan ke dalam array
            $dataPerBulan[$bulan] = [
                'total_patuh' => $totalPatuhBulanan,
                'total_peluang' => $totalPeluangBulanan,
                'persentase' => $totalPeluangBulanan > 0 ? ($totalPatuhBulanan / $totalPeluangBulanan) * 100 : 0,
            ];

            // Akumulasi total patuh dan peluang tahunan
            $totalPatuhTahun += $totalPatuhBulanan;
            $totalPeluangTahun += $totalPeluangBulanan;
        }

        // Hitung persentase kepatuhan tahunan
        $persentaseKepatuhanTahun = $totalPeluangTahun > 0 ? ($totalPatuhTahun / $totalPeluangTahun) * 100 : 0;

        // Siapkan data untuk grafik
        $chartData = [
            'labels' => [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ],
            'persentase' => array_column($dataPerBulan, 'persentase'),
            'target' => array_fill(0, 12, 100), // Target 80%
        ];

        // Kirim data ke view
        return view('ris.grafik_kep', compact('tahun', 'dataPerBulan', 'persentaseKepatuhanTahun', 'chartData'));
    }
}
