<?php

class Viewpurchase1 extends CI_Controller

{
	public function datewise_report()
	{
		$this->load->model('Purchase_model');

		$date1 = date('Y-m-d', strtotime($this->input->post('fdate')));
     	$date2 = date('Y-m-d', strtotime($this->input->post('tdate')));
		$data['result'] = $this->Purchase_model->get_report($date1,$date2);
		$this->load->view('viewpurchase1',$data);
    }
    
	
}
?>