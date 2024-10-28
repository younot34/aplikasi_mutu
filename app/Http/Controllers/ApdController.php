<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Apd;
use Illuminate\Database\Eloquent\Builder;

class ApdController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:apds.index|apds.create|apds.edit|apds.delete|apds.grafik_apd_tahunan']);
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $currentUser = User::findOrFail(Auth()->id());
        $unit = $currentUser->unit;
       if($currentUser->hasRole('admin')|| $unit === 'PPI' || $unit === 'mutu'){
            // Admin bisa melihat semua data
            $apd = Apd::latest()->when(request()->q, function($query) {
                $query->where('unit', 'like', '%' . request()->q . '%');
            })->paginate(10);
        } else {
            // Selain admin, hanya bisa melihat data sesuai unitnya
            $apd = Apd::where('unit', $unit)->latest()->when(request()->q, function($query) {
                $query->where('unit', 'like', '%' . request()->q . '%');
            })->paginate(10);
        }

       $user = new User();

       return view('apds.index', compact('apd','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('apds.create');
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
            'unit' => 'required|string',
            'nama_petugas' => 'nullable|string',
            'profesi' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'topi' => 'nullable|string',
            'kacamata' => 'nullable|string',
            'masker' => 'nullable|string',
            'gown' => 'nullable|string',
            'sarung_tangan' => 'nullable|string',
            'sepatu' => 'nullable|string',
            'ya' => 'nullable|string',
            'tidak' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        try {
            Apd::create([
                'tanggal' => $request->tanggal,
                'unit' => $request->unit,
                'nama_petugas' => $request->nama_petugas,
                'profesi' => $request->profesi,
                'tindakan' => $request->tindakan,
                'topi' => $request->topi,
                'kacamata' => $request->kacamata,
                'masker' => $request->masker,
                'gown' => $request->gown,
                'sarung_tangan' => $request->sarung_tangan,
                'sepatu' => $request->sepatu,
                'ya' => $request->ya,
                'tidak' => $request->tidak,
                'keterangan' => $request->keterangan,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('apds.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('apds.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $apd = Apd::findOrFail($id);
        return view('apds.edit', compact('apd'));
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
            'unit' => 'required|string',
            'nama_petugas' => 'nullable|string',
            'profesi' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'topi' => 'nullable|string',
            'kacamata' => 'nullable|string',
            'masker' => 'nullable|string',
            'gown' => 'nullable|string',
            'sarung_tangan' => 'nullable|string',
            'sepatu' => 'nullable|string',
            'ya' => 'nullable|string',
            'tidak' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);
        try {
            // Simpan data ke tabel ris
            $apd = Apd::findOrFail($id);
            $apd->update([
                'tanggal' => $request->tanggal,
                'unit' => $request->unit,
                'nama_petugas' => $request->nama_petugas,
                'profesi' => $request->profesi,
                'tindakan' => $request->tindakan,
                'topi' => $request->topi,
                'kacamata' => $request->kacamata,
                'masker' => $request->masker,
                'gown' => $request->gown,
                'sarung_tangan' => $request->sarung_tangan,
                'sepatu' => $request->sepatu,
                'ya' => $request->ya,
                'tidak' => $request->tidak,
                'keterangan' => $request->keterangan,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('apds.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('apds.index')->with(['error' => 'Data Gagal Diubah!']);
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
        $apd = Apd::findOrFail($id);
        $apd->delete();

        if($apd){
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
        $currentUser = User::findOrFail(auth()->id()); // Get the logged-in user
        $bulan = $request->input('bulan', date('Y-m')); // Default to current month if no input
        $selectedUnit = $request->input('unit'); // Get the selected unit from the request

        // Query for filtering APD data based on month and year
        $apdQuery = Apd::whereMonth('tanggal', '=', date('m', strtotime($bulan)))
            ->whereYear('tanggal', '=', date('Y', strtotime($bulan)));

        // Admin or users in the 'PPI' unit can filter by selected unit
        if ($currentUser->hasRole('admin') || $currentUser->unit === 'PPI') {
            if ($selectedUnit) {
                // Apply unit filter if selected
                $apdQuery->where('unit', $selectedUnit);
            }
        } else {
            // Other users can only see data from their own unit
            $apdQuery->where('unit', $currentUser->unit);
        }

        // Paginate the filtered data
        $apd = $apdQuery->get();

        // Get a list of distinct units from the `users` table for filtering (accessible by admin and PPI)
        $units = User::select('unit')->distinct()->get();

        // Return view with data
        return view('apds.export_apd', compact('apd', 'bulan', 'units', 'selectedUnit'));
    }
    
    public function laporanTahunanApd(Request $request)
{
    $tahun = $request->input('tahun', date('Y'));
    $unit = $request->input('unit');

    // Ambil data APD berdasarkan tahun dan unit yang dipilih
    $query = Apd::whereYear('tanggal', $tahun);

    if ($unit) {
        $query->where('unit', $unit);
    }

    $apd = $query->get();

    // Array untuk menyimpan data ya dan tidak tiap bulan
    $dataPerBulan = array_fill(1, 12, ['ya' => 0, 'tidak' => 0]);

    foreach ($apd as $item) {
        $bulan = (int)date('m', strtotime($item->tanggal));
        $dataPerBulan[$bulan]['ya'] += $item->ya === '✔️' ? 1 : 0;
        $dataPerBulan[$bulan]['tidak'] += $item->tidak === '✔️' ? 1 : 0;
    }

    // Menghitung persentase tiap bulan
    $capaian = [];
    foreach ($dataPerBulan as $bulan => $data) {
        $total = $data['ya'] + $data['tidak'];
        if ($total > 0) {
            $capaian[$bulan] = ($data['ya'] / $total) * 100; // Capaian dalam persen
        } else {
            $capaian[$bulan] = 0;
        }
    }

    // Data untuk Chart.js
    $chartData = [
        'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        'capaian' => array_values($capaian),
        'target' => array_fill(0, 12, 100), // Target 80%
        'totalYa' => array_column($dataPerBulan, 'ya'),
        'totalTidak' => array_column($dataPerBulan, 'tidak'),
    ];

    return view('apds.grafik_apd_tahunan', compact('chartData', 'tahun', 'unit', 'apd'));
}


}
