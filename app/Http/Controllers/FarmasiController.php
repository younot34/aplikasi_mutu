<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farmasi;
use App\Models\User;
use App\Models\Obat;
use App\Models\nama_obat;
use App\Models\listobat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Exports\FarmasiExport;
use Maatwebsite\Excel\Facades\Excel;

class FarmasiController extends Controller
{
    public $farmasi;

    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:farmasis.index|farmasis.create|farmasis.edit|farmasis.delete|farmasis.laporan-bulanan-far']);
   }

   public function export(Request $request)
    {
        return Excel::download(new FarmasiExport($request->input('bulan')), 'laporan-bulanan.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

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
           $farmasis = Farmasi::latest()->when(request()->q, function($farmasis) {
               $farmasis = $farmasis->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $farmasis = Farmasi::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
            $farmasis = Farmasi::latest()->when(request()->q, function($farmasis) {
               $farmasis = $farmasis->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $farmasis = Farmasi::latest()->when(request()->q, function($farmasis) {
               $farmasis = $farmasis->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $farmasis = Farmasi::latest()->when(request()->q, function($farmasis) {
               $farmasis = $farmasis->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $farmasis = Farmasi::latest()->when(request()->q, function($farmasis) {
               $farmasis = $farmasis->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $farmasis = Farmasi::latest()->when(request()->q, function($farmasis) {
               $farmasis = $farmasis->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $farmasis = Farmasi::latest()->when(request()->q, function($farmasis) {
               $farmasis = $farmasis->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $farmasis = Farmasi::latest()->when(request()->q, function($farmasis) {
               $farmasis = $farmasis->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $farmasis = Farmasi::latest()->when(request()->q, function($farmasis) {
               $farmasis = $farmasis->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('farmasis.index', compact('farmasis','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        // $list = listobat::all();
        return view('farmasis.create');
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
            'nama_px' => 'required|string',
            'no_rm' => 'required|string',
            'r' => 'array',
            'nama_obat' => 'array',
            'total_obat_fornas' => 'array',
            'total_item' => 'array',
        ]);

        try {
            // Simpan data ke tabel farmasis
            $farmasi = Farmasi::create([
                'waktu' => $request->waktu,
                'nama_px' => $request->nama_px,
                'no_rm' => $request->no_rm,
            ]);

            // Loop melalui input array dan simpan ke tabel obats
            foreach ($request->total_obat_fornas as $index => $total_obat_fornas) {
                $data = [
                    'farmasi_id' => $farmasi->id,
                    'total_obat_fornas' => $total_obat_fornas,
                    'total_item' => $request->total_item[$index],
                ];

                // Simpan data ke tabel obats
                Obat::create($data);
            }

            foreach ($request->nama_obat as $index => $nama_obat) {
                $data = [
                    'farmasi_id' => $farmasi->id,
                    'nama_obat' => $nama_obat,
                    'r' => $request->r[$index],
                ];

                // Simpan data ke tabel nama_obats
                nama_obat::create($data);
            }

            // Redirect dengan pesan sukses
            return redirect()->route('farmasis.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('farmasis.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $farmasi = Farmasi::with('obats','nama_obats')->findOrFail($id);
        return view('farmasis.edit', compact('farmasi'));
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
            'nama_px' => 'required|string',
            'no_rm' => 'required|string',
            'r' => 'array',
            'nama_obat' => 'array',
            'total_obat_fornas' => 'array',
            'total_item' => 'array',
        ]);

        try {
            // Update data farmasi
            $farmasi = Farmasi::findOrFail($id);
            $farmasi->update([
                'waktu' => $request->waktu,
                'nama_px' => $request->nama_px,
                'no_rm' => $request->no_rm,
            ]);

            // Hapus data obats lama
            $farmasi->obats()->delete();
            $farmasi->nama_obats()->delete();

            // Simpan data obats baru
            foreach ($request->total_obat_fornas as $index => $total_obat_fornas) {
                $data = [
                    'farmasi_id' => $farmasi->id,
                    'total_obat_fornas' => $total_obat_fornas,
                    'total_item' => $request->total_item[$index],
                ];

                Obat::create($data);
            }
            foreach ($request->nama_obat as $index => $nama_obat) {
                $data = [
                    'farmasi_id' => $farmasi->id,
                    'nama_obat' => $nama_obat,
                    'r' => $request->r[$index],
                ];

                nama_obat::create($data);
            }

            // Redirect dengan pesan sukses
            return redirect()->route('farmasis.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('farmasis.index')->with(['success' => 'Data Berhasil Diperbarui!']);
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
        $farmasi = Farmasi::findOrFail($id);
        $farmasi->delete();

        if($farmasi){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function addFarmasiInput(): void
    {
        $this->farmasi[] = ['waktu' =>'',
        'nama_px'=>'',
        'no_rm' => '',
        'r'=>'',
        'nama_obat'=>'',
        'total_obat_fornas'=>'',
        'total_item'=>''];
    }
    public function addObatInput(): void
    {
        $this->farmasi[] = [
        'r'=>'',
        'nama_obat'=>'',
        'total_obat_fornas'=>'',
        'total_item'=>''];
    }
    public function removeFarmasiInput(int $index): void
    {
        unset($this->farmasi[$index]);
        $this->farmasi = array_values($this->farmasi);
    }

    public function laporanBulanan(Request $request)
    {
        $bulan = $request->input('bulan', date('Y-m')); // Default ke bulan ini
        $farmasis = Farmasi::with('obats')
            ->whereMonth('waktu', date('m', strtotime($bulan)))
            ->whereYear('waktu', date('Y', strtotime($bulan)))
            ->get();

        $totalObatFornas = $farmasis->sum(function($farmasi) {
            return $farmasi->obats->sum('total_obat_fornas');
        });

        $totalItem = $farmasis->sum(function($farmasi) {
            return $farmasi->obats->sum('total_item');
        });

        return view('farmasis.laporan-bulanan-far', compact('farmasis', 'bulan', 'totalObatFornas', 'totalItem'));
    }

}
