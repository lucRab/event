<?php
namespace App\http\controller;

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
    
    public function update() {}
    public function show() {}

    private function initDTO(array $data):void{
        $this->DTO = new EventDTO($data);
    }
}