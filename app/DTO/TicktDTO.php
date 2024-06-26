<?php
namespace App\DTO;
use App\DTO\DTO;
class TicktDTO extends DTO{
    private int $tickt_id;//Indenticador Geral da Tabela tickt
    private int $id;//Indentificador UUID
    private string $buy_date;//Data da compra de ingresso
    
    public function __construct(
        array $data
    ) {
        $this->created(user_id: $data['userid'], event_id: $data['eventid']);
    }

    public function setTicktId($id) {
        $this->tickt_id = $id;
    }
    public function setID($UUID) {
        $this->id = $UUID;
    }
    public function setBuyDate($date){
        $this->buy_date = $date;
    }
    public function ticktID():int {
        return $this->tickt_id;
    }
    public function ID():string {
        return $this->id;
    }
    public function buyDate():string{
        return $this->buy_date;
    }
    public function userID():int {
        return $this->DTO['user_id'];
    }
    public function eventID():int {
        return $this->DTO['event_id'];
    }
}