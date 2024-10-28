<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Oks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exports\OksExport;
use Maatwebsite\Excel\Facades\Excel;


class OkController extends Controller
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
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $oks = Oks::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();
        $bulan = $request->input('bulan', date('Y-m'));
        $tanggal = Carbon::parse($bulan . '-01');
        $akhirBulan = $tanggal->copy()->endOfMonth();

       return view('oks.index', compact('oks','user','bulan', 'tanggal', 'akhirBulan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $tanggal = $request->input('date');
        return view('oks.create', compact('tanggal'));
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
            'no_rm' => 'nullable|string',
            'nama_pasien' => 'nullable|string',
            'umur' => 'nullable|integer',
            'diagnosa' => 'nullable|string',
            'tindakan_operasi' => 'nullable|string',
            'dokter_op' => 'nullable|string',
            'dokter_anest' => 'nullable|string',
            'jenis_op' => 'nullable|string',
            'asuransi' => 'nullable|string',
            'rencana_tindakan' => 'nullable|date',
            'signin' => 'nullable|date',
            'time_out' => 'nullable|date',
            'sign_out' => 'nullable|date',
            'penandaan_lokasi_op' => 'nullable|string',
            'kelengkapan_ssc' => 'nullable|string',
            'penundaan_op_elektif' => 'nullable|string',
            'sc_emergensi1' => 'nullable|string',
            'penundaan_op_elektif1' => 'nullable|string',
            'sc_emergensi' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'kendala' => 'nullable|string',
        ]);

        try {
            // Simpan data ke tabel oks
            Oks::create([
                'tanggal' =>$request->tanggal,
                'no_rm' =>$request->no_rm,
                'nama_pasien' =>$request->nama_pasien,
                'umur' =>$request->umur,
                'diagnosa' =>$request->diagnosa,
                'tindakan_operasi' =>$request->tindakan_operasi,
                'dokter_op' =>$request->dokter_op,
                'dokter_anest' =>$request->dokter_anest,
                'jenis_op' =>$request->jenis_op,
                'asuransi' =>$request->asuransi,
                'rencana_tindakan' =>$request->rencana_tindakan,
                'signin' =>$request->signin,
                'time_out'=>$request->time_out,
                'sign_out' =>$request->sign_out,
                'penandaan_lokasi_op' =>$request->penandaan_lokasi_op,
                'kelengkapan_ssc' =>$request->kelengkapan_ssc,
                'penundaan_op_elektif' =>$request->penundaan_op_elektif,
                'penundaan_op_elektif1' =>$request->penundaan_op_elektif1,
                'sc_emergensi1' =>$request->sc_emergensi1,
                'sc_emergensi' =>$request->sc_emergensi,
                'keterangan' =>$request->keterangan,
                'kendala' =>$request->kendala,
            ]);


            // Redirect dengan pesan sukses
            return redirect()->route('oks.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('oks.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($ok)
    {
        $oks = Oks::where('tanggal', $ok)->get(); // Mengambil semua data pada tanggal tersebut
        if ($oks->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $tanggal = $ok;
        return view('oks.edit', compact('oks', 'tanggal'));
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
            'oks.*.tanggal' => 'date',
            'oks.*.no_rm' => 'nullable|string',
            'oks.*.nama_pasien' => 'nullable|string',
            'oks.*.umur' => 'nullable|integer',
            'oks.*.diagnosa' => 'nullable|string',
            'oks.*.tindakan_operasi' => 'nullable|string',
            'oks.*.dokter_op' => 'nullable|string',
            'oks.*.dokter_anest' => 'nullable|string',
            'oks.*.jenis_op' => 'nullable|string',
            'oks.*.asuransi' => 'nullable|string',
            'oks.*.rencana_tindakan' => 'nullable|date',
            'oks.*.signin' => 'nullable|date',
            'oks.*.time_out' => 'nullable|date',
            'oks.*.sign_out' => 'nullable|date',
            'oks.*.penandaan_lokasi_op' => 'nullable|string',
            'oks.*.kelengkapan_ssc' => 'nullable|string',
            'oks.*.penundaan_op_elektif' => 'nullable|string',
            'oks.*.penundaan_op_elektif1' => 'nullable|string',
            'oks.*.sc_emergensi1' => 'nullable|string',
            'oks.*.sc_emergensi' => 'nullable|string',
            'oks.*.keterangan' => 'nullable|string',
            'oks.*.kendala' => 'nullable|string',
        ]);

        try {
            foreach ($request->oks as $id => $data) {
                $oks = Oks::findOrFail($id);
                $oks->update($data);
            }

            return redirect()->route('oks.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('oks.index')->with(['error' => 'Data Gagal Diperbarui!']);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ok)
    {
        $oks = Oks::where('tanggal', $ok)->first();
        if (!$oks) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $oks->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }

    public function destroyId($id)
    {
        // Temukan data berdasarkan ID
        $record = Oks::findOrFail($id);

        // Hapus data tersebut
        $record->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }


    public function calendar(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->format('Y-m'));
        $tanggal = Carbon::parse($bulan)->startOfMonth();
        $akhirBulan = Carbon::parse($bulan)->endOfMonth();

        return view('oks.index', compact('tanggal', 'akhirBulan', 'bulan'));
    }

    public function show($ok)
    {
        $oks = Oks::where('tanggal', $ok)->first();
        if (!$oks) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $tanggal = collect(explode(',', $oks->tanggal))->map(function($tanggal) {
            return \Carbon\Carbon::parse($tanggal);
        });

        return view('oks.review', compact('oks', 'tanggal'));
    }

    public function reviewByDate($date)
    {
        $oks = Oks::where('tanggal', $date)->get();

        if ($oks->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($oks);
    }

    public function showBulanan($ok)
    {
        $oks = Oks::where('tanggal', $ok)->first();
        if (!$oks) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $tanggal = collect(explode(',', $oks->tanggal))->map(function($bulan) {
            return \Carbon\Carbon::parse($bulan);
        });

        return view('oks.review_bulanan_ok', compact('oks', 'bulan'));
    }
    public function reviewBulananOk(Request $request)
    {
        $bulan = $request->input('bulan');
        if ($bulan) {
            $oks = Oks::whereMonth('tanggal', date('m', strtotime($bulan)))->get();
        } else {
            $oks = Oks::get();
        }
        return view('oks.review_bulanan_ok', compact('oks', 'bulan'));
    }
    
    public function reviewBulananOk1(Request $request)
    {
        $bulan = $request->input('bulan');
        if ($bulan) {
            $oks = Oks::whereMonth('tanggal', date('m', strtotime($bulan)))->get();
        } else {
            $oks = Oks::get();
        }
        return view('oks.review_bulanan_ok_imprs', compact('oks', 'bulan'));
    }
    
    public function reviewBulananOk2(Request $request)
    {
        $bulan = $request->input('bulan');
        if ($bulan) {
            $oks = Oks::whereMonth('tanggal', date('m', strtotime($bulan)))->get();
        } else {
            $oks = Oks::get();
        }
        return view('oks.review_bulanan_ok_unit', compact('oks', 'bulan'));
    }
    
    public function reviewTahunanScEmergensi(Request $request)
    {
        // Default tahun sekarang
        $tahun = $request->input('tahun', date('Y'));

        //ambil data berdasarkan tahun
        $okData = Oks::whereYear('tanggal', $tahun)->get();

        // Data SC Emergensi dari database berdasarkan tahun
        $dataPerbulan = array_fill(1,12, ['lebih' => 0, 'kurang' => 0]);

        foreach ($okData as $ok){
            $bulan = (int)date('m', strtotime($ok->tanggal));
            $dataPerbulan[$bulan]['kurang'] += ($ok->sc_emergensi1 === '✔️' ? 1 : 0);
            $dataPerbulan[$bulan]['lebih'] += ($ok->sc_emergensi === '✔️' ? 1 : 0);
        }

        $totalBerkas = array_map(function($data){
            return $data['kurang'] + $data['lebih'];
        },$dataPerbulan);

        $capaian = [];
        foreach ($dataPerbulan as $bulan => $data){
            if($data['kurang'] + $data['lebih'] > 0){
                $capaian[$bulan] = ($data['kurang']/ ($data['kurang'] + $data['lebih'])) * 100;
            }else{
                $capaian[$bulan] =0;
            }
        }

        $chartData = [
            'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'capaian' => array_values($capaian),
            'target' => array_fill(0, 12, 80),
            'total' => array_values($totalBerkas),
            'kurang' => array_column($dataPerbulan, 'kurang'),
            'lebih' => array_column($dataPerbulan, 'lebih'),
        ];

        return view('oks.grafik_sc', compact('bulan', 'chartData', 'tahun'));
    }

    public function reviewTahunanOpElektif(Request $request)
    {
        // Default tahun sekarang
        $tahun = $request->input('tahun', date('Y'));

        //ambil data berdasarkan tahun
        $okData = Oks::whereYear('tanggal', $tahun)->get();

        // Data SC Emergensi dari database berdasarkan tahun
        $dataPerbulan = array_fill(1,12, ['lebihdari' => 0, 'kurangdari' => 0]);

        foreach ($okData as $ok){
            $bulan = (int)date('m', strtotime($ok->tanggal));
            $dataPerbulan[$bulan]['lebihdari'] += ($ok->penundaan_op_elektif === '✔️' ? 1 : 0);
            $dataPerbulan[$bulan]['kurangdari'] += ($ok->penundaan_op_elektif1 === '✔️' ? 1 : 0);
        }

        $totalBerkas = array_map(function($data){
            return $data['lebihdari'] + $data['kurangdari'];
        },$dataPerbulan);

        $capaian = [];
        foreach ($dataPerbulan as $bulan => $data){
            if($data['lebihdari'] + $data['kurangdari'] > 0){
                $capaian[$bulan] = ($data['lebihdari']/ ($data['lebihdari'] + $data['kurangdari'])) * 100;
            }else{
                $capaian[$bulan] =0;
            }
        }

        $chartData = [
            'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'capaian' => array_values($capaian),
            'target' => array_fill(0, 12, 5),
            'total' => array_values($totalBerkas),
            'lebihdari' => array_column($dataPerbulan, 'lebihdari'),
            'kurangdari' => array_column($dataPerbulan, 'kurangdari'),
        ];           // Penundaan OP Elektif >= 2 Jam

        return view('oks.grafik_op', compact('bulan', 'chartData', 'tahun'));
    }
    
    public function reviewTahunanSsc(Request $request)
    {
        // Default tahun sekarang
        $tahun = $request->input('tahun', date('Y'));

        //ambil data berdasarkan tahun
        $okData = Oks::whereYear('tanggal', $tahun)->get();

        // Data SC Emergensi dari database berdasarkan tahun
        $dataPerbulan = array_fill(1,12, ['TIDAK' => 0, 'YA' => 0]);

        foreach ($okData as $ok){
            $bulan = (int)date('m', strtotime($ok->tanggal));
            $dataPerbulan[$bulan]['YA'] += ($ok->kelengkapan_ssc === '✔️' ? 1 : 0);
            $dataPerbulan[$bulan]['TIDAK'] += ($ok->kelengkapan_ssc === '❌' ? 1 : 0);
        }

        $totalBerkas = array_map(function($data){
            return $data['YA'] + $data['TIDAK'];
        },$dataPerbulan);

        $capaian = [];
        foreach ($dataPerbulan as $bulan => $data){
            if($data['YA'] + $data['TIDAK'] > 0){
                $capaian[$bulan] = ($data['YA']/ ($data['YA'] + $data['TIDAK'])) * 100;
            }else{
                $capaian[$bulan] =0;
            }
        }

        $chartData = [
            'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'capaian' => array_values($capaian),
            'target' => array_fill(0, 12, 80),
            'total' => array_values($totalBerkas),
            'YA' => array_column($dataPerbulan, 'YA'),
            'TIDAK' => array_column($dataPerbulan, 'TIDAK'),
        ];

        return view('oks.grafik_ssc', compact('bulan', 'chartData', 'tahun'));
    }

    public function exportBulanan(Request $request)
    {
        $bulan = $request->input('bulan');
        if (!$bulan) {
            return redirect()->back()->with(['error' => 'Bulan tidak boleh kosong']);
        }

        return Excel::download(new OksExport($bulan), 'review_bulanan_ok.xlsx');
    }

    public function checkData($date)
    {
        $hasData = Oks::whereDate('tanggal', $date)->exists();

        return response()->json(['hasData' => $hasData]);
    }





}
