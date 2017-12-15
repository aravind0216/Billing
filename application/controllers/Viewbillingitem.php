<?php

class Viewbillingitem extends CI_Controller

{
	public function index()
	{
		$this->load->model('Billing_model');
		$this->load->view('viewbillingitem');
    }
    
	public function ajax_list()
	{
		$this->load->helper('url');
		$this->load->model('Billing_model');
		

		$list = $this->Billing_model->get_billingitem1();
		$data = array();
		$no = 0;
		foreach ($list as $purchase_view) {
			$no++;
			$row = array();
			$row[] = $purchase_view->b_id;
			$row[] = $purchase_view->date;
			$row[] = $purchase_view->pname;
			$row[] = $purchase_view->s_price;
			$row[] = $purchase_view->qty;
			$row[] = $purchase_view->stot;
			$row[] = $purchase_view->sgst;
			$row[] = $purchase_view->sgst_amt;
			$row[] = $purchase_view->cgst;
			$row[] = $purchase_view->cgst_amt;
			$row[] = $purchase_view->total;
							
			$data[] = $row;
		}

		$output = array(
						
						"data" => $data,
				);
		//output to json format
		echo json_encode($output) ;
	}

	
	
    
}
?>