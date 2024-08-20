<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ases;
use Illuminate\Database\Eloquent\Builder;

class AsesController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:asess.index|asess.create|asess.edit|asess.delete']);
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
           $ases = Ases::latest()->when(request()->q, function($ases) {
               $ases = $ases->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $ases = Ases::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $ases = Ases::latest()->when(request()->q, function($ases) {
               $ases = $ases->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $ases = Ases::latest()->when(request()->q, function($ases) {
               $ases = $ases->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $ases = Ases::latest()->when(request()->q, function($ases) {
               $ases = $ases->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $ases = Ases::latest()->when(request()->q, function($ases) {
               $ases = $ases->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $ases = Ases::latest()->when(request()->q, function($ases) {
               $ases = $ases->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $ases = Ases::latest()->when(request()->q, function($ases) {
               $ases = $ases->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $ases = Ases::latest()->when(request()->q, function($ases) {
               $ases = $ases->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $ases = Ases::latest()->when(request()->q, function($ases) {
               $ases = $ases->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('asess.index', compact('ases','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('asess.create');
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
            'poli' => 'required|string',
            'patuh' => 'nullable|integer',
            'tidak_patuh' => 'nullable|integer',
        ]);

        try {
            // Simpan data ke tabel ris
            Ases::create([
                'tanggal' => $request->tanggal,
                'poli' => $request->poli,
                'patuh' => $request->patuh,
                'tidak_patuh' => $request->tidak_patuh,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('asess.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('asess.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $ases = Ases::findOrFail($id);
        return view('asess.edit', compact('ases'));
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
            'poli' => 'required|string',
            'patuh' => 'nullable|integer',
            'tidak_patuh' => 'nullable|integer',
        ]);
        try {
            // Simpan data ke tabel ris
            $ases = Ases::findOrFail($id);
            $ases->update([
                'tanggal' => $request->tanggal,
                'poli' => $request->poli,
                'patuh' => $request->patuh,
                'tidak_patuh' => $request->tidak_patuh,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('asess.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('asess.index')->with(['error' => 'Data Gagal Diubah!']);
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
        $ases = Ases::findOrFail($id);
        $ases->delete();

        if($ases){
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
            $ases = Ases::whereMonth('tanggal', date('m', strtotime($bulan)))->paginate(10);
        } else {
            $ases = Ases::paginate(10);
        }
        return view('asess.export_as', compact('ases', 'bulan'));
    }
}
