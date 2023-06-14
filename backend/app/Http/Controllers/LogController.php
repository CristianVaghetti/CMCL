<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Repository\LogRepository;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __construct(LogRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {
            $filtros = $request->toArray();
            $logs = $this->repository->search($filtros);

            return ResponseHelper::responseSuccess($logs->toArray(), "");
        } catch (\Exception $ex) {
            return ResponseHelper::responseError([], $ex->getMessage());
        }
    }
}
