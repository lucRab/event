<?php
namespace App\DTO;

class DTO {
    protected array $DTO;

    protected function created(...$args) {
        $this->DTO = $args;
    }
}
