<?php

class Fos extends CI_Controller

{
	
	public function index()
	{
		$this->load->model('Fos_model');
		$data['customer'] = $this->Fos_model->get_customer();
		$this->load->view('fos',$data);
    }
    Public function save()
    {
		$this->load->model('Fos_model');
	       	$data = array(
				'date' => date('Y-m-d', strtotime($this->input->post('date'))),
				'name' => $this->input->post('name'),
				'mobile' => $this->input->post('mobile'),
				'email' => $this->input->post('email'),
				'address' => $this->input->post('address'),
			);
	$this->Fos_model->customer($data);
		$data1 = "Successfully Added";	
			echo json_encode($data1);
  	}

public function ajax_list()
	{
		$this->load->helper('url');
		$this->load->model('Fos_model');
		

		$list = $this->Fos_model->get_customer();
		$data = array();
		$no = 0;
		foreach ($list as $customer_view) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $customer_view->date;
			$row[] = $customer_view->name;
			$row[] = $customer_view->mobile;
			$row[] = $customer_view->email;
			$row[] = $customer_view->address;
			$row[] = '<button class="btn btn-warning" title="Edit" onclick="edit_customer('."'".$customer_view->id."'".')"><i class="glyphicon glyphicon-pencil"></i></button>
				  <button class="btn btn-danger" title="Delete" onclick="delete_customer('."'".$customer_view->id."'".')"><i class="glyphicon glyphicon-trash"></i></button>';
		
			$data[] = $row;
		}

		$output = array(
						
						"data" => $data,
				);
		//output to json format
		echo json_encode($output) ;
	}

	public function customer_edit($id)
	{
		$this->load->model('Fos_model');
		$data = $this->Fos_model->get_by_id($id);
		echo json_encode($data);
	}
	public function update()
	{
		$this->load->model('Fos_model');
		        	
        	$data = array(
				'date' => date('Y-m-d', strtotime($this->input->post('date'))),
				'name' => $this->input->post('name'),
				'mobile' => $this->input->post('mobile'),
				'email' => $this->input->post('email'),
				'address' => $this->input->post('address'),
				
			);
		$this->Fos_model->customer_update(array('id' => $this->input->post('id')), $data);
		$data1 = "Successfully Updated";	
		echo json_encode($data1);
	}
	public function customer_delete($id)
	{
		$this->load->model("Fos_model");
    	$this->Fos_model->delete_by_id($id);
		//$this->Customer_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
    
}
?>