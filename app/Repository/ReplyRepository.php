<?php

namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Reply;
class ReplyRepository extends BaseRepository
{
    public function __construct(Reply $model)
    {
        parent::__construct($model);
    }
}
