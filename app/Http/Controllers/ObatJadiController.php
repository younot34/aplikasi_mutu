<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Obat_jadi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
// use App\Exports\ObatJadiExport;
use Maatwebsite\Excel\Facades\Excel;

class ObatJadiController extends Controller
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
           $obat_jadi = Obat_jadi::latest()->when(request()->q, function($obat_jadi) {
               $obat_jadi = $obat_jadi->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $obat_jadi = Obat_jadi::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $obat_jadi = Obat_jadi::latest()->when(request()->q, function($obat_jadi) {
               $obat_jadi = $obat_jadi->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $obat_jadi = Obat_jadi::latest()->when(request()->q, function($obat_jadi) {
               $obat_jadi = $obat_jadi->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $obat_jadi = Obat_jadi::latest()->when(request()->q, function($obat_jadi) {
               $obat_jadi = $obat_jadi->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $obat_jadi = Obat_jadi::latest()->when(request()->q, function($obat_jadi) {
               $obat_jadi = $obat_jadi->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $obat_jadi = Obat_jadi::latest()->when(request()->q, function($obat_jadi) {
               $obat_jadi = $obat_jadi->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $obat_jadi = Obat_jadi::latest()->when(request()->q, function($obat_jadi) {
               $obat_jadi = $obat_jadi->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $obat_jadi = Obat_jadi::latest()->when(request()->q, function($obat_jadi) {
               $obat_jadi = $obat_jadi->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $obat_jadi = Obat_jadi::latest()->when(request()->q, function($obat_jadi) {
               $obat_jadi = $obat_jadi->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();
        $bulan = $request->input('bulan', date('Y-m'));
        $tanggal = Carbon::parse($bulan . '-01');
        $akhirBulan = $tanggal->copy()->endOfMonth();

       return view('obat_jadis.index', compact('obat_jadi','user','bulan', 'tanggal', 'akhirBulan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        return view('obat_jadis.create');
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
            Obat_jadi::create([
                'tanggal' =>$request->tanggal,
                'nama_pasien' =>$request->nama_pasien,
                'resep_masuk' =>$request->resep_masuk,
                'resep_diserahkan' =>$request->resep_diserahkan,
                'waktu_pelayanan' =>$request->waktu_pelayanan,
            ]);


            // Redirect dengan pesan sukses
            return redirect()->route('obat_jadis.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('obat_jadis.index')->with(['error' => 'Data Gagal Disimpan! Error: ' . $e->getMessage()]);
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
        $obat_jadis = Obat_jadi::findOrFail($id);
        return view('obat_jadis.edit', compact('obat_jadis'));
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
            $obat_jadis = Obat_jadi::findOrFail($id);
            $obat_jadis->update([
                'tanggal' =>$request->tanggal,
                'nama_pasien' =>$request->nama_pasien,
                'resep_masuk' =>$request->resep_masuk,
                'resep_diserahkan' =>$request->resep_diserahkan,
                'waktu_pelayanan' =>$request->waktu_pelayanan,
            ]);

            return redirect()->route('obat_jadis.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('obat_jadis.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $obat_jadis = Obat_jadi::findOrFail($id);
        $obat_jadis->delete();

        if($obat_jadis){
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
            $obat_jadis = Obat_jadi::whereMonth('tanggal', date('m', strtotime($bulan)))->get();
        } else {
            $obat_jadis = Obat_jadi::get();
        }
        return view('obat_jadis.export_oj', compact('obat_jadis', 'bulan'));
    }
}
