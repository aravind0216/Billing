<?php

class Viewbilling extends CI_Controller

{
	public function index()
	{
		$this->load->model('Billing_model');
		$this->load->view('viewbilling');
    }
    
	public function ajax_list()
	{
		$this->load->helper('url');
		$this->load->model('Billing_model');
		

		$list = $this->Billing_model->get_purchase();
		$data = array();
		$no = 0;
		foreach ($list as $purchase_view) {
			$no++;
			$row = array();
			$row[] = $purchase_view->b_id;
			$row[] = $purchase_view->date;
			$row[] = $purchase_view->name;
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
	    <li><a href="edit_billing/fetch_purchase/'.$purchase_view->b_id.'"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	   
	    <li><a type="button" onclick="payment_edit('."'".$purchase_view->b_id."'".')"> <i class="glyphicon glyphicon-save"></i> Payment</a></li>

	    <li><a target="_blank" href="Billing_print/fetch_print/'.$purchase_view->b_id.'"> <i class="glyphicon glyphicon-print"></i> Print</a></li>
	    <li><a type="button" id="removeOrderModalBtn" onclick="purchase_cancel('."'".$purchase_view->b_id."'".')"> <i class="glyphicon glyphicon-trash"></i> Return</a></li>
	           
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
		$this->load->model('Billing_model');
	       	$data = array(
				'b_id' => $this->input->post('id'),
				'pay' => $this->input->post('pay'),
				'date' => $this->input->post('date'),
			);
		$this->Billing_model->addpay($data);
			$data2 = array(
				'advance' => $this->input->post('paid1'),
				'balance' => $this->input->post('balance'),
			);

$this->Billing_model->purchase_pay_update(array('b_id' => $this->input->post('id')), $data2);

		$data1 = "Payment Added";	
		echo json_encode($data1);
  	}

	public function edit_payment($id)
	{
		$this->load->model('Billing_model');
		$data = $this->Billing_model->purchase_payment_get_by_id($id);
		echo json_encode($data);
	}
	
	// public function purchase_cancel($id)
	// {
	// 	$this->load->model("Edit_purchase_model");
 //    	// $this->Purchase_model->delete_by_id($id);


	// 	$dat11 = $this->Edit_purchase_model->getpurchase_item($id);
 //        foreach ($dat11 as $row1) 
 //        { 
 //        $pr_id=$row1->product_id;
 //        $pur_qty=$row1->qty;
 //        $pro_idqty = $this->Edit_purchase_model->getpro_qty($pr_id);

 //              foreach ($pro_idqty as $row2)  
 //              {
 //                $pur_qty1=$row2->stock - $pur_qty;
      
 //                $pro_up12=array(
 //                'stock'     => $pur_qty1,
 //                );
 //                $this->Edit_purchase_model->update_product_stock1(array('id' => $pr_id), $pro_up12);
 //              }
                     
 //        }


	// 	//$this->Customer_model->delete_by_id($id);
	// 	echo json_encode(array("status" => TRUE));
	// }
    
}
?>