<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase_print extends CI_Controller 
{
	function __Construct(){ 
        parent::__Construct(); 
        $this->load->database(); 
        
        $this->load->model('Edit_purchase_model');    
     }

	public function fetch_print()
	{
        
	  $this->load->model('Edit_purchase_model');
      $bill_id=$this->uri->segment(3);
      $data['purchase']=$this->Edit_purchase_model->edit_purchase($bill_id);
      $data['purchase_item'] = $this->Edit_purchase_model->edit_purchase_item($bill_id);
           
      $this->load->view('purchase_print',$data);
	
	}
	public function fetch_print1()
	{
        
		$this->load->model('Edit_purchase_model');
      $bill_id=$this->Edit_purchase_model->get_purchase_lastid();
      // $id=$bill_id->p_id;
      foreach ($bill_id as $row) 
        { 
        	$id=$row->p_id;
        }
      $data['purchase']=$this->Edit_purchase_model->edit_purchase($id);
      $data['purchase_item'] = $this->Edit_purchase_model->edit_purchase_item($id);
           
      $this->load->view('purchase_print',$data);
	
	}

	
	
}
