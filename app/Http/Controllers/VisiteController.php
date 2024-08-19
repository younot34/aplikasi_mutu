<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Visite;
use Illuminate\Database\Eloquent\Builder;

class VisiteController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:visites.index|visites.create|visites.edit|visites.delete']);
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
           $visite = Visite::latest()->when(request()->q, function($visite) {
               $visite = $visite->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $visite = Visite::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $visite = Visite::latest()->when(request()->q, function($visite) {
               $visite = $visite->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $visite = Visite::latest()->when(request()->q, function($visite) {
               $visite = $visite->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $visite = Visite::latest()->when(request()->q, function($visite) {
               $visite = $visite->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $visite = Visite::latest()->when(request()->q, function($visite) {
               $visite = $visite->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $visite = Visite::latest()->when(request()->q, function($visite) {
               $visite = $visite->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $visite = Visite::latest()->when(request()->q, function($visite) {
               $visite = $visite->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $visite = Visite::latest()->when(request()->q, function($visite) {
               $visite = $visite->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $visite = Visite::latest()->when(request()->q, function($visite) {
               $visite = $visite->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('visites.index', compact('visite','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('visites.create');
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
            'no_rm' => 'required|integer',
            'nama_px' => 'required|string',
            'jam6sampai14' => 'nullable|string',
            'kurang14' => 'nullable|string',
            'dokter_spesial' => 'string'
        ]);

        try {
            // Simpan data ke tabel ris
            Visite::create([
                'tanggal' => $request->tanggal,
                'no_rm' => $request->no_rm,
                'nama_px' => $request->nama_px,
                'jam6sampai14' => $request->jam6sampai14,
                'kurang14' => $request->kurang14,
                'dokter_spesial' => $request->dokter_spesial,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('visites.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('visites.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $visite = Visite::findOrFail($id);
        return view('visites.edit', compact('visite'));
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
            'no_rm' => 'required|integer',
            'nama_px' => 'required|string',
            'jam6sampai14' => 'nullable|string',
            'kurang14' => 'nullable|string',
            'dokter_spesial' => 'string'
        ]);
        try {
            // Simpan data ke tabel ris
            $visite = Visite::findOrFail($id);
            $visite->update([
                'tanggal' => $request->tanggal,
                'no_rm' => $request->no_rm,
                'nama_px' => $request->nama_px,
                'jam6sampai14' => $request->jam6sampai14,
                'kurang14' => $request->kurang14,
                'dokter_spesial' => $request->dokter_spesial,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('visites.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('visites.index')->with(['error' => 'Data Gagal Diubah!']);
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
        $visite = Visite::findOrFail($id);
        $visite->delete();

        if($visite){
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
            $visite = Visite::whereMonth('tanggal', date('m', strtotime($bulan)))->paginate(10);
        } else {
            $visite = Visite::paginate(10);
        }
        return view('visites.export_v', compact('visite', 'bulan'));
    }
}
