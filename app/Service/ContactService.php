<?php

namespace App\Service;

use App\Repository\ContactRepository;

class ContactService
{
    protected ContactRepository $repository;
    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getByPaginate($limit)
    {
        return $this->repository->paginate($limit);
    }

    // public function create(array $data){
    //     $category = [
    //         "category_name"=> $data["category_name"],
    //     ];
    //     $this->repository->create($category);
    // }

    public function destroy($contact){
        return $this->repository->delete($contact);
}
}
