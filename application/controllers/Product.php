<?php

class Product extends CI_Controller

{
	public function index()
	{
		$this->load->model('Product_model');
		$data['product'] = $this->Product_model->get_product();
		$this->load->view('product',$data);
    }
    Public function save()
    {
		$this->load->model('Product_model');
        	$data = array(
				'pro_id' => $this->input->post('pro_id'),
				'date' => date('Y-m-d', strtotime($this->input->post('date'))),
				'p_name' => $this->input->post('p_name'),
				'p_price' => $this->input->post('p_price'),
				'd_price' => $this->input->post('d_price'),
				'r_price' => $this->input->post('r_price'),
				'c_price' => $this->input->post('c_price'),
				'sgst' => $this->input->post('sgst'),
				'cgst' => $this->input->post('cgst'),
			);
			$this->Product_model->product($data);
			$data1 = "Successfully Added";	
		echo json_encode($data1);
  	}


public function ajax_list()
	{
		$this->load->helper('url');
		$this->load->model('Product_model');
		

		$list = $this->Product_model->get_product();
		$data = array();
		$no = 0;
		foreach ($list as $view) {
			$no++;
			$row = array();
			$row[] = $view->pro_id;
			$row[] = $view->p_name;
			$row[] = $view->p_price;
			$row[] = $view->d_price;
			$row[] = $view->r_price;
			$row[] = $view->c_price;
			$row[] = $view->stock;
			$row[] = $view->sgst;
			$row[] = $view->cgst;
			$row[] = '<button class="btn btn-warning" title="Edit" onclick="edit('."'".$view->id."'".')"><i class="glyphicon glyphicon-pencil"></i></button> <button class="btn btn-danger" title="Delete" onclick="product_delete('."'".$view->id."'".')"><i class="glyphicon glyphicon-trash"></i></button>';
		
			$data[] = $row;
		}

		$output = array(
						
						"data" => $data,
				);
		//output to json format
		echo json_encode($output) ;
	}

public function edit($id)
	{
		$this->load->model('Product_model');
		$data = $this->Product_model->get_by_id($id);
		echo json_encode($data);
	}
	public function update()
	{
		$this->load->model('Product_model');
		        	
        	$data = array(
        		'pro_id' => $this->input->post('pro_id'),
				'date' => date('Y-m-d', strtotime($this->input->post('date'))),
				'p_name' => $this->input->post('p_name'),
				'p_price' => $this->input->post('p_price'),
				'd_price' => $this->input->post('d_price'),
				'r_price' => $this->input->post('r_price'),
				'c_price' => $this->input->post('c_price'),
				'sgst' => $this->input->post('sgst'),
				'cgst' => $this->input->post('cgst'),
				
				//'birth_date' => $this->input->post('dob'),
				
			);
		$this->Product_model->update(array('id' => $this->input->post('id')), $data);
		$data1 = "Successfully Updated";	
		echo json_encode($data1);
	}
	public function delete_product($id)
	{
		$this->load->model("Product_model");
    	$this->Product_model->delete_by_id($id);
	//	$this->Product_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


    
}
?>