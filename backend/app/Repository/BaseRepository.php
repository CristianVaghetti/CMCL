<?php

namespace App\Repository;

use App\Repository\IRepository;
use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository implements IRepository
{
    protected $model;

    public function find(int $id) 
    {
        return $this->model->find($id);
    }

    public function all(array $orderBy = []) 
    {
        if($orderBy){
            $all =  $this->model->orderBy($orderBy[0], $orderBy[1])->get();
        }else{
            $all = $this->model->all();
        }

        return $all;
    }
   
    public function save(array $data) : bool
    {

        if (!isset($data['id']) || empty($data['id'])) {
            return $this->model->fill($data)->save();
        } else {
            $model = $this->model->find($data['id']);
            return $model->fill($data)->save();
        }
    }

    public function delete(int $id) : bool
    {
        return $this->model->find($id)->delete();
    }

    public function deleteFileDisco($caminho) : bool
    {
        $caminho = explode('/', $caminho);
        $remove = unlink('../public/' .$caminho[3]. '/' . $caminho[4]);

        if ($remove) {
            return true;
        } else {
            return false;
        }
    }

}
