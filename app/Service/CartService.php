<?php

namespace App\Service;

use App\Repository\CartRepository;

class CartService
{
    protected CartRepository $repository;
    public function __construct(CartRepository $repository)
    {
        $this->repository = $repository;
    }


}
