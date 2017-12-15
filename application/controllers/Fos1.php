<?php

class Fos1 extends CI_Controller

{
	
	public function index()
	{
		$this->load->model('Fos1_model');
		$data['fos1'] = $this->Fos1_model->get_fos();
		$this->load->view('fos1',$data);
    }
    Public function save()
    {
		$this->load->model('Fos1_model');
	       	$data = array(
				'date' => date('Y-m-d', strtotime($this->input->post('date'))),
				'name' => $this->input->post('name'),
				'credit' => $this->input->post('credit'),
				'debit' => $this->input->post('debit'),
				'balance' => $this->input->post('balance'),
			);
	$this->Fos1_model->customer($data);
		$data1 = "Successfully Added";	
			echo json_encode($data1);
  	}

public function ajax_list()
	{
		$this->load->helper('url');
		$this->load->model('Fos1_model');
		
		$date1 = date('Y-m-d');
		
		$list = $this->Fos1_model->get_customer($date1);
		$data = array();
		$no = 0;
		foreach ($list as $customer_view) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $customer_view->date;
			$row[] = $customer_view->name;
			$row[] = $customer_view->credit;
			$row[] = $customer_view->debit;
			$row[] = $customer_view->balance;
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
		$this->load->model('Fos1_model');
		$data = $this->Fos1_model->get_by_id($id);
		echo json_encode($data);
	}
	public function update()
	{
		$this->load->model('Fos1_model');
		        	
        	$data = array(
				'date' => date('Y-m-d', strtotime($this->input->post('date'))),
				'name' => $this->input->post('name'),
				'credit' => $this->input->post('credit'),
				'debit' => $this->input->post('debit'),
				'balance' => $this->input->post('balance'),
				
			);
		$this->Fos1_model->customer_update(array('id' => $this->input->post('id')), $data);
		$data1 = "Successfully Updated";	
		echo json_encode($data1);
	}
	public function customer_delete($id)
	{
		$this->load->model("Fos1_model");
    	$this->Fos1_model->delete_by_id($id);
		//$this->Customer_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}



	public function ajax_autocomplete(){
        $searchText = $_GET['term'];
        $availableResults = $this->Fos1_model->get_autocomplete_results($searchText);
         
        if(!empty($availableResults)){     
            $data['response'] = 'true'; //If username exists set true
            $data['message'] = array();       
            foreach ($availableResults as $key => $value) {                
                $data['message'][] = array(  
                    'label' => $value->name,
                    'value' => $value->name,
                    'id'=>$value->id
                );
            }        
        }else{
            $data['response'] = 'false';
        }
        
        echo json_encode($data); 
     }
    
}
?>