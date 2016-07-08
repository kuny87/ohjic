<?php

class Board_model extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    //total select sql
    public function gets($page, $search_word){

        if($search_word == null){
            $sql = "select * from board order by num desc LIMIT " . $page . ", 5";
        }else {
            $sql = "select * from board where title='" . $search_word ."' order by num desc LIMIT " . $page . ", 5";
        }

        $query = $this->db->query($sql);

        $row = $query->result();

        return $row;
    }

    //one select sql
    public function get($num){
        $this->db->select('num');
        $this->db->select('title');
        $this->db->select('content');
        $this->db->select('name');
        $this->db->select('UNIX_TIMESTAMP(created) AS created');
        return $this->db->get_where('board',array('num'=>$num))->result();
    }

    //insert sql
    public function add($title, $content, $name){

//        $this->db->set('created', 'NOW()', false);
//        $sql = "insert into board (title, content, name) VALUE ('".$title."', '".$content."', '".$name."')";
//        $this->db->query($sql);

        $this->db->set('created', 'NOW()', false);
        $this->db->insert('board', array(
            'title'=>$title,
            'content'=>$content,
            'name'=>$name
        ));
//
//        return $this->db->insert_id();
    }

    //pagination sql
//    public function boardGet_test($page_num){
//        //$sql = "select * from board_table order by num DESC";
//        //$query = $this->db->query($sql);
//
//        $sql = "select * from board order by num desc LIMIT ".$page_num. ", 5";
//        $query = $this->db->query($sql);
//
//
//        $row = $query->result();
//
//        return $row;
//
//    }


    //검색되어질 게시글 수
    public function total_cnt($search_word)
    {

        if ($search_word == null or $search_word == "") {
            $sql = "select count(num) as cnt from board";
        } else {
            $sql = "select count(num) as cnt from board where title='" . $search_word . "'";
        }

        $query = $this->db->query($sql);
        $row = $query->row();
        $result = $row->cnt;
        return $result;

    }


}