<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class MainController extends Controller
{

    public function main(){
        return redirect('dashboard');
    }
    public function dashboard(){
        return view('dashboard')->with([
            'applications' => Application::latest()->paginate(5),
        ]);
    }
}
