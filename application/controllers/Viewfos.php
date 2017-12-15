<?php

class Viewfos extends CI_Controller

{


	
	public function datewise_report()
	{
		$this->load->model('Fos1_model');
		$data['fos1'] = $this->Fos1_model->get_fos();


		$date1 = date('Y-m-d', strtotime($this->input->post('fdate')));
     	$date2 = date('Y-m-d', strtotime($this->input->post('tdate')));
		$data['result'] = $this->Fos1_model->get_report1($date1,$date2);
		$this->load->view('viewfos',$data);
    }
    
	
}
?>