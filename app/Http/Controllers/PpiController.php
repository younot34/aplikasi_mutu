<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ppi;
use App\Models\Profesi;
use App\Models\Indikasi;
use Illuminate\Database\Eloquent\Builder;

class PpiController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:ppis.index|ppis.create|ppis.edit|ppis.delete']);
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
           $ppis = Ppi::latest()->when(request()->q, function($ppis) {
               $ppis = $ppis->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $ppis = Ppi::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
            $ppis = Ppi::latest()->when(request()->q, function($ppis) {
               $ppis = $ppis->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $ppis = Ppi::latest()->when(request()->q, function($ppis) {
               $ppis = $ppis->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $ppis = Ppi::latest()->when(request()->q, function($ppis) {
               $ppis = $ppis->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $ppis = Ppi::latest()->when(request()->q, function($ppis) {
               $ppis = $ppis->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $ppis = Ppi::latest()->when(request()->q, function($ppis) {
               $ppis = $ppis->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $ppis = Ppi::latest()->when(request()->q, function($ppis) {
               $ppis = $ppis->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $ppis = Ppi::latest()->when(request()->q, function($ppis) {
               $ppis = $ppis->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $ppis = Ppi::latest()->when(request()->q, function($ppis) {
               $ppis = $ppis->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('ppis.index', compact('ppis','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        //
        return view('ppis.create');
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
            'unit' => 'required',
            'tanggal' => 'required|date',
            'observer' => 'required',
            'profesi' => 'array',
            'jumlah' => 'array',
            'opp' => 'array',
            'indikasi' => 'array',
            'cuci_tangan' => 'array',
        ]);

        try {
            // Simpan data ke tabel ppis
            $ppi = Ppi::create([
                'unit' => $request->unit,
                'tanggal' => $request->tanggal,
                'observer' => $request->observer,
            ]);

            $ppi_id = $ppi->id;

            // Simpan data ke tabel profesis
            foreach ($request->profesi as $index => $profesi) {
                $data = [
                    'ppi_id' => $ppi_id,
                    'profesi' => $profesi,
                    'jumlah' => $request->jumlah[$index],
                    'opp' => $request->opp[$index],
                ];
                Profesi::create($data);
            }

            // Simpan data ke tabel indikasis
            foreach ($request->opp as $index => $opp) {
                $data = [
                    'ppi_id' => $ppi_id,
                    'opp' => $opp,
                    'indikasi' => $request->indikasi[$index],
                    'cuci_tangan' => $request->cuci_tangan[$index],
                ];
                Indikasi::create($data);
            }

            return redirect()->route('ppis.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            return redirect()->route('ppis.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $ppis = Ppi::with('profesis','indikasis')->findOrFail($id);
        return view('ppis.edit', compact('ppis'));
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
            'unit' => 'required',
            'tanggal' => 'required|date',
            'observer' => 'required',
            'profesi' => 'array',
            'jumlah' => 'array',
            'opp' => 'array',
            'indikasi' => 'array',
            'cuci_tangan' => 'array',
        ]);

        try {
            // Simpan data ke tabel ppis
            $ppis = Ppi::findOrFail($id);
            $ppis->update([
                'unit' => $request->unit,
                'tanggal' => $request->tanggal,
                'observer' => $request->observer,
            ]);

            $ppi_id = $ppis->id;
            $ppis->profesis()->delete();
            $ppis->indikasis()->delete();

            // Simpan data ke tabel profesis
            foreach ($request->profesi as $index => $profesi) {
                $data = [
                    'ppi_id' => $ppi_id,
                    'profesi' => $profesi,
                    'jumlah' => $request->jumlah[$index],
                    'opp' => $request->opp[$index],
                ];
                Profesi::create($data);
            }

            // Simpan data ke tabel indikasis
            foreach ($request->opp as $index => $opp) {
                $data = [
                    'ppi_id' => $ppi_id,
                    'opp' => $opp,
                    'indikasi' => $request->indikasi[$index],
                    'cuci_tangan' => $request->cuci_tangan[$index],
                ];
                Indikasi::create($data);
            }

            return redirect()->route('ppis.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            return redirect()->route('ppis.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $ppi = Ppi::findOrFail($id);
        $ppi->delete();

        if($ppi){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
