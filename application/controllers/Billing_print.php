<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing_print extends CI_Controller 
{
	function __Construct(){ 
        parent::__Construct(); 
        $this->load->database(); 
        
        $this->load->model('Edit_billing_model');    
     }

	public function fetch_print()
	{
        
	  $this->load->model('Edit_billing_model');
      $bill_id=$this->uri->segment(3);
      $data['purchase']=$this->Edit_billing_model->edit_billing($bill_id);
      $data['purchase_item'] = $this->Edit_billing_model->edit_billing_item($bill_id);
           
      $this->load->view('billing_print',$data);
	
	}
	public function fetch_print1()
	{
        
		$this->load->model('Edit_billing_model');
      $bill_id=$this->Edit_billing_model->get_billing_lastid();
      // $id=$bill_id->p_id;
      foreach ($bill_id as $row) 
        { 
        	$id=$row->b_id;
        }
      $data['purchase']=$this->Edit_billing_model->edit_billing($id);
      $data['purchase_item'] = $this->Edit_billing_model->edit_billing_item($id);
           
      $this->load->view('billing_print',$data);
	
	}

	
	
}
