<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('form');

	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

//	function Welcome()
//	{
//		parent::CI_Controller();
//
//	}
	public function index()
	{
		$this->load->database();
		$this->load->model('topic_model');
		$data = $this->topic_model->getS();
		$this->showBoardList();
	}


	public function showBoardList()
	{
		$data['title'] = "My Blog Title";
		$data['heading'] = "My Blog Heading";
		$data['query'] = array('clean house', 'eat lunch', 'call mom');


		$this->load->view('blog_view', $data);
	}

	function comments()
	{
		$data['title'] = "My Comment Title";
		$data['heading'] = "My Comment Heading";
//		$this->db->where('entry_id', $this->uri->segment(3));
//		$data['query'] = $this->db->get('comments');

		$this->load->view('comment_view', $data);
	}

	function comment_insert()
	{
		echo 'testing 1, 2, 3';
//		$this->db->insert('comments', $_POST);
//
//		redirect('blog/comments/'.$_POST['entry_id']);
	}


}

?>