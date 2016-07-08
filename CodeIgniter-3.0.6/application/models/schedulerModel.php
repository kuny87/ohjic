<?php

class SchedulerModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    //현재달 일정 전체 불러오는 query
    public function scheduleGet($tbStrDate, $tbEndDate){

        $sql = "select * from scheduler where start_day BETWEEN '".$tbStrDate."' and '".$tbEndDate."'";

        $query = $this->db->query($sql);

        $row = $query->result();

        return $row;
    }

    //클릭한 일정 한개 불러오는 query
    public function scheduleOneGet($startDate){
        $this->db->select('num');
        $this->db->select('content');
        $this->db->select('startDate');
        $this->db->select('endDate');
        return $this->db->get_where('scheduler',array('startDate'=>$startDate))->result();
    }


    //일정 등록 query
    public function scheduleInsert($content, $strDate, $endDate) {
        $this->db->insert('scheduler', array(
            'content'=>$content,
            'start_day'=>$strDate,
            'end_day'=>$endDate
        ));

    }
}