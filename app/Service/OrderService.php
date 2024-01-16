<?php

namespace App\Service;
use App\Repository\OrderRepository;

class OrderService
{
    protected OrderRepository $repository;
    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }
    public function getSearchOrder($searchText)
    {
        return $this->repository->getSearchOrder($searchText);
    }

    public function getById($order)
    {
        $order = $this->repository->getById($order);
        $order->delivery_status='delivered';
        $order->payment_status='Paid';
        $order->save();
        return $order;
    }
}
