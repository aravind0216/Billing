<?php

class Viewpurchase extends CI_Controller

{
	public function index()
	{
		$this->load->model('Purchase_model');
		$this->load->view('viewpurchase');
    }
    
	public function ajax_list()
	{
		$this->load->helper('url');
		$this->load->model('Purchase_model');
		

		$list = $this->Purchase_model->get_purchase();
		$data = array();
		$no = 0;
		foreach ($list as $purchase_view) {
			$no++;
			$row = array();
			$row[] = $purchase_view->p_id;
			$row[] = $purchase_view->pdate;
			$row[] = $purchase_view->sname;
			$row[] = $purchase_view->mobile;
			$row[] = $purchase_view->address;
			$row[] = $purchase_view->stot;
			$row[] = $purchase_view->sgst;
			$row[] = $purchase_view->cgst;
			$row[] = $purchase_view->tot;
			$row[] = $purchase_view->advance;
			$row[] = $purchase_view->balance;
			$row[] = '<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="edit_purchase/fetch_purchase/'.$purchase_view->p_id.'"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	   
	    <li><a type="button" onclick="payment_edit('."'".$purchase_view->p_id."'".')"> <i class="glyphicon glyphicon-save"></i> Payment</a></li>

	    <li><a target="_blank" href="Purchase_print/fetch_print/'.$purchase_view->p_id.'"> <i class="glyphicon glyphicon-print"></i> Print</a></li>
	    <li><a type="button" id="removeOrderModalBtn" onclick="purchase_cancel('."'".$purchase_view->p_id."'".')"> <i class="glyphicon glyphicon-trash"></i> Return</a></li>
	           
	  </ul>
	</div>';
		
			$data[] = $row;
		}

		$output = array(
						
						"data" => $data,
				);
		//output to json format
		echo json_encode($output) ;
	}

	// <li><a type="button" id="removeOrderModalBtn" onclick="purchase_cancel('."'".$purchase_view->p_id."'".')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>

	Public function add_payment()
    {
		$this->load->model('Purchase_model');
	       	$data = array(
				'p_id' => $this->input->post('id'),
				'pay' => $this->input->post('pay'),
				'date' => $this->input->post('date'),
			);
		$this->Purchase_model->addpay($data);
			$data2 = array(
				'advance' => $this->input->post('paid1'),
				'balance' => $this->input->post('balance'),
			);

$this->Purchase_model->purchase_pay_update(array('p_id' => $this->input->post('id')), $data2);

		$data1 = "Payment Added";	
		echo json_encode($data1);
  	}

	public function edit_payment($id)
	{
		$this->load->model('Purchase_model');
		$data = $this->Purchase_model->purchase_payment_get_by_id($id);
		echo json_encode($data);
	}
	
	
}
?>