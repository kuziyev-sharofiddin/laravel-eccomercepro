<?php

namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Order;
class OrderRepository extends BaseRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }
}
