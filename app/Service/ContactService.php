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
    public function create(array $data){
        $contact = [
            "name"=> $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'description' => $data['description'],
        ];

        return $this->repository->create($contact);
}

    public function destroy($contact){
        return $this->repository->delete($contact);
}
}
