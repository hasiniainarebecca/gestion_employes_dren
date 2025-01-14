<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Models\Employes;
use App\Models\User;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index(){
        $totalService = Services::all()->count();
        $totalEmployes = Employes::all()->count();
        $totalAdministrateurs = User::all()->count();
        return view('dashboard',compact('totalService','totalEmployes','totalAdministrateurs'));
    }
}
