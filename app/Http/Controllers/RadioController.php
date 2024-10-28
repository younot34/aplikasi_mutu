<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Radio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exports\RadioExport;
use Maatwebsite\Excel\Facades\Excel;


class RadioController extends Controller
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
           $radios = Radio::latest()->when(request()->q, function($radios) {
               $radios = $radios->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $radios = Radio::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $radios = Radio::latest()->when(request()->q, function($radios) {
               $radios = $radios->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $radios = Radio::latest()->when(request()->q, function($radios) {
               $radios = $radios->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $radios = Radio::latest()->when(request()->q, function($radios) {
               $radios = $radios->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $radios = Radio::latest()->when(request()->q, function($radios) {
               $radios = $radios->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $radios = Radio::latest()->when(request()->q, function($radios) {
               $radios = $radios->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $radios = Radio::latest()->when(request()->q, function($radios) {
               $radios = $radios->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $radios = Radio::latest()->when(request()->q, function($radios) {
               $radios = $radios->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $radios = Radio::latest()->when(request()->q, function($radios) {
               $radios = $radios->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();
        $bulan = $request->input('bulan', date('Y-m'));
        $tanggal = Carbon::parse($bulan . '-01');
        $akhirBulan = $tanggal->copy()->endOfMonth();

       return view('radios.index', compact('radios','user','bulan', 'tanggal', 'akhirBulan'));
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
        return view('radios.create', compact('tanggal'));
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
            'no_ro' => 'required|string',
            'nama_pasien' => 'required|string',
            'no_rm' => 'required|string',
            'ruangan' => 'required|string',
            'umur' => 'required|integer',
            'jenis_pembayaran' => 'nullable|string',
            'dokter_pengirim' => 'nullable|string',
            'jenis_pemeriksaan' => 'nullable|string',
            'petugas' => 'nullable|string',
            'kvmas' => 'required|string',
            'mulai' => 'required|date_format:H:i',
            'selesai' => 'required|date_format:H:i',
            'tarif' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        try {
            // Simpan data ke tabel radios
            Radio::create([
                'tanggal' => $request->tanggal,
                'no_ro' => $request->no_ro,
                'nama_pasien' => $request->nama_pasien,
                'no_rm' => $request->no_rm,
                'ruangan' => $request->ruangan,
                'umur' => $request->umur,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'dokter_pengirim' => $request->dokter_pengirim,
                'jenis_pemeriksaan' => $request->jenis_pemeriksaan,
                'petugas' => $request->petugas,
                'kvmas' => $request->kvmas,
                'mulai' => $request->mulai,
                'selesai' => $request->selesai,
                'tarif' => $request->tarif,
                'keterangan' => $request->keterangan,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('radios.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('radios.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($radio)
    {
        $radios = Radio::where('tanggal', $radio)->get(); // Mengambil semua data pada tanggal tersebut
        if ($radios->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $tanggal = $radio;
        return view('radios.edit', compact('radios', 'tanggal'));
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
            'radios.*.tanggal' => 'nullable|date',
            'radios.*.no_ro' => 'required|string',
            'radios.*.nama_pasien' => 'required|string',
            'radios.*.no_rm' => 'required|string',
            'radios.*.ruangan' => 'required|string',
            'radios.*.umur' => 'required|integer',
            'radios.*.jenis_pembayaran' => 'nullable|string',
            'radios.*.dokter_pengirim' => 'nullable|string',
            'radios.*.jenis_pemeriksaan' => 'nullable|string',
            'radios.*.petugas' => 'nullable|string',
            'radios.*.kvmas' => 'required|string',
            'radios.*.mulai' => 'required|date_format:H:i',
            'radios.*.selesai' => 'required|date_format:H:i',
            'radios.*.tarif' => 'required|string',
            'radios.*.keterangan' => 'nullable|string',
        ]);

        try {
            foreach ($request->radios as $id => $data) {
                $radio = Radio::findOrFail($id);
                $radio->update($data);
            }

            return redirect()->route('radios.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('radios.index')->with(['error' => 'Data Gagal Diperbarui!']);
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($radio)
    {
        $radios = Radio::where('tanggal', $radio)->first();
        if (!$radios) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $radios->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }

    public function destroyId($id)
    {
        // Temukan data berdasarkan ID
        $record = Radio::findOrFail($id);

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

        return view('radios.index', compact('tanggal', 'akhirBulan', 'bulan'));
    }

    public function show($radio)
    {
        $radios = Radio::where('tanggal', $radio)->first();
        if (!$radios) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $tanggal = collect(explode(',', $radios->tanggal))->map(function($tanggal) {
            return \Carbon\Carbon::parse($tanggal);
        });

        return view('radios.review', compact('radio', 'tanggal'));
    }

    public function reviewRadioByDate($date)
    {
        $radios = Radio::where('tanggal', $date)->get();

        if ($radios->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($radios);
    }

    public function showBulanan($radio)
    {
        $radios = Radio::where('tanggal', $radio)->first();
        if (!$radios) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $tanggal = collect(explode(',', $radios->tanggal))->map(function($bulan) {
            return \Carbon\Carbon::parse($bulan);
        });

        return view('radios.review_bulanan_radio', compact('radios', 'bulan'));
    }
    public function reviewBulananRadio(Request $request)
    {
        $bulan = $request->input('bulan');
        if ($bulan) {
            $radios = Radio::whereMonth('tanggal', date('m', strtotime($bulan)))->paginate(10);
        } else {
            $radios = Radio::paginate(10);
        }
        return view('radios.review_bulanan_radio', compact('radios', 'bulan'));
    }

    public function exportBulanan(Request $request)
    {
        $bulan = $request->input('bulan');
        if (!$bulan) {
            return redirect()->back()->with(['error' => 'Bulan tidak boleh kosong']);
        }

        return Excel::download(new RadioExport($bulan), 'review_bulanan_radio.xlsx');
    }

    public function checkData($date)
    {
        $hasData = Radio::whereDate('tanggal', $date)->exists();

        return response()->json(['hasData' => $hasData]);
    }





}
