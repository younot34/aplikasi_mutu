<?php

namespace App\Http\Controllers;

use App\Models\Pdarah;
use App\Models\Pobat;
use App\Models\Psample;
use App\Models\Ptindakan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ri;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;

class RiController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:ris.index|ris.create|ris.edit|ris.delete']);
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
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $ri = Ri::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $ri = Ri::latest()->when(request()->q, function($ri) {
               $ri = $ri->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('ris.index', compact('ri','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('ris.create');
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
        $request->validate([
            'tanggal' => 'required|date',
            'sift' => 'required|string',
            'no_rm' => 'required|string',
            'nama_px' => 'required|string',
            'alamat' => 'required|string',
            'benar_namao' => 'required|array',
            'benar_alamato' => 'required|array',
            'benar_namad' => 'required|array',
            'benar_alamatd' => 'required|array',
            'benar_namas' => 'required|array',
            'benar_alamats' => 'required|array',
            'benar_namat' => 'required|array',
            'benar_alamatt' => 'required|array',
        ]);

        try {
            // Simpan data ke tabel ris
            $ri = Ri::create([
                'tanggal' => $request->tanggal,
                'sift' => $request->sift,
                'no_rm' => $request->no_rm,
                'nama_px' => $request->nama_px,
                'alamat' => $request->alamat,
            ]);

            // Loop melalui input array dan simpan ke tabel pobats
            foreach ($request->benar_namao as $index => $benar_namao) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namao' => $benar_namao,
                    'benar_alamato' => $request->benar_alamato[$index],
                ];

                // Simpan data ke tabel obats
                Pobat::create($data);
            }
            // Loop melalui input array dan simpan ke tabel pdarahs
            foreach ($request->benar_namad as $index => $benar_namad) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namad' => $benar_namad,
                    'benar_alamatd' => $request->benar_alamatd[$index],
                ];

                // Simpan data ke tabel obats
                Pdarah::create($data);
            }
            // Loop melalui input array dan simpan ke tabel psamples
            foreach ($request->benar_namas as $index => $benar_namas) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namas' => $benar_namas,
                    'benar_alamats' => $request->benar_alamats[$index],
                ];

                // Simpan data ke tabel obats
                Psample::create($data);
            }
            // Loop melalui input array dan simpan ke tabel ptindakans
            foreach ($request->benar_namat as $index => $benar_namat) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namat' => $benar_namat,
                    'benar_alamatt' => $request->benar_alamatt[$index],
                ];

                // Simpan data ke tabel obats
                Ptindakan::create($data);
            }

            // Redirect dengan pesan sukses
            return redirect()->route('ris.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('ris.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $ri = Ri::with('pobats','pdarahs','psamples','ptindakans')->findOrFail($id);
        return view('ris.edit', compact('ri'));
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
            'tanggal' => 'required|date',
            'sift' => 'required|string',
            'no_rm' => 'required|string',
            'nama_px' => 'required|string',
            'alamat' => 'required|string',
            'benar_namao' => 'required|array',
            'benar_alamato' => 'required|array',
            'benar_namad' => 'required|array',
            'benar_alamatd' => 'required|array',
            'benar_namas' => 'required|array',
            'benar_alamats' => 'required|array',
            'benar_namat' => 'required|array',
            'benar_alamatt' => 'required|array',
        ]);
        try {
            // Simpan data ke tabel ris
            $ri = Ri::findOrFail($id);
            $ri->update([
                'tanggal' => $request->tanggal,
                'sift' => $request->sift,
                'no_rm' => $request->no_rm,
                'nama_px' => $request->nama_px,
                'alamat' => $request->alamat,
            ]);

            $ri->pobats()->delete();
            $ri->pdarahs()->delete();
            $ri->psamples()->delete();
            $ri->ptindakans()->delete();
            // Loop melalui input array dan simpan ke tabel pobats
            foreach ($request->benar_namao as $index => $benar_namao) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namao' => $benar_namao,
                    'benar_alamato' => $request->benar_alamato[$index],
                ];

                // Simpan data ke tabel obats
                Pobat::create($data);
            }
            // Loop melalui input array dan simpan ke tabel pdarahs
            foreach ($request->benar_namad as $index => $benar_namad) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namad' => $benar_namad,
                    'benar_alamatd' => $request->benar_alamatd[$index],
                ];

                // Simpan data ke tabel obats
                Pdarah::create($data);
            }
            // Loop melalui input array dan simpan ke tabel psamples
            foreach ($request->benar_namas as $index => $benar_namas) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namas' => $benar_namas,
                    'benar_alamats' => $request->benar_alamats[$index],
                ];

                // Simpan data ke tabel obats
                Psample::create($data);
            }
            // Loop melalui input array dan simpan ke tabel ptindakans
            foreach ($request->benar_namat as $index => $benar_namat) {
                $data = [
                    'ri_id' => $ri->id,
                    'benar_namat' => $benar_namat,
                    'benar_alamatt' => $request->benar_alamatt[$index],
                ];

                // Simpan data ke tabel obats
                Ptindakan::create($data);
            }

            // Redirect dengan pesan sukses
            return redirect()->route('ris.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('ris.index')->with(['success' => 'Data Berhasil Diubah!']);
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
        $ri = Ri::findOrFail($id);
        $ri->delete();

        if($ri){
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
            $ri = Ri::whereMonth('tanggal', date('m', strtotime($bulan)))->with(['pobats','pdarahs','psamples','ptindakans'])->paginate(10);
        } else {
            $ri = Ri::with(['pobats','pdarahs','psamples','ptindakans'])->paginate(10);
        }
        return view('ris.export_ri', compact('ri', 'bulan'));
    }
}
