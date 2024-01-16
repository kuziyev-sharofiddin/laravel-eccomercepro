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

    public function getByStatus($order)
    {
        $order = $this->repository->getById($order);
        $order->delivery_status='delivered';
        $order->payment_status='Paid';
        $order->save();
        return $order;
    }

    public function getByPaginate($limit)
    {
        return $this->repository->paginate($limit);
    }

    public function getById($id)
    {
       return $this->repository->getById($id);
    }

    public function cancelOrder($order)
    {
        $order = $this->repository->getById($order);
        $order->delivery_status='You canceled the order';
        $order->save();
        return $order;
    }
}
