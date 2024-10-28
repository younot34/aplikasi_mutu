<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rajal;
use Illuminate\Database\Eloquent\Builder;

class RajalController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:rajals.index|rajals.create|rajals.edit|rajals.delete|rajals.grafik_rajal']);
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
           $rajal = Rajal::latest()->when(request()->q, function($rajal) {
               $rajal = $rajal->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $rajal = Rajal::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $rajal = Rajal::latest()->when(request()->q, function($rajal) {
               $rajal = $rajal->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $rajal = Rajal::latest()->when(request()->q, function($rajal) {
               $rajal = $rajal->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $rajal = Rajal::latest()->when(request()->q, function($rajal) {
               $rajal = $rajal->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $rajal = Rajal::latest()->when(request()->q, function($rajal) {
               $rajal = $rajal->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $rajal = Rajal::latest()->when(request()->q, function($rajal) {
               $rajal = $rajal->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $rajal = Rajal::latest()->when(request()->q, function($rajal) {
               $rajal = $rajal->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $rajal = Rajal::latest()->when(request()->q, function($rajal) {
               $rajal = $rajal->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas8')){
           $rajal = Rajal::latest()->when(request()->q, function($rajal) {
               $rajal = $rajal->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas9')){
           $rajal = Rajal::latest()->when(request()->q, function($rajal) {
               $rajal = $rajal->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $rajal = Rajal::latest()->when(request()->q, function($rajal) {
               $rajal = $rajal->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('rajals.index', compact('rajal','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('rajals.create');
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
            'poli' => 'required|string',
            'patuh' => 'nullable|integer',
            'tidak_patuh' => 'nullable|integer',
        ]);

        try {
            // Simpan data ke tabel ris
            Rajal::create([
                'tanggal' => $request->tanggal,
                'poli' => $request->poli,
                'patuh' => $request->patuh,
                'tidak_patuh' => $request->tidak_patuh,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('rajals.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('rajals.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $rajal = Rajal::findOrFail($id);
        return view('rajals.edit', compact('rajal'));
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
            'poli' => 'required|string',
            'patuh' => 'nullable|integer',
            'tidak_patuh' => 'nullable|integer',
        ]);
        try {
            // Simpan data ke tabel ris
            $rajal = Rajal::findOrFail($id);
            $rajal->update([
                'tanggal' => $request->tanggal,
                'poli' => $request->poli,
                'patuh' => $request->patuh,
                'tidak_patuh' => $request->tidak_patuh,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('rajals.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('rajals.index')->with(['error' => 'Data Gagal Diubah!']);
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
        $rajal = Rajal::findOrFail($id);
        $rajal->delete();

        if($rajal){
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
            $rajal = Rajal::whereMonth('tanggal', date('m', strtotime($bulan)))->get();
        } else {
            $rajal = Rajal::get();
        }
        return view('rajals.export_ra', compact('rajal', 'bulan'));
    }
    
    public function laporanTahunan(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
    
        // Ambil data rawat jalan (rajal) dalam satu tahun
        $rajals = Rajal::whereYear('tanggal', $tahun)->get();
    
        // Data per bulan
        $dataPerBulan = array_fill(1, 12, ['patuh' => 0, 'tidak_patuh' => 0]);
    
        foreach ($rajals as $rajal) {
            $bulan = (int)date('m', strtotime($rajal->tanggal));
            $dataPerBulan[$bulan]['patuh'] += $rajal->patuh;
            $dataPerBulan[$bulan]['tidak_patuh'] += $rajal->tidak_patuh;
        }
    
        // Menghitung persentase tiap bulan
        $capaian = [];
        foreach ($dataPerBulan as $bulan => $data) {
            if ($data['patuh'] + $data['tidak_patuh'] > 0) { // Pastikan tidak dibagi dengan nol
                $capaian[$bulan] = ($data['tidak_patuh'] / $data['patuh']) * 100; // Hitung persentase kepatuhan
            } else {
                $capaian[$bulan] = 0;
            }
        }
    
        // Data untuk Chart.js
        $chartData = [
            'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'capaian' => array_values($capaian), // Persentase kepatuhan per bulan
            'patuh' => array_column($dataPerBulan, 'patuh'), // Jumlah patuh per bulan
            'tidak_patuh' => array_column($dataPerBulan, 'tidak_patuh'), // Jumlah tidak patuh per bulan
            'target' => array_fill(0, 12, 80) // Target 80% (tambahkan ini)
        ];
    
        return view('rajals.grafik_rajal', compact('chartData', 'tahun'));
    }


}
