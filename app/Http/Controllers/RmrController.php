<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rmr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\RmrExport;
use Maatwebsite\Excel\Facades\Excel;

class RmrController extends Controller
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
           $rmr = Rmr::latest()->when(request()->q, function($rmr) {
               $rmr = $rmr->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $rmr = Rmr::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $rmr = Rmr::latest()->when(request()->q, function($rmr) {
               $rmr = $rmr->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $rmr = Rmr::latest()->when(request()->q, function($rmr) {
               $rmr = $rmr->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $rmr = Rmr::latest()->when(request()->q, function($rmr) {
               $rmr = $rmr->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $rmr = Rmr::latest()->when(request()->q, function($rmr) {
               $rmr = $rmr->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $rmr = Rmr::latest()->when(request()->q, function($rmr) {
               $rmr = $rmr->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $rmr = Rmr::latest()->when(request()->q, function($rmr) {
               $rmr = $rmr->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $rmr = Rmr::latest()->when(request()->q, function($rmr) {
               $rmr = $rmr->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $rmr = Rmr::latest()->when(request()->q, function($rmr) {
               $rmr = $rmr->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();
        $bulan = $request->input('bulan', date('Y-m'));
        $tanggal = Carbon::parse($bulan . '-01');
        $akhirBulan = $tanggal->copy()->endOfMonth();

       return view('rmrs.index', compact('rmr','user','bulan', 'tanggal', 'akhirBulan'));
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
        return view('rmrs.create', compact('tanggal'));
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
            'no' => 'nullable|integer',
            'no_rm' => 'nullable|string',
            'asesmen' => 'nullable|string',
            'cppt' => 'nullable|string',
            'resep' => 'nullable|string',
            'resume' => 'nullable|string',
            'lengkap' => 'nullable|string',
            'tidak' => 'nullable|string',
        ]);

        try {
            // Simpan data ke tabel
            Rmr::create([
                'tanggal' =>$request->tanggal,
                'no' =>$request->no,
                'no_rm' =>$request->no_rm,
                'asesmen' =>$request->asesmen,
                'cppt' =>$request->cppt,
                'resep' =>$request->resep,
                'resume' =>$request->resume,
                'lengkap' =>$request->lengkap,
                'tidak' =>$request->tidak,
            ]);


            // Redirect dengan pesan sukses
            return redirect()->route('rmrs.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('rmrs.index')->with(['error' => 'Data Gagal Disimpan! Error: ' . $e->getMessage()]);
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
    public function edit($rmrs)
    {
        $rmr = Rmr::where('tanggal', $rmrs)->get(); // Mengambil semua data pada tanggal tersebut
        if ($rmr->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $tanggal = $rmrs;
        return view('rmrs.edit', compact('rmr', 'tanggal'));
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
            'rmrs.*.tanggal' => 'nullable|date',
            'rmrs.*.no' => 'nullable|integer',
            'rmrs.*.no_rm' => 'nullable|string',
            'rmrs.*.asesmen' => 'nullable|string',
            'rmrs.*.cppt' => 'nullable|string',
            'rmrs.*.resep' => 'nullable|string',
            'rmrs.*.resume' => 'nullable|string',
            'rmrs.*.lengkap' => 'nullable|string',
            'rmrs.*.tidak' => 'nullable|string',
        ]);

        try {
            foreach ($request->rmrs as $id => $data) {
                $rmr = Rmr::findOrFail($id);
                $rmr->update($data);
            }

            return redirect()->route('rmrs.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('rmrs.index')->with(['error' => 'Data Gagal Diperbarui!']);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rmrs)
    {
        $rmr = Rmr::where('tanggal', $rmrs)->first();
        if (!$rmr) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $rmr->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }


    public function calendar(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->format('Y-m'));
        $tanggal = Carbon::parse($bulan)->startOfMonth();
        $akhirBulan = Carbon::parse($bulan)->endOfMonth();

        return view('rmrs.index', compact('tanggal', 'akhirBulan', 'bulan'));
    }

    public function show($rmrs)
    {
        $rmr = Rmr::where('tanggal', $rmrs)->first();
        if (!$rmr) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $tanggal = collect(explode(',', $rmr->tanggal))->map(function($tanggal) {
            return \Carbon\Carbon::parse($tanggal);
        });

        return view('rmrs.review', compact('rmr', 'tanggal'));
    }

    public function reviewRmByDate($date)
    {
        $rmr = Rmr::where('tanggal', $date)->get();

        if ($rmr->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($rmr);
    }
    public function reviewBulananRm(Request $request)
    {
        $bulan = $request->input('bulan');
        if ($bulan) {
            $rmr = Rmr::whereMonth('tanggal', date('m', strtotime($bulan)))
                       ->orderBy('tanggal', 'asc')  // Mengurutkan berdasarkan tanggal
                       ->paginate(10);
        } else {
            $rmr = Rmr::orderBy('tanggal', 'asc')  // Mengurutkan berdasarkan tanggal
                       ->paginate(10);
        }
        return view('rmrs.review_bulanan_rm', compact('rmr', 'bulan'));
    }

    public function exportBulanan(Request $request)
    {
        $bulan = $request->input('bulan');
        if (!$bulan) {
            return redirect()->back()->with(['error' => 'Bulan tidak boleh kosong']);
        }

        return Excel::download(new RmrExport($bulan), 'review_bulanan_rm.xlsx');
    }

    public function checkData($date)
    {
        $hasData = Rmr::whereDate('tanggal', $date)->exists();

        return response()->json(['hasData' => $hasData]);
    }
}