<?php

namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Category;
class CategoryRepository extends BaseRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
}
