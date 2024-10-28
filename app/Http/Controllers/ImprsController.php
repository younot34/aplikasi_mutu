<?php

namespace App\Http\Controllers;

use App\Models\Imprs;
use App\Models\Resep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\ImprsExport;
use Maatwebsite\Excel\Facades\Excel;

class ImprsController extends Controller
{
    public $Imprs;

    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:imprs.index|imprs.create|imprs.edit|imprs.delete|imprs.grafik_doublecheck']);
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
       if($currentUser->hasRole('admin')){
           $imprs = Imprs::latest()->when(request()->q, function($imprs) {
               $imprs = $imprs->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $imprs = Imprs::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $imprs = Imprs::latest()->when(request()->q, function($imprs) {
               $imprs = $imprs->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $imprs = Imprs::latest()->when(request()->q, function($imprs) {
               $imprs = $imprs->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $imprs = Imprs::latest()->when(request()->q, function($imprs) {
               $imprs = $imprs->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $imprs = Imprs::latest()->when(request()->q, function($imprs) {
               $imprs = $imprs->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $imprs = Imprs::latest()->when(request()->q, function($imprs) {
               $imprs = $imprs->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $imprs = Imprs::latest()->when(request()->q, function($imprs) {
               $imprs = $imprs->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $imprs = Imprs::latest()->when(request()->q, function($imprs) {
               $imprs = $imprs->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas8')){
           $imprs = Imprs::latest()->when(request()->q, function($imprs) {
               $imprs = $imprs->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas9')){
           $imprs = Imprs::latest()->when(request()->q, function($imprs) {
               $imprs = $imprs->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $imprs = Imprs::latest()->when(request()->q, function($imprs) {
               $imprs = $imprs->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('imprs.index', compact('imprs','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('imprs.create');
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
        // Validasi input
        $request->validate([
            'waktu' => 'required|date',
            'resep_terverifikasi' => 'required|array',
            'resep_high_alert' => 'required|array',
        ]);

        try {
            // Simpan data ke tabel imprs
            $imprs = Imprs::create([
                'waktu' => $request->waktu,
            ]);

            // Loop melalui input array dan simpan ke tabel resep
            foreach ($request->resep_terverifikasi as $index => $resep_terverifikasi) {
                $data = [
                    'imprs_id' => $imprs->id,
                    'resep_terverifikasi' => $resep_terverifikasi,
                    'resep_high_alert' => $request->resep_high_alert[$index],
                ];

                // Simpan data ke tabel resep
                Resep::create($data);
            }

            // Redirect dengan pesan sukses
            return redirect()->route('imprs.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('imprs.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $imprs = Imprs::with('reseps')->findOrFail($id);
        return view('imprs.edit', compact('imprs'));
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
        // Validasi input
        $request->validate([
            'waktu' => 'required|date',
            'resep_terverifikasi' => 'required|array',
            'resep_high_alert' => 'required|array',
        ]);

        try {
            // Update data imprs
            $imprs = Imprs::findOrFail($id);
            $imprs->update([
                'waktu' => $request->waktu,
            ]);

            // Hapus data reseps lama
            $imprs->reseps()->delete();

            // Simpan data reseps baru
            foreach ($request->resep_terverifikasi as $index => $resep_terverifikasi) {
                $data = [
                    'imprs_id' => $imprs->id,
                    'resep_terverifikasi' => $resep_terverifikasi,
                    'resep_high_alert' => $request->resep_high_alert[$index],
                ];

                Resep::create($data);
            }

            // Redirect dengan pesan sukses
            return redirect()->route('imprs.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('imprs.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $Imprs = Imprs::findOrFail($id);
        $Imprs->delete();

        if($Imprs){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function addImprsInput(): void
    {
        $this->Imprs[] = ['waktu' =>'',
        'nama_px'=>'',
        'r'=>'',
        'nama_resep'=>'',
        'total_resep_fornas'=>'',
        'total_item'=>''];
    }
    public function addresepInput(): void
    {
        $this->Imprs[] = [
        'r'=>'',
        'nama_resep'=>'',
        'total_resep_fornas'=>'',
        'total_item'=>''];
    }
    public function removeImprsInput(int $index): void
    {
        unset($this->Imprs[$index]);
        $this->Imprs = array_values($this->Imprs);
    }
    public function laporanBulanan(Request $request)
    {
        $bulan = $request->input('bulan'); // Mengambil bulan dari input
        $imprs = Imprs::with('reseps'); // Mulai dengan query untuk Imprs yang terkait dengan reseps

        // Jika bulan diberikan, filter berdasarkan bulan tersebut
        if ($bulan) {
            $imprs = $imprs->whereMonth('waktu', date('m', strtotime($bulan)));
        }

        // Ambil data dengan paginasi
        $imprs = $imprs->get();

        return view('imprs.export', compact('imprs', 'bulan'));
    }
    
    public function laporanTahunan(Request $request)
    {
        $tahun = $request->get('tahun', date('Y'));
    
        // Inisialisasi bulan
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $achievements = [];
        $totalHighAlert = [];
        $totalTerverifikasi = [];
    
        // Loop untuk setiap bulan dalam setahun
        foreach (range(1, 12) as $month) {
            $monthlyData = Imprs::whereYear('waktu', $tahun)
                                ->whereMonth('waktu', $month)
                                ->with('reseps')
                                ->get();
    
            // Menghitung total resep terverifikasi dan high alert untuk bulan tertentu
            $highAlert = $monthlyData->sum(function($imprss) {
                return $imprss->reseps->sum('resep_high_alert');
            });
    
            $terverifikasi = $monthlyData->sum(function($imprss) {
                return $imprss->reseps->sum('resep_terverifikasi');
            });
    
            // Menyimpan total resep
            $totalHighAlert[] = $highAlert;
            $totalTerverifikasi[] = $terverifikasi;
    
            // Menghitung persentase capaian jika ada resep high alert, jika tidak, 0%
            if ($highAlert > 0) {
                $achievements[] = ($terverifikasi / $highAlert) * 100;
            } else {
                $achievements[] = 0;
            }
        }
    
        // Mengembalikan data ke view
        return view('imprs.grafik_doublecheck', compact('tahun', 'achievements', 'months', 'totalHighAlert', 'totalTerverifikasi'));
    }

    public function export(Request $request)
    {
        $bulan = $request->input('bulan');
        return Excel::download(new ImprsExport($bulan), 'export.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }


}
