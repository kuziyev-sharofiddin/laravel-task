<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function create(Application $application){
        return view('answers.create', ['application' => $application]);
    }

    public function store(Application $application, Request $request){

        $request->validate(['body' => 'required']);

        $application ->answer()->create([
            'body' => $request->body
        ]);

        return redirect()->route('dashboard');


    }
}
