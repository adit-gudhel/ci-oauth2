<?php
/**
* @package     PasswordCredentials.php
* @author      Aditya Nursyahbani
* @link        http://www.aditya-nursyahbani.net/2016/10/tutorial-oauth2-dengan-codeigniter.html
* @copyright   Copyright(c) 2016
* @version     1.0.0
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class PasswordCredentials extends CI_Controller {
    function __construct(){
        @session_start();
        parent::__construct();
        $this->load->library("Server", "server");
    }    

    function index(){
        $this->server->password_credentials();
    }
}
