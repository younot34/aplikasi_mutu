<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MonitoringLab;
use App\Models\MonitoringLabPertanggal;
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

        // Ambil query pencarian jika ada
        $searchQuery = request()->q;

        // Role yang memiliki query yang sama
        $rolesWithSameQuery = [
            'petugas1', 'petugas2', 'petugas3',
            'petugas4', 'petugas5', 'petugas6',
            'petugas7', 'petugas8', 'petugas9',
            'petugas10', 'petugas11', 'petugas12',
            'petugas13',  'direktur'
        ];

        // Ambil data sesuai dengan peran pengguna
        if ($currentUser->hasRole('admin')) {
            // Admin melihat semua data
            $monitorings = MonitoringLab::with('monitoring_lab_pertanggals')
                ->when($searchQuery, function ($query) use ($searchQuery) {
                    $query->where('id', 'like', '%' . $searchQuery . '%');
                })
                ->latest()
                ->paginate(10);

        } elseif ($currentUser->hasRole('karyawan')) {
            // Karyawan hanya melihat data miliknya berdasarkan ID
            $monitorings = MonitoringLab::with('monitoring_lab_pertanggals')
                ->whereHas('users', function (Builder $query) {
                    $query->where('user_id', Auth()->id());
                })
                ->where('id', Auth()->id()) // Ganti dengan ID yang sesuai
                ->latest()
                ->paginate(10);

        } elseif ($currentUser->hasAnyRole($rolesWithSameQuery)) {
            // Petugas dan direktur menggunakan query yang sama berdasarkan ID
            $monitorings = MonitoringLab::with('monitoring_lab_pertanggals')
                ->when($searchQuery, function ($query) use ($searchQuery) {
                    $query->where('id', 'like', '%' . $searchQuery . '%');
                })
                ->latest()
                ->paginate(10);
        } else {
            // Jika tidak ada role yang sesuai, kembalikan array kosong
            $monitorings = collect();
        }

        // Menghitung jumlah maksimal kolom tanggal
        $maxTanggalCount = $monitorings->reduce(function ($carry, $monitoring) {
            return max($carry, $monitoring->monitoring_lab_pertanggals->count());
        }, 0);

        return view('monitorings.index', compact('monitorings', 'maxTanggalCount'));
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
            'variabel' => 'required|string',
            'sub_variabel_1' => 'required|string',
            'sub_variabel_2' => 'required|string',
            'data_pertanggal_1' => 'required|array',
            'data_pertanggal_2' => 'required|array',
            'data_pertanggal_3' => 'required|array',
            'data_pertanggal_4' => 'required|array',
            'data_pertanggal_5' => 'required|array',
            'data_pertanggal_6' => 'required|array',
            'total_1' => 'required|integer',
            'total_2' => 'required|integer',
            'bulan' => 'required|integer|between:1,12', // Validasi bulan
        ]);

        try {
        // Hitung total dari data_pertanggal_1 sampai data_pertanggal_3
        $total1 = array_sum($request->data_pertanggal_1) + array_sum($request->data_pertanggal_2) + array_sum($request->data_pertanggal_3);

        // Hitung total dari data_pertanggal_4 sampai data_pertanggal_6
        $total2 = array_sum($request->data_pertanggal_4) + array_sum($request->data_pertanggal_5) + array_sum($request->data_pertanggal_6);

            // Hitung hasil, hindari pembagian dengan nol
            $hasil = ($total2 > 0) ? ($total1 / $total2) * 100 : 0;

            // Simpan data utama ke tabel 'monitorings'
            $monitorings = MonitoringLab::create([
                'variabel' => $request->variabel,
                'sub_variabel_1' => $request->sub_variabel_1,
                'sub_variabel_2' => $request->sub_variabel_2,
                'total_1' => $request->total_1,
                'total_2' => $request->total_2,
                'hasil' => $hasil, // Simpan hasil yang sudah dihitung
            ]);

            // Simpan data per tanggal ke tabel
            $month = $request->bulan; // Ambil bulan yang dipilih dari form
            $year = now()->year; // Ambil tahun saat ini

            foreach ($request->data_pertanggal_1 as $index => $data_pertanggal_1) {
                // Pastikan indeks hari dimulai dari 1
                $day = $index + 0;

                // Buat tanggal dari bulan dan hari yang dipilih
                $tanggal = \Carbon\Carbon::create($year, $month, $day);

                // Simpan data ke tabel
                MonitoringLabPertanggal::create([
                    'monitoring_lab_id' => $monitorings->id, // Hubungkan dengan plebiti yang baru dibuat
                    'data_pertanggal_1' => (float)$data_pertanggal_1,
                    'data_pertanggal_2' => (float)$request->data_pertanggal_2[$index],
                    'data_pertanggal_3' => (float)$request->data_pertanggal_3[$index],
                    'data_pertanggal_4' => (float)$request->data_pertanggal_4[$index],
                    'data_pertanggal_5' => (float)$request->data_pertanggal_5[$index],
                    'data_pertanggal_6' => (float)$request->data_pertanggal_6[$index],
                    'tanggal' => $tanggal, // Simpan tanggal yang benar
                ]);
            }

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
        $monitorings = MonitoringLab::with('monitoring_lab_pertanggals')->findOrFail($id);
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
            'variabel' => 'required|string',
            'sub_variabel_1' => 'required|string',
            'sub_variabel_2' => 'required|string',
            'data_pertanggal_1' => 'required|array',
            'data_pertanggal_2' => 'required|array',
            'data_pertanggal_3' => 'required|array',
            'data_pertanggal_4' => 'required|array',
            'data_pertanggal_5' => 'required|array',
            'data_pertanggal_6' => 'required|array',
            'total_1' => 'required|integer',
            'total_2' => 'required|integer',
            'bulan' => 'required|integer|between:1,12', // Validasi bulan
        ]);

        try {
            // Hitung total dari data_pertanggal_1 sampai data_pertanggal_3
        $total1 = array_sum($request->data_pertanggal_1) + array_sum($request->data_pertanggal_2) + array_sum($request->data_pertanggal_3);

        // Hitung total dari data_pertanggal_4 sampai data_pertanggal_6
        $total2 = array_sum($request->data_pertanggal_4) + array_sum($request->data_pertanggal_5) + array_sum($request->data_pertanggal_6);

            // Hitung hasil, hindari pembagian dengan nol
            $hasil = ($total2 > 0) ? ($total1 / $total2) * 100 : 0;

            // Cari dan update data utama di tabel
            $monitorings = MonitoringLab::findOrFail($id);
            $monitorings->update([
                'variabel' => $request->variabel,
                'sub_variabel_1' => $request->sub_variabel_1,
                'sub_variabel_2' => $request->sub_variabel_2,
                'total_1' => $request->total_1,
                'total_2' => $request->total_2,
                'hasil' => $hasil, // Simpan hasil yang sudah dihitung
            ]);

            // Hapus data plebititanggals yang lama
            $monitorings->monitoring_lab_pertanggals()->delete();

            // Simpan ulang data per tanggal ke tabel
            $month = $request->month; // Ambil bulan yang dipilih dari form
            $year = now()->year; // Ambil tahun saat ini

            foreach ($request->data_pertanggal_1 as $index => $data_pertanggal_1) {
                // Pastikan indeks hari dimulai dari 1, bukan 0
                $day = $index + 1;

                // Buat tanggal dari bulan dan hari yang dipilih
                $tanggal = \Carbon\Carbon::create($year, $month, $day);

                // Simpan data ke tabel
                MonitoringLabPertanggal::create([
                    'monitoring_lab_id' => $monitorings->id,
                    'data_pertanggal_1' => (float)$data_pertanggal_1,
                    'data_pertanggal_2' => (float)$request->data_pertanggal_2[$index],
                    'data_pertanggal_3' => (float)$request->data_pertanggal_3[$index],
                    'data_pertanggal_4' => (float)$request->data_pertanggal_4[$index],
                    'data_pertanggal_5' => (float)$request->data_pertanggal_5[$index],
                    'data_pertanggal_6' => (float)$request->data_pertanggal_6[$index],
                    'tanggal' => $tanggal, // Simpan tanggal yang benar
                ]);
            }

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
        $monitorings = MonitoringLab::with('monitoring_lab_pertanggals')->findOrFail($id);
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
            $monitoring = MonitoringLab::whereMonth('tanggal', date('m', strtotime($bulan)))->with(['monitoring_lab_pertanggals'])->paginate(10);
        } else {
            $monitoring = MonitoringLab::get();
        }
        return view('monitorings.export_monitoring', compact('monitoring', 'bulan'));
    }
}
