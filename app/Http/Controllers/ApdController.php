<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Apd;
use Illuminate\Database\Eloquent\Builder;

class ApdController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:apds.index|apds.create|apds.edit|apds.delete']);
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
           $apd = Apd::latest()->when(request()->q, function($apd) {
               $apd = $apd->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $apd = Apd::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $apd = Apd::latest()->when(request()->q, function($apd) {
               $apd = $apd->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $apd = Apd::latest()->when(request()->q, function($apd) {
               $apd = $apd->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $apd = Apd::latest()->when(request()->q, function($apd) {
               $apd = $apd->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $apd = Apd::latest()->when(request()->q, function($apd) {
               $apd = $apd->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $apd = Apd::latest()->when(request()->q, function($apd) {
               $apd = $apd->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $apd = Apd::latest()->when(request()->q, function($apd) {
               $apd = $apd->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $apd = Apd::latest()->when(request()->q, function($apd) {
               $apd = $apd->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $apd = Apd::latest()->when(request()->q, function($apd) {
               $apd = $apd->where('unit', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('apds.index', compact('apd','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('apds.create');
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
            'unit' => 'required|string',
            'nama_petugas' => 'nullable|string',
            'profesi' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'topi' => 'nullable|string',
            'kacamata' => 'nullable|string',
            'masker' => 'nullable|string',
            'gown' => 'nullable|string',
            'sarung_tangan' => 'nullable|string',
            'sepatu' => 'nullable|string',
            'ya' => 'nullable|string',
            'tidak' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        try {
            Apd::create([
                'tanggal' => $request->tanggal,
                'no_rm' => $request->no_rm,
                'unit' => $request->unit,
                'nama_petugas' => $request->nama_petugas,
                'profesi' => $request->profesi,
                'tindakan' => $request->tindakan,
                'topi' => $request->topi,
                'kacamata' => $request->kacamata,
                'masker' => $request->masker,
                'gown' => $request->gown,
                'sarung_tangan' => $request->sarung_tangan,
                'sepatu' => $request->sepatu,
                'ya' => $request->ya,
                'tidak' => $request->tidak,
                'keterangan' => $request->keterangan,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('apds.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('apds.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $apd = Apd::findOrFail($id);
        return view('apds.edit', compact('apd'));
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
            'unit' => 'required|string',
            'nama_petugas' => 'nullable|string',
            'profesi' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'topi' => 'nullable|string',
            'kacamata' => 'nullable|string',
            'masker' => 'nullable|string',
            'gown' => 'nullable|string',
            'sarung_tangan' => 'nullable|string',
            'sepatu' => 'nullable|string',
            'ya' => 'nullable|string',
            'tidak' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);
        try {
            // Simpan data ke tabel ris
            $apd = Apd::findOrFail($id);
            $apd->update([
                'tanggal' => $request->tanggal,
                'no_rm' => $request->no_rm,
                'unit' => $request->unit,
                'nama_petugas' => $request->nama_petugas,
                'profesi' => $request->profesi,
                'tindakan' => $request->tindakan,
                'topi' => $request->topi,
                'kacamata' => $request->kacamata,
                'masker' => $request->masker,
                'gown' => $request->gown,
                'sarung_tangan' => $request->sarung_tangan,
                'sepatu' => $request->sepatu,
                'ya' => $request->ya,
                'tidak' => $request->tidak,
                'keterangan' => $request->keterangan,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('apds.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('apds.index')->with(['error' => 'Data Gagal Diubah!']);
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
        $apd = Apd::findOrFail($id);
        $apd->delete();

        if($apd){
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
