<?php

class Supplier extends CI_Controller

{
	public function index()
	{
		$this->load->model('Supplier_model');
		$data['supplier'] = $this->Supplier_model->get_supplier();
		$this->load->view('supplier',$data);
    }
    Public function save()
    {
		$this->load->model('Supplier_model');
		
        	
        	$data = array(
				'date' => date('Y-m-d', strtotime($this->input->post('date'))),
				'cname' => $this->input->post('cname'),
				'name' => $this->input->post('name'),
				'mobile' => $this->input->post('mobile'),
				'email' => $this->input->post('email'),
				'address' => $this->input->post('address'),
				'gstin' => $this->input->post('gstin'),
				
			);
			$this->Supplier_model->supplier($data);

			$data1 = "Supplier Added Successfully";
			
			echo json_encode($data1);
  
	}



public function ajax_list()
	{
		$this->load->helper('url');
		$this->load->model('Supplier_model');
		

		$list = $this->Supplier_model->get_supplier();
		$data = array();
		$no = 0;
		foreach ($list as $view) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $view->date;
			$row[] = $view->cname;
			$row[] = $view->name;
			$row[] = $view->mobile;
			$row[] = $view->email;
			$row[] = $view->address;
			$row[] = '<button class="btn btn-warning" title="Edit" onclick="edit('."'".$view->id."'".')"><i class="glyphicon glyphicon-pencil"></i></button>
			<button class="btn btn-danger" title="Delete" onclick="supplier_delete('."'".$view->id."'".')"><i class="glyphicon glyphicon-trash"></i></button>';
		
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
		$this->load->model('Supplier_model');
		$data = $this->Supplier_model->get_by_id($id);
		echo json_encode($data);
	}
	public function update()
	{
		$this->load->model('Supplier_model');
		        	
        	$data = array(
				'date' => date('Y-m-d', strtotime($this->input->post('date'))),
				'name' => $this->input->post('name'),
				'cname' => $this->input->post('cname'),
				'mobile' => $this->input->post('mobile'),
				'email' => $this->input->post('email'),
				'address' => $this->input->post('address'),
				'gstin' => $this->input->post('gstin'),
				
			);
		$this->Supplier_model->update(array('id' => $this->input->post('id')), $data);
		$data1 = "Successfully Updated";	
		echo json_encode($data1);
	}
	public function supplier_delete($id)
	{
		$this->load->model("Supplier_model");
    	$this->Supplier_model->delete_by_id($id);
		//$this->Supplier_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
    
}
?>