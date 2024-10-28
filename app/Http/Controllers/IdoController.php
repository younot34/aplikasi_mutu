<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ido;
use App\Models\Idotanggal;
use Illuminate\Database\Eloquent\Builder;

class IdoController extends Controller
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
        $idos = Ido::with('idotanggals')
            ->when($searchQuery, function ($query) use ($searchQuery) {
                $query->where('id', 'like', '%' . $searchQuery . '%');
            })
            ->latest()
            ->paginate(10);

    } elseif ($currentUser->hasRole('karyawan')) {
        // Karyawan hanya melihat data miliknya berdasarkan ID
        $idos = Ido::with('idotanggals')
            ->whereHas('users', function (Builder $query) {
                $query->where('user_id', Auth()->id());
            })
            ->where('id', Auth()->id()) // Ganti dengan ID yang sesuai
            ->latest()
            ->paginate(10);

    } elseif ($currentUser->hasAnyRole($rolesWithSameQuery)) {
        // Petugas dan direktur menggunakan query yang sama berdasarkan ID
        $idos = Ido::with('idotanggals')
            ->when($searchQuery, function ($query) use ($searchQuery) {
                $query->where('id', 'like', '%' . $searchQuery . '%');
            })
            ->latest()
            ->paginate(10);
    } else {
        // Jika tidak ada role yang sesuai, kembalikan array kosong
        $idos = collect();
    }

    // Menghitung jumlah maksimal kolom tanggal
    $maxTanggalCount = $idos->reduce(function ($carry, $ido) {
        return max($carry, $ido->idotanggals->count());
    }, 0);

    return view('idos.index', compact('idos', 'maxTanggalCount'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('idos.create');
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
        $hasil = ($total2 > 0) ? ($total1 / $total2) * 100 : 0;

        // Simpan data utama ke tabel 'idos'
        $ido = Ido::create([
            'judul' => $request->judul,
            'variabel' => $request->variabel,
            'sub_variabel_1' => $request->sub_variabel_1,
            'sub_variabel_2' => $request->sub_variabel_2,
            'sasaran' => $request->sasaran,
            'total_1' => $request->total_1,
            'total_2' => $request->total_2,
            'hasil' => $hasil, // Simpan hasil yang sudah dihitung
        ]);

        // Simpan data per tanggal ke tabel 'idotanggals'
        $month = $request->bulan; // Ambil bulan yang dipilih dari form
        $year = now()->year; // Ambil tahun saat ini

        foreach ($request->data_pertanggal_1 as $index => $data_pertanggal_1) {
            // Pastikan indeks hari dimulai dari 1, bukan 0
            $day = $index + 0;

            // Buat tanggal dari bulan dan hari yang dipilih
            $tanggal = \Carbon\Carbon::create($year, $month, $day);

            // Simpan data ke tabel 'idotanggals'
            Idotanggal::create([
                'ido_id' => $ido->id, // Hubungkan dengan IDO yang baru dibuat
                'data_pertanggal_1' => (float)$data_pertanggal_1,
                'data_pertanggal_2' => (float)$request->data_pertanggal_2[$index],
                'tanggal' => $tanggal, // Simpan tanggal yang benar
            ]);
        }

        return redirect()->route('idos.index')->with(['success' => 'Data Berhasil Disimpan!']);
    } catch (\Exception $e) {
        return redirect()->route('idos.index')->with(['error' => 'Data Gagal Disimpan! ' . $e->getMessage()]);
    }
}

public function show($id)
{
    $ido = Ido::with('idotanggals')->findOrFail($id);
    return view('idos.show', compact('ido'));
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
        $ido = Ido::with('idotanggals')->findOrFail($id);
        return view('idos.edit', compact('ido'));
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
        $hasil = ($total2 > 0) ? ($total1 / $total2) * 100 : 0;

        // Cari dan update data utama di tabel 'idos'
        $ido = Ido::findOrFail($id);
        $ido->update([
            'judul' => $request->judul,
            'variabel' => $request->variabel,
            'sub_variabel_1' => $request->sub_variabel_1,
            'sub_variabel_2' => $request->sub_variabel_2,
            'sasaran' => $request->sasaran,
            'total_1' => $request->total_1,
            'total_2' => $request->total_2,
            'hasil' => $hasil, // Simpan hasil yang sudah dihitung
        ]);

        // Hapus data idotanggals yang lama
        $ido->idotanggals()->delete();

        // Simpan ulang data per tanggal ke tabel 'idotanggals'
        $month = $request->month; // Ambil bulan yang dipilih dari form
        $year = now()->year; // Ambil tahun saat ini

        foreach ($request->data_pertanggal_1 as $index => $data_pertanggal_1) {
            // Pastikan indeks hari dimulai dari 1, bukan 0
            $day = $index + 1;

            // Buat tanggal dari bulan dan hari yang dipilih
            $tanggal = \Carbon\Carbon::create($year, $month, $day);

            // Simpan data ke tabel 'idotanggals'
            Idotanggal::create([
                'ido_id' => $ido->id, // Hubungkan dengan IDO yang sedang diperbarui
                'data_pertanggal_1' => (float)$data_pertanggal_1,
                'data_pertanggal_2' => (float)$request->data_pertanggal_2[$index],
                'tanggal' => $tanggal, // Simpan tanggal yang benar
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('idos.index')->with(['success' => 'Data Berhasil Diubah!']);
    } catch (\Exception $e) {
        // Redirect dengan pesan error
        return redirect()->route('idos.index')->with(['error' => 'Data Gagal Diubah! ' . $e->getMessage()]);
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
        $ido = Ido::with('idotanggals')->findOrFail($id);
        $ido->delete();

        if($ido){
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
            $ido = ido::whereMonth('tanggal', date('m', strtotime($bulan)))->with(['idotanggals'])->paginate(10);
        } else {
            $ido = ido::get();
        }
        return view('idos.export_ido', compact('ido', 'bulan'));
    }
}
