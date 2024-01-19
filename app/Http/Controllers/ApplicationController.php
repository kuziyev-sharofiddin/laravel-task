<?php

namespace App\Http\Controllers;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;
use App\Http\Requests\StoreApplicationRequest;
use App\Service\ApplicationService;
use App\Service\UserService;

class ApplicationController extends Controller
{
    public function __construct(protected ApplicationService $applicationService, protected UserService $userService)
    {
        $this->middleware('role:manager')->only('index');
    }

    public function index(){
        return view('applications.index')->with([
            'applications' => $this->$userService->getApplicationPaginateByUser(),
        ]);
    }


    public function store(StoreApplicationRequest $request){

        if($this->checkDate()){
            return redirect()->back()->with('error', 'You can create only 1 application a day');
        }
        $application = $this->applicationService->create($request->all());
        dispatch(new SendEmailJob($application));
        return redirect()->back();
    }

    protected function checkDate(){

        if (auth()->user()->applications()->latest()->first() == null){
            return false;
        }

        $last_application = auth()->user()->applications()->latest()->first();
        $last_app_date = Carbon::parse($last_application->created_at)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        if ($last_app_date === $today){
            return true;
        }
    }
}
