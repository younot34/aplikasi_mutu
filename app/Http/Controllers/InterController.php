<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inter;
use Illuminate\Database\Eloquent\Builder;

class InterController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:inters.index|inters.create|inters.edit|inters.delete']);
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
           $inter = Inter::latest()->when(request()->q, function($inter) {
               $inter = $inter->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $inter = Inter::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $inter = Inter::latest()->when(request()->q, function($inter) {
               $inter = $inter->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $inter = Inter::latest()->when(request()->q, function($inter) {
               $inter = $inter->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $inter = Inter::latest()->when(request()->q, function($inter) {
               $inter = $inter->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $inter = Inter::latest()->when(request()->q, function($inter) {
               $inter = $inter->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $inter = Inter::latest()->when(request()->q, function($inter) {
               $inter = $inter->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $inter = Inter::latest()->when(request()->q, function($inter) {
               $inter = $inter->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $inter = Inter::latest()->when(request()->q, function($inter) {
               $inter = $inter->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $inter = Inter::latest()->when(request()->q, function($inter) {
               $inter = $inter->where('tanggal', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('inters.index', compact('inter','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('inters.create');
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
            Inter::create([
                'tanggal' => $request->tanggal,
                'no_rm' => $request->no_rm,
                'nama_pasien' => $request->nama_pasien,
                'terisi' => $request->terisi,
                'tidak_terisi' => $request->tidak_terisi,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('inters.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('inters.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $inter = Inter::findOrFail($id);
        return view('inters.edit', compact('inter'));
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
            $inter = Inter::findOrFail($id);
            $inter->update([
                'tanggal' => $request->tanggal,
                'no_rm' => $request->no_rm,
                'nama_pasien' => $request->nama_pasien,
                'terisi' => $request->terisi,
                'tidak_terisi' => $request->tidak_terisi,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('inters.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('inters.index')->with(['error' => 'Data Gagal Diubah!']);
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
        $inter = Inter::findOrFail($id);
        $inter->delete();

        if($inter){
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
            $inter = Inter::whereMonth('tanggal', date('m', strtotime($bulan)))->paginate(10);
        } else {
            $inter = Inter::paginate(10);
        }
        return view('inters.export_e', compact('inter', 'bulan'));
    }
}
