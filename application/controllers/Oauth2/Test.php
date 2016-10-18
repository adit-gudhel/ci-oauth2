<?php
/**
* @package     Test.php
* @author      Aditya Nursyahbani
* @link        http://www.aditya-nursyahbani.net/2016/10/tutorial-oauth2-dengan-codeigniter.html
* @copyright   Copyright(c) 2016
* @version     1.0.0
**/

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
    function __construct(){
        @session_start();
        parent::__construct();
    }

    function index(){
    	$this->load->view("oauth2/api");
    }

}
