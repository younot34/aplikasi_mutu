<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farmasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class FarmasiController extends Controller
{
    public $farmasi;

    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:farmasis.index|farmasis.create|farmasis.edit|farmasis.delete']);
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
           $farmasis = Farmasi::latest()->when(request()->q, function($farmasis) {
               $farmasis = $farmasis->where('name', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $farmasis = Farmasi::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas')){
           $farmasis = Farmasi::where('created_by', Auth()->id())->latest()->when(request()->q, function($farmasis) {
               $farmasis = $farmasis->where('created_by', Auth()->id())->where('name', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('farmasis.index', compact('farmasis','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('farmasis.create');
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
        $this->validate($request, [
            'waktu'             => 'required',
            'nama_px'           => 'required',
            'r'                 => 'required',
            'nama_obat'         => 'required',
            'total_obat_fornas' => 'required',
            'total_item'        => 'required'
        ]);

        $farmasi = Farmasi::create([
            'waktu'                 => $request->input('waktu'),
            'nama_px'               => $request->input('nama_px'),
            'r'                     => $request->input('r'),
            'nama_obat'             => $request->input('nama_obat'),
            'total_obat_fornas'     => $request->input('total_obat_fornas'),
            'total_item'            => $request->input('total_item'),
            'created_by'            => Auth()->id()
        ]);

     //    $farmasi->questions()->sync($request->input('questions'));

        if($farmasi){
            //redirect dengan pesan sukses
            return redirect()->route('farmasis.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('farmasis.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Farmasi $farmasi)
    {
        $farmasi->waktu = \Carbon\Carbon::parse($farmasi->waktu)->format('Y-m-d\TH:i');
        return view('farmasis.edit', compact('farmasi'));
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
        $this->validate($request, [
            'waktu'            ,
            'nama_px'          ,
            'r'                ,
            'nama_obat'        ,
            'total_obat_fornas',
            'total_item'       
        ]);

        $farmasi = Farmasi::find($id);

        if ($farmasi) {
            $farmasi->update([
                'waktu'                 => $request->input('waktu'),
                'nama_px'               => $request->input('nama_px'),
                'r'                     => $request->input('r'),
                'nama_obat'             => $request->input('nama_obat'),
                'total_obat_fornas'     => $request->input('total_obat_fornas'),
                'total_item'            => $request->input('total_item'),
                'created_by'            => Auth()->id()
            ]);

            return redirect()->route('farmasis.index')->with(['success' => 'Data Berhasil DiUpdate!']);
        } else {
            return redirect()->route('farmasis.index')->with(['error' => 'Data Tidak Ditemukan!']);
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
        $farmasi = Farmasi::findOrFail($id);
        $farmasi->delete();

        if($farmasi){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    public function addFarmasiInput(): void
    {
        $this->farmasi[] = ['waktu' =>'',
        'nama_px'=>'',
        'r'=>'',
        'nama_obat'=>'',
        'total_obat_fornas'=>'',
        'total_item'=>''];
    }
    public function addObatInput(): void
    {
        $this->farmasi[] = [
        'r'=>'',
        'nama_obat'=>'',
        'total_obat_fornas'=>'',
        'total_item'=>''];
    }
    public function removeFarmasiInput(int $index): void
    {
        unset($this->farmasi[$index]);
        $this->farmasi = array_values($this->farmasi);
    }
}
