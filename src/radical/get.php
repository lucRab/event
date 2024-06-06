<?php
 namespace src\radical;

 class get extends sql
 {
    public $column = "*";
    public $param = null;

    public function __construct($n_table) {
        $this->table = $n_table;
    }

    public function all() {
        $this->column = "*";
        $this->param = null;
    }
 }
 