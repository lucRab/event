<?php
namespace App\http\controller;

require __DIR__."/../request/RequestUser.php";

use App\http\request\UserRequest;
use App\http\controller\AuthController;
use App\model\User;
use App\DTO\UserDTO;
use Exception;
use src\radical\update;
use stdClass;
/**
 * Classe responsavel pelo controle do usuário
 */
class UserController {
    
    protected User $repository;
    protected UserDTO $DTO;
   /**
    * Método construtor da classe
    */
    public function __construct(){
        $this->repository = new User();
    }
    /**
     * Método responsavel por listar todos os usuários
     */
    public function index() {
        try{
            //$a = $this->repository->getAll();
            //return $a;
        }catch(Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * Método responsavel pela criação do usuário
     */
    public function store(stdClass $request) {
        try{
            //inicia a transação
            $this->repository->transaction();
                //-------------------------------------//
                $param = UserRequest::createRequest($request);//verificação dos dados
                $this->initDTO($param);//inicia o objeto DTO
                $this->repository->create($this->DTO);//realizar o insert
                $id = $this->DTO->user_ID();
                $param += ['iduser' => strval($id)];
                $token = AuthController::cadastroToken($param);
            $this->repository->commit();
            return json_encode($token);
        }catch(Exception $e){
            $this->repository->rollback();
            http_response_code(401);
            if($e->getCode() == "23000") return json_encode("Esse email já estar registrado");
            return json_encode($e->getMessage());
        }
    }
    /**
     * Método responsavel pela atualização dos dados do usuário
     */
    public function update(stdClass $request) {
        try {
            $this->repository->transaction();
            $param = UserRequest::updateRequest($request);
            $this->initDTO($param);//inicia o objeto DTO
            $this->DTO->setUserId($param['id']);
            $this->repository->update($this->DTO);
            $this->repository->commit();
        }catch(Exception $e) {
            var_dump($e->getMessage());
            $this->repository->rollback();
            return $e->getMessage();
        }
    }
    /**
     * Método resposavel pela deleção de usuário
     */
    public function destroy(stdClass $request) {
        try{
            $param = UserRequest::destroyRequest($request);
            $this->DTO->setUserId($param['id']);
            $this->repository->update($this->DTO);
        }catch(Exception $e) {
            return $e->getMessage();
        }
    }
 
    public function login(stdClass $request) {
        try{
            $param = UserRequest::loginRequest($request);
            $get = $this->repository->getLogin(['email' => $param['email']]);
            if(!password_verify($param['password'], $get['password'])) throw new Exception ('Senha incorreta');
            $token = AuthController::cadastroToken($get);

            return json_encode($token);
        }catch(Exception $e) {
            http_response_code(401);
            return json_encode($e->getMessage());
        }
    }
    private function initDTO(array $data):void{
        $this->DTO = new UserDTO($data);
    }
}