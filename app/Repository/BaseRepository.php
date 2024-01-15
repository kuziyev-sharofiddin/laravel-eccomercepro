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

    public function categoryByPaginate($limit)
    {
        return $this->model->paginate($limit);
    }

    public function delete($id)
    {
       return $this->getById($id)->delete();
    }

}
