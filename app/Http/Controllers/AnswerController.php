<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Answer;
use Illuminate\Support\Facades\Gate;

class AnswerController extends Controller
{

    public function __constuct(){
        $this->middleware('role:manager');
    }


    public function create(Application $application){

        if (! Gate::allows('update-post', auth()->user())) {
            abort(403);
        }


        return view('answers.create', ['application' => $application]);
    }

    public function store(Application $application, Request $request){

        // if (! Gate::allows('update-post', auth()->user())) {
        //     abort(403);
        // }

        $request->validate(['body' => 'required']);

        $application ->answer()->create([
            'body' => $request->body
        ]);

        return redirect()->route('dashboard');


    }
}
