<?php

class Viewbillingitem1 extends CI_Controller

{
	public function datewise_report()
	{
		$this->load->model('Billing_model');

		$date1 = date('Y-m-d', strtotime($this->input->post('fdate')));
     	$date2 = date('Y-m-d', strtotime($this->input->post('tdate')));
		$data['result'] = $this->Billing_model->get_report1($date1,$date2);
		$this->load->view('viewbillingitem1',$data);
    }
    
	
}
?>