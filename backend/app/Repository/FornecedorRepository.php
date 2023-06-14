<?php

namespace App\Repository;

use App\Models\Fornecedor;
use App\Helpers\UtilHelper;
use DB;

class FornecedorRepository extends BaseRepository
{
    
    protected $model;

    public function __construct(Fornecedor $fornecedor)
    {
        $this->model = $fornecedor;
    }

    public function search (array $filtros = [])
    {
        $query = $this->model;

        if(isset($filtros['nome']) && !empty($filtros['nome'])) 
        {
            $query = $query->where('nome', 'ilike', '%' . $filtros['nome'] . '%');
        }

        if(isset($filtros['cnpj']) && !empty($filtros['cnpj'])) 
        {
            $query = $query->where('cnpj', $filtros['cnpj']);
        }

        if(isset($filtros['situacao']) && !empty($filtros['situacao'])) 
        {
            $query = $query->where('situacao', $filtros['situacao']);
        }
       
        return $query->orderBy('updated_at', 'DESC')->get();
    }

    public function save(array $request, bool $sync = true) : bool
    {
        try {
            $modelOld = '';
            if(isset($request['id']) && $request['id']) {
                $modelOld = $this->model->find($request['id']);
                $model = $this->model->find($request['id']);
            } else {
                $model = $this->model;
            }

            DB::beginTransaction();

            $model->fill($request);

            if($model->save()){
                if($modelOld !== ''){
                    UtilHelper::log($model->getChanges(),$modelOld, 'ALTERAÇÃO DE FORNECEDOR',  $model->id, $this->model->getTable());
                } else {
                    UtilHelper::log(null, null, 'CADASTRO DE FORNECEDOR', $model->id, $this->model->getTable());
                }
            }

            DB::commit();

            return true;
        } catch (\Exception $ex) {
            DB::rollback();
            print_r($ex->getMessage());
            return false;
        }
    }

    public function toggle($id)
    {
        $fornecedor = $this->model->find($id);
        $status = [];

        if($fornecedor->situacao){
            $fornecedor->situacao = false;
            $status['msg'] = 'FORNECEDOR DESATIVADO COM SUCESSO!';
        } else {
            $fornecedor->situacao = true;
            $status['msg'] = 'FORNECEDOR ATIVADO COM SUCESSO!';
        }

        if($fornecedor->save()){
            UtilHelper::log(null, null, $status['msg'], $id, $this->model->getTable());
            $status['status'] = true;
        } else {
            $status['status'] = false;
            $status['msg'] = 'FALHA AO DESTATIVAR/ATIVAR FORNECEDOR';
        }

        return $status;
    }
}