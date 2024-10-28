<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ppi;
use App\Models\Profesi;
use App\Models\Indikasi;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\PpiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class PpiController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:ppis.index|ppis.create|ppis.edit|ppis.delete|ppis.grafik_ppi_tahunan']);
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
        if($currentUser->hasRole('admin')|| $unit === 'PPI'){
            // Admin bisa melihat semua data
            $ppis = Ppi::latest()->when(request()->q, function($query) {
                $query->where('unit', 'like', '%' . request()->q . '%');
            })->paginate(10);
        } else {
            // Selain admin, hanya bisa melihat data sesuai unitnya
            $ppis = Ppi::where('unit', $unit)->latest()->when(request()->q, function($query) {
                $query->where('unit', 'like', '%' . request()->q . '%');
            })->paginate(10);
        }

        return view('ppis.index', compact('ppis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        //
        return view('ppis.create');
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
            'unit' => 'required',
            'tanggal' => 'required|date',
            'observer' => 'required',
            'profesi' => 'array',
            'jumlah' => 'array',
            'opp' => 'array',
            'indikasi' => 'array',
            'cuci_tangan' => 'array',
        ]);

        try {
            // Simpan data ke tabel ppis
            $ppi = Ppi::create([
                'unit' => $request->unit,
                'tanggal' => $request->tanggal,
                'observer' => $request->observer,
            ]);

            $ppi_id = $ppi->id;

            // Simpan data ke tabel profesis
            foreach ($request->profesi as $index => $profesi) {
                $data = [
                    'ppi_id' => $ppi_id,
                    'profesi' => $profesi,
                    'jumlah' => $request->jumlah[$index],
                    'opp' => $request->opp[$index],
                ];
                Profesi::create($data);
            }

            // Simpan data ke tabel indikasis
            foreach ($request->opp as $index => $opp) {
                $data = [
                    'ppi_id' => $ppi_id,
                    'opp' => $opp,
                    'indikasi' => $request->indikasi[$index],
                    'cuci_tangan' => $request->cuci_tangan[$index],
                ];
                Indikasi::create($data);
            }

            return redirect()->route('ppis.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            return redirect()->route('ppis.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $ppis = Ppi::with('profesis','indikasis')->findOrFail($id);
        return view('ppis.edit', compact('ppis'));
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
            'unit' => 'required',
            'tanggal' => 'required|date',
            'observer' => 'required',
            'profesi' => 'array',
            'jumlah' => 'array',
            'opp' => 'array',
            'indikasi' => 'array',
            'cuci_tangan' => 'array',
        ]);

        try {
            // Simpan data ke tabel ppis
            $ppis = Ppi::findOrFail($id);
            $ppis->update([
                'unit' => $request->unit,
                'tanggal' => $request->tanggal,
                'observer' => $request->observer,
            ]);

            $ppi_id = $ppis->id;
            $ppis->profesis()->delete();
            $ppis->indikasis()->delete();

            // Simpan data ke tabel profesis
            foreach ($request->profesi as $index => $profesi) {
                $data = [
                    'ppi_id' => $ppi_id,
                    'profesi' => $profesi,
                    'jumlah' => $request->jumlah[$index],
                    'opp' => $request->opp[$index],
                ];
                Profesi::create($data);
            }

            // Simpan data ke tabel indikasis
            foreach ($request->opp as $index => $opp) {
                $data = [
                    'ppi_id' => $ppi_id,
                    'opp' => $opp,
                    'indikasi' => $request->indikasi[$index],
                    'cuci_tangan' => $request->cuci_tangan[$index],
                ];
                Indikasi::create($data);
            }

            return redirect()->route('ppis.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            return redirect()->route('ppis.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $ppi = Ppi::findOrFail($id);
        $ppi->delete();

        if($ppi){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    // public function laporanBulanan(Request $request)
    // {
    //     $bulan = $request->input('bulan', date('Y-m')); // Default ke bulan ini
    //     $ppis = ppi::with(['profesis,indikasis'])
    //         ->whereMonth('tanggal','=', date('m', strtotime($bulan)))
    //         ->whereYear('tanggal','=', date('Y', strtotime($bulan)))
    //         ->get();
    //     return view('ppis.export', compact('ppis', 'bulan'));
    // }

    public function laporanBulanan(Request $request)
    {
        $currentUser = Auth::user(); // Mengambil user yang sedang login
        $unit = $currentUser->unit;
        $bulan = $request->input('bulan', date('Y-m')); // Default ke bulan ini
    
        // Query untuk PPI, menggunakan eager loading untuk relasi
        $ppisQuery = Ppi::with(['profesis', 'indikasis'])
            ->whereMonth('tanggal', '=', date('m', strtotime($bulan)))
            ->whereYear('tanggal', '=', date('Y', strtotime($bulan)));
    
        $selectedUnit = $request->input('unit');
    
        // Admin atau PPI bisa melihat semua data dan filter unit jika dipilih
        if ($currentUser->hasRole('admin') || $unit === 'PPI') {
            if ($selectedUnit) {
                $ppisQuery->where('unit', $selectedUnit);
            }
        } else {
            // Pengguna biasa hanya melihat data dari unitnya sendiri
            $ppisQuery->where('unit', $unit);
        }
    
        // Eksekusi query untuk mendapatkan data
        $ppis = $ppisQuery->get();
    
        // Mendapatkan daftar unit yang tersedia untuk dropdown
        $units = User::select('unit')->distinct()->get();
    
        // Mengirim data ke view
        return view('ppis.export_ppi', compact('ppis', 'bulan', 'units', 'selectedUnit'));
    }

    // public function laporanBulanan(Request $request)
    // {
    //     $bulan = $request->input('bulan' );
    //     if ($bulan) {
    //         $ppis = ppi::whereMonth('tanggal', date('m', strtotime($bulan)))->with('profesis','indikasis')->paginate(10);
    //     } else {
    //         $ppis = ppi::with('profesis','indikasis')->paginate(10);
    //     }
    //     return view('ppis.export', compact('ppis', 'bulan'));
    // }

    public function export(Request $request)
    {
        return Excel::download(new PpiExport($request->input('bulan')), 'export.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }
    
    public function laporanTahunanPpi(Request $request)
{
    $tahun = $request->input('tahun', date('Y'));

    // Ambil data PPI berdasarkan tahun
    $ppis = Ppi::whereYear('tanggal', $tahun)->get();

    // Array untuk menyimpan data patuh dan tidak patuh per bulan
    $dataPerBulan = array_fill(1, 12, [
        'jumlah_patuh' => 0,
        'jumlah_cuci_tangan' => 0,
    ]);

    foreach ($ppis as $ppi) {
        $bulan = (int)date('m', strtotime($ppi->tanggal));
        foreach ($ppi->profesis as $profesi) {
            $dataPerBulan[$bulan]['jumlah_patuh'] += $profesi->jumlah; // Total patuh
        }
        foreach ($ppi->indikasis as $indikasi) {
            $dataPerBulan[$bulan]['jumlah_cuci_tangan']++; // Total cuci tangan
        }
    }

    // Menghitung jumlah tidak patuh dan persentase
    foreach ($dataPerBulan as $bulan => $data) {
        $dataPerBulan[$bulan]['jumlah_tidak_patuh'] = $data['jumlah_cuci_tangan'] - $data['jumlah_patuh'];
        if ($data['jumlah_cuci_tangan'] > 0) {
            $dataPerBulan[$bulan]['persentase_patuh'] = ($data['jumlah_patuh'] / $data['jumlah_cuci_tangan']) * 100;
        } else {
            $dataPerBulan[$bulan]['persentase_patuh'] = 0;
        }
    }

    // Data untuk Chart.js
    $chartData = [
        'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        'jumlah_patuh' => array_column($dataPerBulan, 'jumlah_patuh'),
        'jumlah_tidak_patuh' => array_column($dataPerBulan, 'jumlah_tidak_patuh'),
        'persentase' => array_column($dataPerBulan, 'persentase_patuh'),
        'target' => array_fill(0, 12, 85), // Target 80%
    ];

    return view('ppis.grafik_ppi_tahunan', compact('chartData', 'tahun', 'dataPerBulan'));
}


}
