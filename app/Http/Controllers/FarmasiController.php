<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farmasi;
use App\Models\User;
use App\Models\Obat;
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
    public function index()
    {
        $currentUser = User::findOrFail(Auth()->id());
       if($currentUser->hasRole('admin')){
           $farmasis = Farmasi::latest()->when(request()->q, function($farmasis) {
               $farmasis = $farmasis->where('name', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $farmasis = Farmasi::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas')){
           $farmasis = Farmasi::where('created_by', Auth()->id())->latest()->when(request()->q, function($farmasis) {
               $farmasis = $farmasis->where('created_by', Auth()->id())->where('name', 'like', '%'. request()->q . '%');
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
            ]);

            // Loop melalui input array dan simpan ke tabel obats
            foreach ($request->r as $index => $r) {
                $data = [
                    'farmasi_id' => $farmasi->id,
                    'r' => $r,
                    'nama_obat' => $request->nama_obat[$index],
                    'total_obat_fornas' => $request->total_obat_fornas[$index],
                    'total_item' => $request->total_item[$index],
                ];

                // Simpan data ke tabel obats
                Obat::create($data);
            }

            // Redirect dengan pesan sukses
            return redirect()->route('farmasis.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('farmasis.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $farmasi = Farmasi::with('obats')->findOrFail($id);
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
            ]);

            // Hapus data obats lama
            $farmasi->obats()->delete();

            // Simpan data obats baru
            foreach ($request->r as $index => $r) {
                $data = [
                    'farmasi_id' => $farmasi->id,
                    'r' => $r,
                    'nama_obat' => $request->nama_obat[$index],
                    'total_obat_fornas' => $request->total_obat_fornas[$index],
                    'total_item' => $request->total_item[$index],
                ];

                Obat::create($data);
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
