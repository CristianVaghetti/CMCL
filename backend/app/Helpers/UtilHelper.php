<?php
namespace App\Helpers;
use App\Models\Log;

class UtilHelper {
    public static function mask ($val, $mask) {
        if(is_numeric($val)) {
            $maskared = '';
            $k = 0;
            for($i = 0; $i<=strlen($mask)-1; $i++)
            {
                if($mask[$i] == '#')
                {
                    if(isset($val[$k])){
                        $maskared .= $val[$k++];
                    }
                }
                else
                {
                    if(isset($mask[$i]))
                        $maskared .= $mask[$i];
                }
            }
            return $maskared;
        } else {
            return $val;
        }
    }

    public static function log($newValues, $oldObject, $descricao, $id, $table){
        if(isset($newValues['updated_at'])){
            unset($newValues['updated_at']);
        }

        if(isset($newValues['cnpj']) && $newValues['cnpj']){
            $newValues['cnpj'] = UtilHelper::mask($newValues['cnpj'], '##.###.###/####-##');
            $oldObject['cnpj'] = UtilHelper::mask($oldObject['cnpj'], '##.###.###/####-##');
        }

        $dados = null;
        if($newValues != null && $oldObject != null){
            $oldValues = [];
            foreach ($newValues as $key => $value) {
                $oldValues[$key] = $oldObject[$key];
            }
            
            $dados = [
                'antes' => $oldValues,
                'depois' => $newValues
            ];
        }

        $data = [
            'obj_id' => $id,
            'table' => $table,
            'descricao' => $descricao,
            'dados' => $dados != null ? json_encode($dados, JSON_UNESCAPED_UNICODE) : null
        ];
        
        if(Log::create($data)){
            return true;
        }

        return false;
    }
}