<?php
namespace App\http\controller;

require __DIR__."/../request/RequestEvent.php";
use App\model\Event;
use App\http\request\EventRequest;
use App\DTO\EventDTO;
use stdClass;
use Exception;
class EventController {
    
    protected Event $repository;
    protected EventDTO $DTO;


    public function __construct() {
        $this->repository = new Event();
    }

    public function index() {}
    
    public function create() {}

    public function store(stdClass $request) {
        try{
            $this->repository->transaction();
                $param = EventRequest::createRequest($request);
                $this->initDTO($param);//inicia o objeto DTO
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
                $param = EventRequest::updateRequest($request);
                $this->initDTO($param);//inicia o objeto DTO
                $this->DTO->setEventId($param['event_id']);
                $this->repository->update($this->DTO);
            $this->repository->commit();
        }catch(Exception $e) {
            $this->repository->rollback();
            return $e->getMessage();
        }
    }
    public function show() {}

    public function destroy(stdClass $request) {
        try{
            $param = EventRequest::destroyRequest($request);
            $this->DTO->setEventId($param['event_id']);
            $this->DTO->setID($param['user_id']);
            $this->repository->update($this->DTO);
        }catch(Exception $e) {
            return $e->getMessage();
        }
    }

    private function initDTO(array $data):void{
        $this->DTO = new EventDTO($data);
    }
}