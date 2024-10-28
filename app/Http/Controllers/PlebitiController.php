<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plebiti;
use App\Models\Plebititanggal;
use Illuminate\Database\Eloquent\Builder;

class PlebitiController extends Controller
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
            'petugas4', 'petugas5', 'petugas6', 'petugas7', 'direktur'
        ];

        // Ambil data sesuai dengan peran pengguna
        if ($currentUser->hasRole('admin')) {
            // Admin melihat semua data
            $plebitis = Plebiti::with('plebititanggals')
                ->when($searchQuery, function ($query) use ($searchQuery) {
                    $query->where('id', 'like', '%' . $searchQuery . '%');
                })
                ->latest()
                ->paginate(10);

        } elseif ($currentUser->hasRole('karyawan')) {
            // Karyawan hanya melihat data miliknya berdasarkan ID
            $plebitis = Plebiti::with('plebititanggals')
                ->whereHas('users', function (Builder $query) {
                    $query->where('user_id', Auth()->id());
                })
                ->where('id', Auth()->id()) // Ganti dengan ID yang sesuai
                ->latest()
                ->paginate(10);

        } elseif ($currentUser->hasAnyRole($rolesWithSameQuery)) {
            // Petugas dan direktur menggunakan query yang sama berdasarkan ID
            $plebitis = Plebiti::with('plebititanggals')
                ->when($searchQuery, function ($query) use ($searchQuery) {
                    $query->where('id', 'like', '%' . $searchQuery . '%');
                })
                ->latest()
                ->paginate(10);
        } else {
            // Jika tidak ada role yang sesuai, kembalikan array kosong
            $plebitis = collect();
        }

        // Menghitung jumlah maksimal kolom tanggal
        $maxTanggalCount = $plebitis->reduce(function ($carry, $plebiti) {
            return max($carry, $plebiti->plebititanggals->count());
        }, 0);

        return view('plebitis.index', compact('plebitis', 'maxTanggalCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('plebitis.create');
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
        'judul' => 'required|string',
        'variabel' => 'required|string',
        'sub_variabel_1' => 'required|string',
        'sub_variabel_2' => 'required|string',
        'data_pertanggal_1' => 'required|array',
        'data_pertanggal_2' => 'required|array',
        'sasaran' => 'required|integer',
        'total_1' => 'required|integer',
        'total_2' => 'required|integer',
        'bulan' => 'required|integer|between:1,12', // Validasi bulan
    ]);

    try {
        // Hitung total dari data_pertanggal_1 dan data_pertanggal_2
        $total1 = array_sum($request->data_pertanggal_1);
        $total2 = array_sum($request->data_pertanggal_2);

        // Hitung hasil, hindari pembagian dengan nol
        $hasil = ($total2 > 0) ? ($total1 / $total2) * 1000 : 0;

        // Simpan data utama ke tabel 'plebitis'
        $plebiti = Plebiti::create([
            'judul' => $request->judul,
            'variabel' => $request->variabel,
            'sub_variabel_1' => $request->sub_variabel_1,
            'sub_variabel_2' => $request->sub_variabel_2,
            'sasaran' => $request->sasaran,
            'total_1' => $request->total_1,
            'total_2' => $request->total_2,
            'hasil' => $hasil, // Simpan hasil yang sudah dihitung
        ]);

        // Simpan data per tanggal ke tabel 'plebititanggals'
        $month = $request->bulan; // Ambil bulan yang dipilih dari form
        $year = now()->year; // Ambil tahun saat ini

        foreach ($request->data_pertanggal_1 as $index => $data_pertanggal_1) {
            // Pastikan indeks hari dimulai dari 1, bukan 0
            $day = $index + 0;

            // Buat tanggal dari bulan dan hari yang dipilih
            $tanggal = \Carbon\Carbon::create($year, $month, $day);

            // Simpan data ke tabel 'plebititanggals'
            Plebititanggal::create([
                'plebiti_id' => $plebiti->id, // Hubungkan dengan plebiti yang baru dibuat
                'data_pertanggal_1' => (float)$data_pertanggal_1,
                'data_pertanggal_2' => (float)$request->data_pertanggal_2[$index],
                'tanggal' => $tanggal, // Simpan tanggal yang benar
            ]);
        }

        return redirect()->route('plebitis.index')->with(['success' => 'Data Berhasil Disimpan!']);
    } catch (\Exception $e) {
        return redirect()->route('plebitis.index')->with(['error' => 'Data Gagal Disimpan! ' . $e->getMessage()]);
    }
}

public function show($id)
{
    $plebiti = Plebiti::with('plebititanggals')->findOrFail($id);
    return view('plebitis.show', compact('plebiti'));
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
        $plebiti = Plebiti::with('plebititanggals')->findOrFail($id);
        return view('plebitis.edit', compact('plebiti'));
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
        'judul' => 'required|string',
        'variabel' => 'required|string',
        'sub_variabel_1' => 'required|string',
        'sub_variabel_2' => 'required|string',
        'data_pertanggal_1' => 'required|array',
        'data_pertanggal_2' => 'required|array',
        'sasaran' => 'required|integer',
        'total_1' => 'required|integer',
        'total_2' => 'required|integer',
        'bulan' => 'required|integer|between:1,12', // Validasi bulan
    ]);

    try {
        // Hitung total dari data_pertanggal_1 dan data_pertanggal_2
        $total1 = array_sum($request->data_pertanggal_1);
        $total2 = array_sum($request->data_pertanggal_2);

        // Hitung hasil, hindari pembagian dengan nol
        $hasil = ($total2 > 0) ? ($total1 / $total2) * 1000 : 0;

        // Cari dan update data utama di tabel 'plebitis'
        $plebiti = Plebiti::findOrFail($id);
        $plebiti->update([
            'judul' => $request->judul,
            'variabel' => $request->variabel,
            'sub_variabel_1' => $request->sub_variabel_1,
            'sub_variabel_2' => $request->sub_variabel_2,
            'sasaran' => $request->sasaran,
            'total_1' => $request->total_1,
            'total_2' => $request->total_2,
            'hasil' => $hasil, // Simpan hasil yang sudah dihitung
        ]);

        // Hapus data plebititanggals yang lama
        $plebiti->plebititanggals()->delete();

        // Simpan ulang data per tanggal ke tabel 'plebititanggals'
        $month = $request->month; // Ambil bulan yang dipilih dari form
        $year = now()->year; // Ambil tahun saat ini

        foreach ($request->data_pertanggal_1 as $index => $data_pertanggal_1) {
            // Pastikan indeks hari dimulai dari 1, bukan 0
            $day = $index + 1;

            // Buat tanggal dari bulan dan hari yang dipilih
            $tanggal = \Carbon\Carbon::create($year, $month, $day);

            // Simpan data ke tabel 'plebititanggals'
            Plebititanggal::create([
                'plebiti_id' => $plebiti->id, // Hubungkan dengan plebiti yang sedang diperbarui
                'data_pertanggal_1' => (float)$data_pertanggal_1,
                'data_pertanggal_2' => (float)$request->data_pertanggal_2[$index],
                'tanggal' => $tanggal, // Simpan tanggal yang benar
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('plebitis.index')->with(['success' => 'Data Berhasil Diubah!']);
    } catch (\Exception $e) {
        // Redirect dengan pesan error
        return redirect()->route('plebitis.index')->with(['error' => 'Data Gagal Diubah! ' . $e->getMessage()]);
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
        $plebiti = Plebiti::with('plebititanggals')->findOrFail($id);
        $plebiti->delete();

        if($plebiti){
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
            $plebiti = Plebiti::whereMonth('tanggal', date('m', strtotime($bulan)))->with(['plebititanggals'])->paginate(10);
        } else {
            $plebiti = Plebiti::get();
        }
        return view('plebitis.export_plebiti', compact('plebiti', 'bulan'));
    }
}
