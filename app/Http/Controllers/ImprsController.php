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
       $this->middleware(['permission:imprs.index|imprs.create|imprs.edit|imprs.delete']);
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
               $imprs = $imprs->where('name', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $imprs = Imprs::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas')){
           $imprs = Imprs::where('created_by', Auth()->id())->latest()->when(request()->q, function($imprs) {
               $imprs = $imprs->where('created_by', Auth()->id())->where('name', 'like', '%'. request()->q . '%');
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
        $bulan = $request->input('bulan');
        if ($bulan) {
            $imprs = Imprs::whereMonth('waktu', date('m', strtotime($bulan)))->with('reseps')->paginate(10);
        } else {
            $imprs = Imprs::with('reseps')->paginate(10);
        }
        return view('imprs.export', compact('imprs', 'bulan'));
    }

    public function export(Request $request)
    {
        $bulan = $request->input('bulan');
        return Excel::download(new ImprsExport($bulan), 'export.xlsx');
    }


}
