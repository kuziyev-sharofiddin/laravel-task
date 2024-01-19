<?php

namespace App\Service;
use App\Repository\AnswerRepository;

class AnswerService
{
    public function __construct(protected AnswerRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getByPaginate($limit)
    {
        return $this->repository->paginate($limit);
    }
    public function getById($id)
    {
       return $this->repository->getById($id);
    }

}
