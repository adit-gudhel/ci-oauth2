<?php
/**
* @package     Api.php
* @author      Aditya Nursyahbani
* @link        http://www.aditya-nursyahbani.net/2016/10/tutorial-oauth2-dengan-codeigniter.html
* @copyright   Copyright(c) 2016
* @version     1.0.0
**/

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');
 
class Api extends REST_Controller {

	function __construct(){
        @session_start();
        parent::__construct();
        $this->load->library("Server", "server");
    	$this->server->require_scope("country");

        $this->load->database('oauth');
    	$this->load->model('country_model');
    }

	function country_get(){
		if(!$this->get('id')) {
            $this->response(NULL, 400);
        }
 
        $country = $this->country_model->get($this->get('id'));
         
        if($country) {
            $this->response($country, 200); // 200 being the HTTP response code
        } else {
            $this->response(NULL, 404);
        }
	} 

	function countries_post(){
		$country = $this->country_model->get_all();
         
        if($country) {
            $this->response($country, 200); // 200 being the HTTP response code
        } else {
            $this->response(NULL, 404);
        }
	} 

}