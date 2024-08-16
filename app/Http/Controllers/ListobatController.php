<?php

namespace App\Http\Controllers;

use App\Models\listobat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Imports\ObatImport;
use Maatwebsite\Excel\Facades\Excel;

class ListobatController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:list.index|list.create|list.edit|list.delete']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = User::findOrFail(Auth()->id());
       if($currentUser->hasRole('admin')){
           $list = listobat::latest()->when(request()->q, function($list) {
               $list = $list->where('list_obat', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $list = listobat::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas1')){
           $list = listobat::latest()->when(request()->q, function($list) {
               $list = $list->where('list_obat', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas2')){
           $list = listobat::latest()->when(request()->q, function($list) {
               $list = $list->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas3')){
           $list = listobat::latest()->when(request()->q, function($list) {
               $list = $list->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas4')){
           $list = listobat::latest()->when(request()->q, function($list) {
               $list = $list->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas5')){
           $list = listobat::latest()->when(request()->q, function($list) {
               $list = $list->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas6')){
           $list = listobat::latest()->when(request()->q, function($list) {
               $list = $list->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas7')){
           $list = listobat::latest()->when(request()->q, function($list) {
               $list = $list->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('direktur')){
           $list = listobat::latest()->when(request()->q, function($list) {
               $list = $list->where('waktu', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();
       $list = listobat::all();

       return view('list.index', compact('list','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('list.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'list_obat' => 'required|string',
        ]);

        try {
            // Simpan data ke tabel list
            listobat::create([
                'list_obat' => $request->list_obat,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('list.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('list.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\listobat  $listobat
     * @return \Illuminate\Http\Response
     */
    public function show(listobat $listobat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\listobat  $listobat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list = listobat::findOrFail($id);
        return view('list.edit', compact('list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\listobat  $listobat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, listobat $listobat)
    {
        $request->validate([
            'list_obat' => 'required|string',
        ]);

        try {
            // Simpan data ke tabel list
            listobat::create([
                'list_obat' => $request->list_obat,
            ]);

            $listobat->listobats()->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('list.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->route('list.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $list = listobat::findOrFail($id);
        $list->delete();

        if($list){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new ObatImport, $file);

        return redirect()->route('list.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function showImportForm()
    {
        return view('list.index'); // Ganti dengan nama view yang sesuai
    }

    public function autocomplete(Request $request)
    {
        $term = $request->input('term');
        $namaObat = Listobat::where('list_obat', 'LIKE', '%' . $term . '%')->pluck('list_obat');
        return response()->json($namaObat);
    }


}
