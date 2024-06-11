<?php
namespace App\http\request;
use stdClass;
/**
 * Classe resposavel pelas requisições para o usuario
 */
class EventRequest {
    /**
     * Métodos responsavel por definir a requisição na criação de um usuário
     *
     * @param stdClass $param - dados enviados
     * @return array
     */
    static function createRequest(stdClass $param) {
        if(empty($param->name)) throw new \Exception("O campo nome deve ser preenchido!", 2);
        if(empty($param->description)) throw new \Exception("O campo Descrição deve ser preenchido!", 2);
     

        if(strlen($param->name) < 3) throw new \Exception("O campo nome deve ter pelo menos 3 caracteres!", 2);

        $result = ['name'=> $param->name, 'description'=> $param->description,
                    'date' => $param->date, 'vagas' => (int) $param->vagas,
                    'preco' => (float) $param->preco, 
                    'status' => 'open', 'event_id' => (int) $param->id
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

        if(strlen($param->name) < 3) throw new \Exception("O campo nome deve ter pelo menos 3 caracteres!", 2);
        if(strlen($param->password) < 3) throw new \Exception("O campo senha deve ter pelo menos 3 caracteres!", 2);

        $result = [ 'name'=> $param->name, 'descriprion'=> $param->description,
            'date' => $param->date, 'vagas' => (int) $param->vagas,
            'preco' => (float) $param->preco, 'status' => $param->status,
            'user_id' => (int) $param->userid, 'event_id' => (int) $param->eventid
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
        
        $result = [ 'name'=> '', 'descriprion'=> '',
            'date' => '', 'vagas' => null,
            'preco' => null, 'status' => '',
            'user_id' => (int) $param->userid, 'event_id' => (int) $param->eventid
        ];
        return $result;
    }

    static function loginRequest(stdClass $param) {
        if(empty($param->password)) throw new \Exception("O campo senha deve ser preenchido!", 2);
        if(empty($param->email)) throw new \Exception("O campo email deve ser preenchido!", 2);
        if(strlen($param->password) < 3) throw new \Exception("O campo senha deve ter pelo menos 3 caracteres!", 2);

        $result = ['email'=> $param->email, 'password' =>$param->password];
        return $result;
    }
}