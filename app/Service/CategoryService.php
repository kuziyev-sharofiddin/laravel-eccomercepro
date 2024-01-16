<?php

namespace App\Service;

use App\Repository\CategoryRepository;

class CategoryService
{
    protected CategoryRepository $repository;
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getByPaginate($limit)
    {
        return $this->repository->paginate($limit);
    }

    public function getByCategoryPaginate()
    {
        return $this->repository->categoryByPaginate();
    }

    public function create(array $data){
        $category = [
            "category_name"=> $data["category_name"],
        ];
        $this->repository->create($category);
    }

    public function destroy($category){
        return $this->repository->delete($category);
}
}
