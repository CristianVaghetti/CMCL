<?php

namespace App\Repository;

use App\Models\Log;
use DB;

class LogRepository extends BaseRepository
{
    
    protected $model;

    public function __construct(Log $log)
    {
        $this->model = $log;
    }

    public function search(array $filtros = [])
    {
        $query = $this->model;
        $query = $query->selectRaw("to_char(created_at, 'dd/MM/YYYY HH24:mi:ss') as datac, descricao, dados, obj_id");


        if(isset($filtros['table'])) {
            $query = $query->where('table', $filtros['table']);
        }

        if(isset($filtros['obj_id'])) {
            $query = $query->where('obj_id', $filtros['obj_id']);
        }
     
        return $query->orderBy('updated_at', 'ASC')->get();
    }
}