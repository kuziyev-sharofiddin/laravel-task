<?php

namespace App\Service;
use App\Repository\ApplicationRepository;

class ApplicationService
{
    public function __construct(protected ApplicationRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getByPaginate($limit)
    {
        return $this->repository->paginate($limit);
    }
    public function getByAnswerCreate()
    {
        return $this->repository->getByAnswerCreate();
    }
    public function createByApplication(array $data){
        $result = $this->getByAnswerCreate()->create([
            'body' => $data['body']
        ]);
        return $this->repository->create($result);
    }
    public function create(array $data){
        if (isset($data["photo"])) {
            $name = $data["photo"]->getClientOriginalName();
            $path = $data["photo"]->storeAs('post-photos', $name);
        }
        $result = [
            'user_id' => auth()->user()->id,
            'subject' => $data["subject"],
            'message' => $data["message"],
            'file_url' => $path ?? null,
        ];
        $this->repository->create($result);
    }
    public function getById($id)
    {
       return $this->repository->getById($id);
    }
}
