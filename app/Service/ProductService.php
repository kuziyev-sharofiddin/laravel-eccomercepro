<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;
use App\Repository\ProductRepository;

class ProductService
{
    protected ProductRepository $repository;
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getByPaginate($limit)
    {
        return $this->repository->paginate($limit);
    }

    public function create(array $data){

            if (isset($data['image'])){
                $name = $data['image']->getClientOriginalName();
                $path = $data['image']->storeAs('product-images', $name);
            }

            $product = [
                // 'user_id'=>auth()->user()->id,
                "category_id"=> $data['category_id'],
                'title' => $data['title'],
                'description' => $data['description'],
                'quantity' => $data['quantity'],
                'price' => $data['price'],
                'discount_price' => $data['discount_price'],
                'image' => $path,
            ];

            return $this->repository->create($product);
    }

    public function getById($id)
    {
       return $this->repository->getById($id);
    }

    public function update(array $data, $id){

        if (isset($data['image'])){
            if (isset($data['image'])){
                Storage::delete($data['image']);
            }

            $name = $data['image']->getClientOriginalName();
            $path = $data['image']->storeAs('product-images', $name);
        }

        $product = [
            // 'user_id'=>auth()->user()->id,
            "category_id"=> $data['category_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'discount_price' => $data['discount_price'],
            'image' => $path ?? $data['image'],
        ];
        return $this->repository->update($product, $id);
    }

    public function destroy($product){
            if (isset($product->image)){
                Storage::delete($product->image);
            }
            return $this->repository->delete($product);
    }
}
