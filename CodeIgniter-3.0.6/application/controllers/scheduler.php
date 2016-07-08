<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scheduler extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('schedulerModel');

    }

    function index(){

        $this->load->view('scheduler_view');

    }

    //일정 등록하기
    function scheduleSet(){

        $this->load->model("schedulerModel");
        $this->schedulerModel->scheduleInsert($this->input->post('content'), $this->input->post('strDate'), $this->input->post('endDate'));
//        $this->load->helper('url');
//        redirect('http://mma.qfun.kr/scheduler');
    }


    //일정 불러오기 json_view
    public function scheduleGET(){

        //model
        $this->load->model('schedulerModel');
        $obj = $this->schedulerModel->scheduleGet($this->input->post('tbStrDate'), $this->input->post('tbEndDate')); //현재달 일정 전체 데이터
        echo json_encode($obj, JSON_UNESCAPED_UNICODE); // json형식으로 데이터를 view에 뿌려줌
    }


//    public function scheduleOneGET($startDate){
//
//        $data['lists'] = $this->board_model->get($startDate);
//
//        $this->load->view('schedule_select', $data);
//    }

}


