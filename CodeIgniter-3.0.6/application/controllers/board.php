<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Board extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('main_model');
        $this->load->model('board_model');
    }

    function index(){
        $this->_head();
        $this->_sidebar();
        $this->load->view('main');
    }

    function login(){
        $this->_head();
        $this->_sidebar();
        $this->load->view('login');
    }

    //ajax 호출
    public function get($page=0){

        $this->_head();
        $this->_sidebar();
        $this->load->helper(array('url','HTML', 'korean'));

        $search_word = null;
        if($this->input->get("search_word") != null){

            $search_word = $this->input->get("search_word");
            $config['reuse_query_string'] = true;

        }


        //검색되어질 게시글 수
        $this->load->model('board_model');
        $total_cnt = $this->board_model->total_cnt($search_word);


        //테이블 데이터 불러오기
//        $data['res'] = $this->board_model->boardGet_test($page);

        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = '/board/get/';
        $config['total_rows'] = $total_cnt; //페이지 전체 레코드수
        $config['per_page'] = 5;      //1페이지에 보여질 숫자.(1페이지당 5개)

        //pagination 꾸미기
//        $config['num_links'] = 1;
//
//        $config['next_tag_open'] = '<span id="next">';
//        $config['next_tag_close'] = '</span>';
//        $config['prev_tag_open'] = '<span id="prev">';
//        $config['prev_tag_close'] = '</span>';
//
//
//        $config['next_link'] = "<button type='button' class='btn btn-info btn-xs'>Next</button>";  //다음으로
//        $config['prev_link'] = "<button type='button' class='btn btn-info btn-xs'>Prev</button>";  //이전으로
//        $config['full_tag_open'] = '<div id="pagination">';
//        $config['full_tag_close'] = '</div>';


        $this->pagination->initialize($config);

        $data['link'] = $this->pagination->create_links(); //페이지네이션 링크
        $data['page'] = $page; //현재 페이지
        $data['search_word'] = $search_word; //검색어

        //view
        $this->load->view("board_list", $data);
    }


    //json_view
    public function get_json($search_word=null){

        if($this->input->get("page") != null || $this->input->get("page") != 0){
            $page = $this->input->get("page");
        }

        $aa = $this->input->get("search_word");

        if($this->input->get("search_word") != null){
            $search_word = $this->input->get("search_word");
        }

        //model
        $this->load->model('board_model');

        $obj = $this->board_model->gets($page, $search_word); //게시글 전체 데이터
        echo json_encode($obj, JSON_UNESCAPED_UNICODE); // json형식으로 데이터를 view에 뿌려줌
    }


    public function get_one($num){
        $this->_head();
        $this->_sidebar();

        $data['lists'] = $this->board_model->get($num);

        $this->load->view('board_select', $data);
//        $lists = $this->board_model->gets();
//        $this->load->view('board_list', array('lists'=>$lists));
    }

    function Write(){
        $this->_head();
        $this->_sidebar();

        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', '제목', 'required');
        $this->form_validation->set_rules('content', '본문', 'required');
        $this->form_validation->set_rules('name', '이름', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('board_write');
        }
        else
        {
            $this->load->model("board_model");
            $this->board_model->add($this->input->post('title'), $this->input->post('content'), $this->input->post('name'));
            $this->load->helper('url');
            redirect('http://mma.qfun.kr/board/get');
        }
    }

    function _head(){
        $this->load->config('opentutorials');
        $this->load->view('board_head');
    }

    function _sidebar(){
        $lists = $this->main_model->gets();
        $this->load->view('main_list', array('lists'=>$lists));
    }


}