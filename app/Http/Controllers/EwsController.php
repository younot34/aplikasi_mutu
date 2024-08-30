<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ews;
use Illuminate\Database\Eloquent\Builder;

class EwsController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:ewss.index|ewss.create|ewss.edit|ewss.delete']);
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
           $ews = Ews::latest()->when(request()->q, function($ews) {
               $ews = $ews->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $ews = Ews::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $ews = Ews::latest()->when(request()->q, function($ews) {
               $ews = $ews->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $ews = Ews::latest()->when(request()->q, function($ews) {
               $ews = $ews->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $ews = Ews::latest()->when(request()->q, function($ews) {
               $ews = $ews->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $ews = Ews::latest()->when(request()->q, function($ews) {
               $ews = $ews->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $ews = Ews::latest()->when(request()->q, function($ews) {
               $ews = $ews->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $ews = Ews::latest()->when(request()->q, function($ews) {
               $ews = $ews->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $ews = Ews::latest()->when(request()->q, function($ews) {
               $ews = $ews->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $ews = Ews::latest()->when(request()->q, function($ews) {
               $ews = $ews->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('ewss.index', compact('ews','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('ewss.create');
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
            'no_rm' => 'required|string',
            'nama_pasien' => 'required|string',
            'terisi' => 'nullable|string',
            'tidak_terisi' => 'nullable|string',
        ]);

        try {
            // Simpan data ke tabel ris
            Ews::create([
                'tanggal' => $request->tanggal,
                'no_rm' => $request->no_rm,
                'nama_pasien' => $request->nama_pasien,
                'terisi' => $request->terisi,
                'tidak_terisi' => $request->tidak_terisi,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('ewss.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('ewss.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $ews = Ews::findOrFail($id);
        return view('ewss.edit', compact('ews'));
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
            'no_rm' => 'required|string',
            'nama_pasien' => 'required|string',
            'terisi' => 'nullable|string',
            'tidak_terisi' => 'nullable|string',
        ]);
        try {
            // Simpan data ke tabel ris
            $ews = Ews::findOrFail($id);
            $ews->update([
                'tanggal' => $request->tanggal,
                'no_rm' => $request->no_rm,
                'nama_pasien' => $request->nama_pasien,
                'terisi' => $request->terisi,
                'tidak_terisi' => $request->tidak_terisi,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('ewss.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('ewss.index')->with(['error' => 'Data Gagal Diubah!']);
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
        $ews = Ews::findOrFail($id);
        $ews->delete();

        if($ews){
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
            $ews = Ews::whereMonth('tanggal', date('m', strtotime($bulan)))->paginate(10);
        } else {
            $ews = Ews::paginate(10);
        }
        return view('ewss.export_e', compact('ews', 'bulan'));
    }
}
