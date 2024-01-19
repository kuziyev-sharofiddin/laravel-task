<?php

namespace App\Repository;

use App\Interface\BaseInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseInterface
{
    public function __construct(private Model $model)
    {

    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }


    public function update($id,array $data)
    {
       return $this->getById($id)->update($data);
    }


    public function getById($id)
    {
        return $this->model->find($id);
    }


    public function getByAnswerCreate()
    {
        return $this->model->answer();
    }


    public function getByCategoryId($id)
    {
        return $this->model->category->find($id);
    }

    public function paginate($limit)
    {
        return $this->model->paginate($limit);
    }
    public function delete($id)
    {
       return $this->getById($id)->delete();
    }

    public function getLatestById($id){
        return $this->model->latest()->get()->except($this->getById($id))->take(6);
    }
}
