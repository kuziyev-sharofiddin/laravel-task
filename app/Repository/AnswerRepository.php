<?php

namespace App\Repository;

use App\Models\Answer;
use App\Repository\BaseRepository;

class AnswerRepository extends BaseRepository
{
    public function __construct(Answer $model)
    {
        parent::__construct($model);
    }
}
