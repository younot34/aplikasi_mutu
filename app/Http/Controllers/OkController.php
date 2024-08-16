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
               $oks = $oks->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $oks = Oks::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $oks = Oks::latest()->when(request()->q, function($oks) {
               $oks = $oks->where('waktu', 'like', '%'. request()->q . '%');
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
            'nama_pasien' => 'required|string',
            'no_rm' => 'required|integer',
            'diagnosa' => 'required|string',
            'nama_dokter' => 'required|string',
            'tanggal' => 'date',
            'waktu_masuk' => 'required|date',
            'waktu_pelaksanaan' => 'required|date',
            'waktu_pending' => 'nullable|string',
            'alasan' => 'nullable|string',
        ]);

        try {
            // Simpan data ke tabel oks
            Oks::create([
                'tanggal' => $request->tanggal,
                'waktu_masuk' => $request->waktu_masuk,
                'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
                'waktu_pending' => $request->waktu_pending,
                'alasan' => $request->alasan,
                'no_rm' => $request->no_rm,
                'nama_pasien' => $request->nama_pasien,
                'diagnosa' => $request->diagnosa,
                'nama_dokter' => $request->nama_dokter,
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
        $oks = Oks::where('tanggal', $ok)->firstOrFail();
        if (!$oks) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $tanggal = $oks->tanggal;
        return view('oks.edit', compact('oks','tanggal'));
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
            'nama_pasien' => 'required|string',
            'no_rm' => 'required|integer',
            'diagnosa' => 'required|string',
            'nama_dokter' => 'required|string',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'required|date',
            'waktu_pelaksanaan' => 'required|date',
            'waktu_pending' => 'nullable|date',
            'alasan' => 'nullable|string',
        ]);
        try {

            $oks = Oks::findOrFail($id);
            $oks->update([
                'tanggal' => $request->tanggal,
                'waktu_masuk' => $request->waktu_masuk,
                'waktu_pelaksanaan' => $request->waktu_pelaksanaan,
                'waktu_pending' => $request->waktu_pending,
                'alasan' => $request->alasan,
                'no_rm' => $request->no_rm,
                'nama_pasien' => $request->nama_pasien,
                'nama_dokter' => $request->nama_dokter,
                'diagnosa' => $request->diagnosa,
            ]);

            // Hapus data relasi yang ada
            // $oks->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('oks.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } catch (\Exception $e) {
            DB::rollBack();
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
        Log::info('Tanggal yang diterima: ' . $date);
        $oks = Oks::where('tanggal', $date)->get();
        Log::info('Data yang ditemukan: ' . $oks->toJson());

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






}
