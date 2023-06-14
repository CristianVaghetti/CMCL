<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Repository\FornecedorRepository;

class FornecedorController extends Controller
{
    private $repository;

    public function __construct(FornecedorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $filtros = $request->toArray();

            $fornecedores = $this->repository->search($filtros);

            return ResponseHelper::responseSuccess($fornecedores->toArray(), "");
        } catch (\Exception $ex) {
            return ResponseHelper::responseError([], $ex->getMessage());
        }
    }

    public function storeUpdate(Request $request)
    {
        $req = $request->toArray();
        $msg = $req['id'] !== null ? 'FORNECEDOR ALTERADO COM SUCESSO!' : 'FORNECEDOR CADASTRADO COM SUCESSO!';

        try {
            if ($this->repository->save($req)) {
                return ResponseHelper::responseSuccess([], $msg);
            } else {
                return ResponseHelper::responseError([], 'FALHA AO ALTERAR/CADASTRAR FORNECEDOR!');
            }
        } catch (\Exception $ex) {
            return ResponseHelper::responseError([], $ex->getMessage());
        }
    }

    public function toggle($id)
    {
        try {
            $status = $this->repository->toggle($id);

            if ($status['status']) {
                return ResponseHelper::responseSuccess([], $status['msg']);
            } else {
                return ResponseHelper::responseError([], $status['msg']);
            }
        } catch (\Exception $ex) {
            return ResponseHelper::responseError([], $ex->getMessage());
        }
    }

}
