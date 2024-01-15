<?php

namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Product;
class ProductRepository extends BaseRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }
}
