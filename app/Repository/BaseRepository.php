<?php

namespace App\Repository;

use App\Interface\BaseInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseInterface
{
    public function __construct(private Model $model)
    {

    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }


    public function update($id,array $data): bool
    {
       return $this->getById($id)->update($data);
    }


    public function getById($id)
    {
        return $this->model->find($id);
    }


    public function paginate($limit)
    {
        return $this->model->paginate($limit);
    }

    public function categoryByPaginate()
    {
        return $this->model->all();
    }

    public function delete($id)
    {
       return $this->getById($id)->delete();
    }

    public function getSearchOrder($searchText)
    {
        return $this->model->where('name', 'LIKE', "%$searchText%")->orWhere('phone', 'LIKE', "%$searchText%")->orWhere('product_title', 'LIKE', "%$searchText%")->paginate(10);
    }
}
