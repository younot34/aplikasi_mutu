<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Exports\RmriExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Rmri;

class RmriController extends Controller
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
           $rmri = Rmri::latest()->when(request()->q, function($rmri) {
               $rmri = $rmri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $rmri = Rmri::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $rmri = Rmri::latest()->when(request()->q, function($rmri) {
               $rmri = $rmri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $rmri = Rmri::latest()->when(request()->q, function($rmri) {
               $rmri = $rmri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $rmri = Rmri::latest()->when(request()->q, function($rmri) {
               $rmri = $rmri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $rmri = Rmri::latest()->when(request()->q, function($rmri) {
               $rmri = $rmri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $rmri = Rmri::latest()->when(request()->q, function($rmri) {
               $rmri = $rmri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $rmri = Rmri::latest()->when(request()->q, function($rmri) {
               $rmri = $rmri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $rmri = Rmri::latest()->when(request()->q, function($rmri) {
               $rmri = $rmri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas8')){
           $rmri = Rmri::latest()->when(request()->q, function($rmri) {
               $rmri = $rmri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas9')){
           $rmri = Rmri::latest()->when(request()->q, function($rmri) {
               $rmri = $rmri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $rmri = Rmri::latest()->when(request()->q, function($rmri) {
               $rmri = $rmri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();
        $bulan = $request->input('bulan', date('Y-m'));
        $tanggal = Carbon::parse($bulan . '-01');
        $akhirBulan = $tanggal->copy()->endOfMonth();

       return view('rmris.index', compact('rmri','user','bulan', 'tanggal', 'akhirBulan'));
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
        return view('rmris.create', compact('tanggal'));
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
            'resume_ada' => 'nullable|string',
            'resume_tidakAda' => 'nullable|string',
            'resume_lengkap' => 'nullable|string',
            'resume_tidak' => 'nullable|string',
            'pengantar_ada' => 'nullable|string',
            'pengantar_tidakAda' => 'nullable|string',
            'pengantar_lengkap' => 'nullable|string',
            'pengantar_tidak' => 'nullable|string',
            'cppt_ada' => 'nullable|string',
            'cppt_tidakAda' => 'nullable|string',
            'cppt_lengkap' => 'nullable|string',
            'cppt_tidak' => 'nullable|string',
            'general_ada' => 'nullable|string',
            'general_tidakAda' => 'nullable|string',
            'general_lengkap' => 'nullable|string',
            'general_tidak' => 'nullable|string',
            'informed_ada' => 'nullable|string',
            'informed_tidakAda' => 'nullable|string',
            'informed_lengkap' => 'nullable|string',
            'informed_tidak' => 'nullable|string',
            'keterangan_lengkap' => 'nullable|string',
        ]);

        try {
            // Simpan data ke tabel
            Rmri::create($request->all());


            // Redirect dengan pesan sukses
            return redirect()->route('rmris.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('rmris.index')->with(['error' => 'Data Gagal Disimpan! Error: ' . $e->getMessage()]);
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
    public function edit($rmris)
    {
        $rmri = Rmri::where('tanggal', $rmris)->get(); // Mengambil semua data pada tanggal tersebut
        if ($rmri->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $tanggal = $rmris;
        return view('rmris.edit', compact('rmri', 'tanggal'));
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
            'rmris.*.tanggal' => 'nullable|date',
            'rmris.*.no_rm' => 'nullable|string',
            'rmris.*.resume_ada' => 'nullable|string',
            'rmris.*.resume_tidakAda' => 'nullable|string',
            'rmris.*.resume_lengkap' => 'nullable|string',
            'rmris.*.resume_tidak' => 'nullable|string',
            'rmris.*.pengantar_ada' => 'nullable|string',
            'rmris.*.pengantar_tidakAda' => 'nullable|string',
            'rmris.*.pengantar_lengkap' => 'nullable|string',
            'rmris.*.pengantar_tidak' => 'nullable|string',
            'rmris.*.cppt_ada' => 'nullable|string',
            'rmris.*.cppt_tidakAda' => 'nullable|string',
            'rmris.*.cppt_lengkap' => 'nullable|string',
            'rmris.*.cppt_tidak' => 'nullable|string',
            'rmris.*.general_ada' => 'nullable|string',
            'rmris.*.general_tidakAda' => 'nullable|string',
            'rmris.*.general_lengkap' => 'nullable|string',
            'rmris.*.general_tidak' => 'nullable|string',
            'rmris.*.informed_ada' => 'nullable|string',
            'rmris.*.informed_tidakAda' => 'nullable|string',
            'rmris.*.informed_lengkap' => 'nullable|string',
            'rmris.*.informed_tidak' => 'nullable|string',
            'rmris.*.keterangan_lengkap' => 'nullable|string',
        ]);

        try {
            foreach ($request->rmris as $id => $data) {
                $rmri = Rmri::findOrFail($id);
                $rmri->update($data);
            }

            return redirect()->route('rmris.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('rmris.index')->with(['error' => 'Data Gagal Diperbarui!']);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rmris)
    {
        $rmri = Rmri::where('tanggal', $rmris)->first();
        if (!$rmri) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $rmri->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }

    public function destroyId($id)
    {
        // Temukan data berdasarkan ID
        $record = Rmri::findOrFail($id);

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

        return view('rmris.index', compact('tanggal', 'akhirBulan', 'bulan'));
    }

    public function show($rmris)
    {
        $rmri = Rmri::where('tanggal', $rmris)->first();
        if (!$rmri) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $tanggal = collect(explode(',', $rmri->tanggal))->map(function($tanggal) {
            return \Carbon\Carbon::parse($tanggal);
        });

        return view('rmris.review', compact('rmri', 'tanggal'));
    }

    public function reviewRmiByDate($date)
    {
        $rmri = Rmri::where('tanggal', $date)->get();

        if ($rmri->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($rmri);
    }
    public function reviewBulananRmi(Request $request)
    {
        $bulan = $request->input('bulan', date('Y-m')); // default to current month
        $tanggalData = Rmri::whereYear('tanggal', date('Y', strtotime($bulan)))
            ->whereMonth('tanggal', date('m', strtotime($bulan)))
            ->get();

        // Siapkan array untuk menyimpan data berdasarkan tanggal
        $reportData = [];

        // Kumpulkan data berdasarkan tanggal
        foreach ($tanggalData as $item) {
            $reportData[$item->tanggal][] = $item; // Group by date
        }

        // Kirimkan variabel ke tampilan
        return view('rmris.review_bulanan_rmi', compact('reportData', 'bulan'));
    }

    public function exportBulanan(Request $request)
    {
        $bulan = $request->input('bulan');
        if (!$bulan) {
            return redirect()->back()->with(['error' => 'Bulan tidak boleh kosong']);
        }

        return Excel::download(new RmriExport($bulan), 'review_bulanan_rmi.xlsx');
    }

    public function checkData($date)
    {
        $hasData = Rmri::whereDate('tanggal', $date)->exists();

        return response()->json(['hasData' => $hasData]);
    }

    public function reviewTahunan(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));

        // Ambil data RM RI (rmri) berdasarkan tahun yang dipilih
        $rmriData = Rmri::whereYear('tanggal', $tahun)->get();

        // Data per bulan
        $dataPerBulan = array_fill(1, 12, ['lengkap' => 0, 'tidak' => 0]);

        foreach ($rmriData as $rmri) {
            $bulan = (int)date('m', strtotime($rmri->tanggal));
            $dataPerBulan[$bulan]['lengkap'] += ($rmri->keterangan_lengkap === '✔️' ? 1 : 0);
            $dataPerBulan[$bulan]['tidak'] += ($rmri->keterangan_lengkap === '❌' ? 1 : 0);
        }

        // Hitung total berkas per bulan
        $totalBerkas = array_map(function($data) {
            return $data['lengkap'] + $data['tidak'];
        }, $dataPerBulan);

        // Hitung persentase kelengkapan tiap bulan
        $capaian = [];
        foreach ($dataPerBulan as $bulan => $data) {
            if ($data['lengkap'] + $data['tidak'] > 0) {
                $capaian[$bulan] = ($data['lengkap'] / ($data['lengkap'] + $data['tidak'])) * 100;
            } else {
                $capaian[$bulan] = 0;
            }
        }

        // Data untuk Chart.js
        $chartData = [
            'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'capaian' => array_values($capaian),
            'target' => array_fill(0, 12, 85), // Target 100% kelengkapan
            'total' => array_values($totalBerkas), // Total berkas per bulan
            'lengkap' => array_column($dataPerBulan, 'lengkap'), // Jumlah lengkap per bulan
            'tidak' => array_column($dataPerBulan, 'tidak'), // Jumlah tidak lengkap per bulan
        ];

        return view('rmris.grafik_rmri', compact('chartData', 'tahun'));
    }
}
