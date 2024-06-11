<?php
namespace App\http\controller;

require __DIR__."/../request/RequestEvent.php";
use App\model\Tickt;
use App\DTO\TicktDTO;
use App\http\request\TicktRequest;
use stdClass;
use Exception;

class TicktController {
    protected Tickt $repository;
    protected TicktDTO $DTO;

    public function __construct() {
        $this->repository = new Tickt();
    }

    public function index() {}
    
    public function create() {}

    public function store(stdClass $request) {
        try{
            $this->repository->transaction();
                $param = TicktRequest::createRequest($request);
                $this->initDTO($param);
                $this->repository->create($this->DTO);
            $this->repository->commit();
        }catch(Exception $e) {
            $this->repository->rollback();
            http_response_code(401);
            if($e->getCode() == "23000") return json_encode("Esse email já estar registrado");
            return json_encode($e->getMessage());
        }
    }
    
    public function update(stdClass $request) {
        try {
            $this->repository->transaction();
                $param =TicktRequest::updateRequest($request);
                $this->initDTO($param);//inicia o objeto DTO
                $this->DTO->setTicktId($param['event_id']);
                $this->DTO->setID($param['id']);
                $this->DTO->setBuyDate($param['buydate']);
                $this->repository->update($this->DTO);
            $this->repository->commit();
        }catch(Exception $e) {
            $this->repository->rollback();
            return $e->getMessage();
        }
    }
    
    public function show() {}

    public function destroy(stdClass $request) {}
    
    private function initDTO(array $data):void{
        $this->DTO = new TicktDTO($data);
    }
}