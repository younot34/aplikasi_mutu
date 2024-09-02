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
            'no_rm' => 'required|string',
            'nama_pasien' => 'required|string',
            'umur' => 'required|integer',
            'diagnosa' => 'required|string',
            'tindakan_operasi' => 'required|string',
            'dokter_op' => 'required|string',
            'dokter_anest' => 'required|string',
            'jenis_op' => 'required|string',
            'asuransi' => 'required|string',
            'rencana_tindakan' => 'required|date',
            'signin' => 'required|date',
            'time_out' => 'required|date',
            'sign_out' => 'required|date',
            'penandaan_lokasi_op' => 'required|string',
            'kelengkapan_ssc' => 'required|string',
            'penundaan_op_elektif' => 'required|string',
            'sc_emergensi' => 'required|string',
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
            'oks.*.no_rm' => 'required|string',
            'oks.*.nama_pasien' => 'required|string',
            'oks.*.umur' => 'required|integer',
            'oks.*.diagnosa' => 'required|string',
            'oks.*.tindakan_operasi' => 'required|string',
            'oks.*.dokter_op' => 'required|string',
            'oks.*.dokter_anest' => 'required|string',
            'oks.*.jenis_op' => 'required|string',
            'oks.*.asuransi' => 'required|string',
            'oks.*.rencana_tindakan' => 'required|date',
            'oks.*.signin' => 'required|date',
            'oks.*.time_out' => 'required|date',
            'oks.*.sign_out' => 'required|date',
            'oks.*.penandaan_lokasi_op' => 'required|string',
            'oks.*.kelengkapan_ssc' => 'required|string',
            'oks.*.penundaan_op_elektif' => 'required|string',
            'oks.*.sc_emergensi' => 'required|string',
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
            $oks = Oks::whereMonth('tanggal', date('m', strtotime($bulan)))->paginate(10);
        } else {
            $oks = Oks::paginate(10);
        }
        return view('oks.review_bulanan_ok', compact('oks', 'bulan'));
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
