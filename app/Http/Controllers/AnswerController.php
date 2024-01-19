<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Service\AnswerService;
use App\Service\ApplicationService;
use Illuminate\Support\Facades\Gate;

class AnswerController extends Controller
{

    public function __construct(protected AnswerService $answerService,protected ApplicationService $applicationService)
    {
        $this->middleware('role:manager');
    }
    public function create($application){

        if (! Gate::allows('update-post', auth()->user())) {
            abort(403);
        }
        $application = $this->applicationService->getById($application);
        return view('answers.create', ['application' => $application]);
    }

    public function store(AnswerRequest $request){

        if (! Gate::allows('update-post', auth()->user())) {
            abort(403);
        }
        $this->applicationService->createByApplication($request->all());
        return redirect()->route('dashboard');
    }
}
