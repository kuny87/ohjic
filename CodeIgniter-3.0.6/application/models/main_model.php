<?php

class Main_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    public function gets(){
        return $this->db->query('select * from main_list') -> result();
    }
}

?>