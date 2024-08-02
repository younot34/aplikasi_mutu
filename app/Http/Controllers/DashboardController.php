<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mutu;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mutus = Mutu::whereHas('users', function (Builder $query) {
            $query->where('user_id', Auth()->id());
        })->get();
        return view('dashboard.index', compact('mutus'));
    }
}