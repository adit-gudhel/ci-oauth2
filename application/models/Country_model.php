<?php
/**
* @package     Country_model.php
* @author      Aditya Nursyahbani
* @link        http://www.aditya-nursyahbani.net/2016/10/tutorial-oauth2-dengan-codeigniter.html
* @copyright   Copyright(c) 2016
* @version     1.0.0
**/

defined('BASEPATH') OR exit('No direct script access allowed');
 
class Country_model extends CI_Model {

	function get($id){
        return $this->db->get_where('country', array('id' => $id))->row_array();
        
	} 

	function get_all(){
        return $this->db->get('country')->result_array();
	} 

}