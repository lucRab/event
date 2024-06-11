<?php
namespace App\http\request;
use stdClass;
/**
 * Classe resposavel pelas requisições para o usuario
 */
class TicktRequest {
    /**
     * Métodos responsavel por definir a requisição na criação de um usuário
     *
     * @param stdClass $param - dados enviados
     * @return array
     */
    static function createRequest(stdClass $param) {
        if(empty($param->eventid)) throw new \Exception("Ops!! algo estar errado, por favor atualize a página e tente novamente", 2);
        if(empty($param->userid)) throw new \Exception("Ops!! Erro de autenticação!", 2);   

        $result = ['event'=> (int) $param->eventid, 
                    'user'=> (int) $param->userid
                  ];
        return $result;
    }
    /**
     * Métodos responsavel por definir a requisição na atualização de um usuário
     *
     * @param stdClass $param - dados enviados
     * @return array
     */
    static function updateRequest(stdClass $param) {

       
        if(empty($param->eventid)) throw new \Exception("Ops!! algo estar errado, por favor atualize a página e tente novamente", 2);
        if(empty($param->userid)) throw new \Exception("Ops!! Erro de autenticação!", 2);
    
        $result = ['event'=> (int) $param->eventid, 
                    'user'=> (int) $param->userid,
                    'tickt'=> (int) $param->ticktid,
                    'id' => $param->id,
                    'buydate' => $param->buydate,
                   ];
        return $result;
    }
    /**
     * Métodos responsavel por definir a requisição na deleção de um usuário
     *
     * @param stdClass $param - dados enviados
     * @return array
     */
    static function destroyRequest(stdClass $param ) {

        if(empty($param->eventid)) throw new \Exception("Ops!! algo estar errado, por favor atualize a página e tente novamente", 2);
        if(empty($param->userid)) throw new \Exception("Ops!! Erro de autenticação!", 2);

        $result = ['event'=> (int) $param->eventid, 
                    'user'=> (int) $param->userid
                  ];
        return $result;
    }
}