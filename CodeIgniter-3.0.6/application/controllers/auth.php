<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends MY_Controller {
    function __construct()
    {
        parent::__construct();
    }

    function login(){
        $this->_head();
        $this->_footer();
    }

    function logout(){

    }

    function authentication(){

    }

}