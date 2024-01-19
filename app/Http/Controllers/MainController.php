<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Service\ApplicationService;

class MainController extends Controller
{
    public function __construct(protected ApplicationService $applicationService)
    {

    }

    public function main(){
        return redirect('dashboard');
    }
    public function dashboard(){
        return view('dashboard')->with([
            'applications' => $this->applicationService->getByPaginate(10),
        ]);
    }
}
