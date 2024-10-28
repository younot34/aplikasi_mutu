<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Clinical;
use Illuminate\Database\Eloquent\Builder;

class ClinicalController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:clinicals.index|clinicals.create|clinicals.edit|clinicals.delete']);
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
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $clinical = Clinical::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $clinical = Clinical::latest()->when(request()->q, function($clinical) {
               $clinical = $clinical->where('nama_px', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('clinicals.index', compact('clinical','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('clinicals.create');
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
            'no_rm' => 'required|string',
            'nama_px' => 'required|string',
            'ca_cervik' => 'nullable|string',
            'tb' => 'nullable|string',
            'ht' => 'nullable|string',
            'hiv' => 'nullable|string',
            'dm' => 'nullable|string',
            'masuk' => 'nullable|date',
            'keluar' => 'nullable|date',
        ]);

        try {
            Clinical::create([
                'no_rm' => $request->no_rm,
                'nama_px' => $request->nama_px,
                'ca_cervik' => $request->ca_cervik,
                'tb' => $request->tb,
                'ht' => $request->ht,
                'hiv' => $request->hiv,
                'dm' => $request->dm,
                'masuk' => $request->masuk,
                'keluar' => $request->keluar,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('clinicals.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('clinicals.index')->with(['error' => 'Data Gagal Diperbarui!']);
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
        $clinical = Clinical::findOrFail($id);
        return view('clinicals.edit', compact('clinical'));
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
            'no_rm' => 'required|string',
            'nama_px' => 'required|string',
            'ca_cervik' => 'nullable|string',
            'tb' => 'nullable|string',
            'ht' => 'nullable|string',
            'hiv' => 'nullable|string',
            'dm' => 'nullable|string',
            'masuk' => 'nullable|date',
            'keluar' => 'nullable|date',
        ]);
        try {
            // Simpan data ke tabel ris
            $clinical = Clinical::findOrFail($id);
            $clinical->update([
                'no_rm' => $request->no_rm,
                'nama_px' => $request->nama_px,
                'ca_cervik' => $request->ca_cervik,
                'tb' => $request->tb,
                'ht' => $request->ht,
                'hiv' => $request->hiv,
                'dm' => $request->dm,
                'masuk' => $request->masuk,
                'keluar' => $request->keluar,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('clinicals.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('clinicals.index')->with(['error' => 'Data Gagal Diubah!']);
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
        $clinical = Clinical::findOrFail($id);
        $clinical->delete();

        if($clinical){
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
            $clinical = Clinical::whereMonth('masuk', date('m', strtotime($bulan)))->paginate(10);
        } else {
            $clinical = Clinical::paginate(10);
        }
        return view('clinicals.export_c', compact('clinical', 'bulan'));
    }
}
