<?php

class Header extends CI_Controller

{
	public function index()
	{
		$this->load->model('Header_model');
		$username = $this->session->userdata('user');
		$data['userid'] = $this->Header_model->get_user($username);
		$this->load->view('header',$data);
    }
   
    
}
?>