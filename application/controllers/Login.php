<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view("login");
	}

	public function login_validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('userid','Enter UserName','required');
		$this->form_validation->set_rules('password','Enter Password','required');
		
		if($this->form_validation->run())
		{
			$user= $this->input->post('userid');
			$pass= $this->input->post('password');
			$this->load->model('login_model');
			if($this->login_model->login($user,$pass))
			{
				
				$session_data=array('user'=>$user);
				$this->session->set_userdata($session_data);

				redirect(base_url().'Login/enter');
			}
			else
			{
				$this->session->set_flashdata('error','Invalid Username and Password');
				redirect(base_url().'Login/index');
			}
		}
		else
		{
			$this->index();
		}
		
	}
	function enter()
	{
		if($this->session->userdata('user')!='')
		{
			$this->load->view('dashboard');
		}
		else
		{
			redirect(base_url().'Login/index');
		}
	}
	function logout()
	{
		$this->session->unset_userdata('user');
		redirect(base_url().'Login/index');
	}
	function forget_pass()
	{
		$this->load->model('login_model');

		$email = $this->input->post('email');
		$data1 = $this->login_model->forget_pass($email);

            // $data['response'] = 'true'; //If username exists set true
            foreach ($data1 as $key => $value) {                
                $data[] = $value->pass;
                
            }        
        
        
        echo json_encode($data);
    }
	
}