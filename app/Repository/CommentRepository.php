<?php

namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Comment;
class CommentRepository extends BaseRepository
{
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }
}
