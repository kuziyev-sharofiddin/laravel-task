<?php

namespace App\Repository;

use App\Models\Answer;
use App\Models\Application;
use App\Repository\BaseRepository;

class ApplicationRepository extends BaseRepository
{
    public function __construct(Application $model)
    {
        parent::__construct($model);
    }
}
