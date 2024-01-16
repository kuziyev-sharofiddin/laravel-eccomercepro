<?php

namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Cart;
class CartRepository extends BaseRepository
{
    public function __construct(Cart $model)
    {
        parent::__construct($model);
    }
}
