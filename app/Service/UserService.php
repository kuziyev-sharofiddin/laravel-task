<?php

namespace App\Service;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AnswerService
{
    public function getByPaginate($limit)
    {
        return $this->repository->paginate($limit);
    }
    public function getById($id)
    {
       return $this->repository->getById($id);
    }

    public function getApplicationByUser(){
        return Auth::user()->applications()->latest();
    }

    public function getApplicationPaginateByUser(){
        return auth()->user()->applications()->latest()->paginate(10);
    }

    protected function checkDate(){

        if ($this->getApplicationByUser()->first() == null){
            return false;
        }

        $last_application = $this->getApplicationByUser()->first();
        $last_app_date = Carbon::parse($last_application->created_at)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        if ($last_app_date === $today){
            return true;
        }
    }

}
