<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mutu;
use Illuminate\Database\Eloquent\Builder;

class MutuController extends Controller
{
    /**
    * __construct
    *
    * @return void
    */
   public function __construct()
   {
       $this->middleware(['permission:mutus.index|mutus.create|mutus.edit|mutus.delete']);
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
           $mutus = Mutu::latest()->when(request()->q, function($mutus) {
               $mutus = $mutus->where('name', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }elseif($currentUser->hasRole('karyawan')){
           $mutus = Mutu::whereHas('users', function (Builder $query) {
               $query->where('user_id', Auth()->id());
           })->paginate(10);
       }elseif($currentUser->hasRole('petugas')){
           $mutus = Mutu::where('created_by', Auth()->id())->latest()->when(request()->q, function($mutus) {
               $mutus = $mutus->where('created_by', Auth()->id())->where('name', 'like', '%'. request()->q . '%');
           })->paginate(10);
       }

       $user = new User();

       return view('mutus.index', compact('mutus','user'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       return view('mutus.create');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
       $this->validate($request, [
           'name'          => 'required',
           'time'          => 'required',
           'total_question'=> 'required',
           'start'         => 'required',
           'end'           => 'required'
       ]);

       $mutu = Mutu::create([
           'name'          => $request->input('name'),
           'time'          => $request->input('time'),
           'total_question'=> $request->input('total_question'),
           'status'        => 'Ready',
           'start'         => $request->input('start'),
           'end'           => $request->input('end'),
           'created_by'    => Auth()->id()
       ]);

    //    $mutu->questions()->sync($request->input('questions'));

       if($mutu){
           //redirect dengan pesan sukses
           return redirect()->route('mutus.index')->with(['success' => 'Data Berhasil Disimpan!']);
       }else{
           //redirect dengan pesan error
           return redirect()->route('mutus.index')->with(['error' => 'Data Gagal Disimpan!']);
       }
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit(Mutu $mutu)
   {
       $questions = $mutu->questions()->where('mutu_id', $mutu->id)->get();

       return view('mutus.edit', compact('mutu', 'questions'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, Mutu $mutu)
   {
       $this->validate($request, [
           'name'          => 'required',
           'time'          => 'required',
           'total_question'=> 'required',
           'start'         => 'required',
           'end'           => 'required'
       ]);

       $mutu->update([
           'name'          => $request->input('name'),
           'time'          => $request->input('time'),
           'total_question'=> $request->input('total_question'),
           'start'         => $request->input('start'),
           'end'           => $request->input('end'),
           'created_by'    => Auth()->id()
       ]);

    //    $mutu->questions()->sync($request->input('questions'));

       if($mutu){
           //redirect dengan pesan sukses
           return redirect()->route('mutus.index')->with(['success' => 'Data Berhasil Diupdate!']);
       }else{
           //redirect dengan pesan error
           return redirect()->route('mutus.index')->with(['error' => 'Data Gagal Diupdate!']);
       }
   }

   /**
    * Show the form for detailing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show(Mutu $mutu)
   {
       $questions = $mutu->questions()->where('mutu_id', $mutu->id)->get();

       return view('mutus.show', compact('mutu', 'questions'));
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
       $mutu = Mutu::findOrFail($id);
       $mutu->delete();

       if($mutu){
           return response()->json([
               'status' => 'success'
           ]);
       }else{
           return response()->json([
               'status' => 'error'
           ]);
       }
   }

   public function start($id)
   {
       $mutu = Mutu::findOrFail($id);
       $mutu_questions = $mutu->questions;

       if ($mutu_questions->count() == 0) {
           return back()->with(['error' => 'Belum ada Pertanyaan']);
       }
       return view('mutus.start', compact('id'));
   }

   public function result($score, $userId, $mutuId)
   {
       $user = User::findOrFail($userId);
       $mutu = Mutu::findOrFail($mutuId);
       return view('mutus.result', compact('score', 'user', 'mutu'));
   }

   public function karyawan($id)
   {
       $mutu = Mutu::findOrFail($id);
       return view('mutus.karyawan', compact('mutu'));
   }

   public function assign(Request $request, $id)
   {
       $mutu = Mutu::findOrFail($id);

       $mutu->users()->sync($request->input('karyawans'));

       return redirect('/mutus');

   }

   public function review($userId, $mutuId)
   {
       return view('mutus.review', compact('userId', 'mutuId'));
   }

   public function finaly()
   {
       // Mengambil data mutu dengan pengguna terkait dan informasi dari tabel pivot
       $finalyData = Mutu::with(['users' => function($query) {
           $query->select('users.id', 'users.name', 'mutu_user.history_answer', 'mutu_user.score');
       }])->paginate(10);

       return view('finaly.index', compact('finalyData'));
   }

}
