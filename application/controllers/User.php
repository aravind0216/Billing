<?php

class User extends CI_Controller

{
	
	public function index()
	{
		$this->load->model('User_model');
		$data['user'] = $this->User_model->get_user();
		$username = $this->session->userdata('user');
		$data['userid'] = $this->User_model->get_single_user($username);
		$this->load->view('user',$data);
    }
    public function check_user()
	{
		$user = $this->input->post('user');
    	$this->load->model('User_model');
      	$get_result = $this->User_model->filename_exists($user);

        if(!$get_result )
            echo '<span style="color:#f00">Username already in use. </span>';
        else
            echo '<span style="color:#00c">Username Available</span>';
	}
    Public function save()
    {


		$this->load->model('User_model');

		
			if(!empty($_FILES['userimage']['name']))
			{
                $config['upload_path'] = 'uploads/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['userimage']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('userimage')){
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }else{
                    $picture = '';
                }
            }else{
                $picture = '';
            }


	       	$data = array(
				'user' => $this->input->post('user'),
				'pass' => $this->input->post('pass'),
				'name' => $this->input->post('name'),
				'mobile' => $this->input->post('mobile'),
				'email' => $this->input->post('email'),
				'role' => $this->input->post('role'),
				'user_img' => $picture
			);
	$this->User_model->user($data);
		$data1 = "Successfully Added";	
			echo json_encode($data1);
  	}

public function ajax_list()
	{
		$this->load->helper('url');
		$this->load->model('User_model');
		

		$list = $this->User_model->get_user();
		$data = array();
		$no = 0;
		foreach ($list as $user) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $user->name;
			$row[] = $user->user;
			$row[] = $user->pass;
			$row[] = $user->mobile;
			$row[] = $user->email;
			$row[] = $user->role;
			$row[] = '<button class="btn btn-warning" title="Edit" onclick="edit_user('."'".$user->id."'".')"><i class="glyphicon glyphicon-pencil"></i></button>';
		
			$data[] = $row;
		}

		$output = array(
						
						"data" => $data,
				);
		//output to json format
		echo json_encode($output) ;
	}

	public function user_edit($id)
	{
		$this->load->model('User_model');
		$data = $this->User_model->get_by_id($id);
		echo json_encode($data);
	}
	public function update()
	{
		$this->load->model('User_model');


		if(!empty($_FILES['userimage']['name']))
		{
                $config['upload_path'] = 'uploads/images/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['userimage']['name'];
                
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('userimage'))
                {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                }
                else
                {
                    $picture = '';
                }
        }
        else
        {
            $picture = '';
        }
		        	
        	$data = array(
				'user' => $this->input->post('user'),
				'pass' => $this->input->post('pass'),
				'name' => $this->input->post('name'),
				'mobile' => $this->input->post('mobile'),
				'email' => $this->input->post('email'),
				'role' => $this->input->post('role'),
				'user_img' => $picture
				
			);
		$this->User_model->user_update(array('id' => $this->input->post('id')), $data);
		$data1 = "Successfully Updated";	
		echo json_encode($data1);
	}
	public function user_delete($id)
	{
		$this->load->model("User_model");
    	$this->User_model->delete_by_id($id);
		//$this->User_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
    
}
?>