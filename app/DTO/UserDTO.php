<?php
namespace App\DTO;
use App\DTO\DTO;
class UserDTO extends DTO{
    private $user_id;//Indetificador Geral da Tabela event
    public function __construct(
        array $data
    ){
        $this->created(name: $data['name'], email: $data['email'], password: $data['password']);
    }

    public function setUserId(int $id) {
        $this->user_id = $id;
    }

    public function setName(string $name) {
        $this->DTO['name'] = $name;
    }

    public function setEmail(string $email) {
        $this->DTO['email'] = $email;
    }
    public function setPassword(string $password) {
        $this->DTO['password'] = $password;
    }

    public function user_ID() {
        return $this->user_id;
    }
    public function name():string {
        return $this->DTO['name'];
    }

    public function email():string {
        return $this->DTO['email'];
    }

    public function password():string {
        return $this->DTO['password'];
    }
}