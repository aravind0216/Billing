<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_billing extends CI_Controller 
{
	function __Construct(){ 
        parent::__Construct(); 
        $this->load->database(); 
        $this->load->model('Edit_billing_model');    
     }


public function fetch_purchase(){

    $this->load->model('Edit_billing_model');
      $bill_id=$this->uri->segment(3);
      $data['purchase']=$this->Edit_billing_model->edit_billing($bill_id);
      $data['purchase_item'] = $this->Edit_billing_model->edit_billing_item($bill_id);

      // $dat11 = $this->Edit_billing_model->edit_billing_item($bill_id);
      //   foreach ($dat11 as $row1) 
      //   { 
      //   $pr_id=$row1->product_id;
      //   $data['stock1'] = $this->Edit_billing_model->getpro_qty($pr_id);

      //   }
// echo json_encode($data);           
      $this->load->view('edit_billing',$data);


  }


 

public function update(){

$status=1;
$insertdata = array(
  'b_id' => $this->input->post('pid'),
  'date' => date('Y-m-d', strtotime($this->input->post('pdate'))),
  'name' => $this->input->post('cname'),
  'role' => $this->input->post('role'),
  'mobile' => $this->input->post('mobile'),
  'address' => $this->input->post('address'),
  'gstin' => $this->input->post('gstin'),
  'stot' => $this->input->post('subtot'),
  'sgst' => $this->input->post('sgst_tot'),
  'cgst' => $this->input->post('cgst_tot'),
  'tot' => $this->input->post('total'),
  'duedate' =>date('Y-m-d', strtotime($this->input->post('duedate'))),
  'mode' => $this->input->post('mode'),
  'pmode' => $this->input->post('pmode'),
  'advance' => $this->input->post('advance'),
  'balance' => $this->input->post('balance'),
  'status' => $status);


$this->Edit_billing_model->purchase_update(array('b_id' => $this->input->post('pid')), $insertdata);

$this->Edit_billing_model->delete_by_id_phis($this->input->post('pid'));
$phis1 = array(
  'b_id' => $this->input->post('pid'),
  'date' => $this->input->post('pdate'),
  'pay' => $this->input->post('advance'),
  'status' => $status);

$this->Edit_billing_model->addpay($phis1);




        $ppid1 = $this->input->post('pid');
        $dat11 = $this->Edit_billing_model->getpurchase_item($ppid1);
        foreach ($dat11 as $row1) 
        { 
        $pr_id=$row1->product_id;
        $pur_qty=$row1->qty;
        $pro_idqty = $this->Edit_billing_model->getpro_qty($pr_id);

              foreach ($pro_idqty as $row2)  
              {
                $pur_qty1=$row2->stock + $pur_qty;
      
                $pro_up12=array(
                'stock'     => $pur_qty1,
                );
                $this->Edit_billing_model->update_product_stock1(array('id' => $pr_id), $pro_up12);
              }
                     
        }



$this->Edit_billing_model->delete_by_id_purchase_item($this->input->post('pid'));

       

$tc = $this->input->post('tc');
  for ($x=1; $x<$tc; $x++) 
    {
        $purchase_item = array(
          'b_id'     => $this->input->post('pid'),
          'date' => date('Y-m-d', strtotime($this->input->post('pdate'))),
          'product_id'   => $this->input->post('p_id'.$x),
          'pname'    => $this->input->post('pname'.$x),
          's_price'    => $this->input->post('p_price'.$x),
          'qty'    => $this->input->post('qty'.$x),
          'stot'    => $this->input->post('stot'.$x),
          'sgst'    => $this->input->post('sgst'.$x),
          'sgst_amt'    => $this->input->post('sgst_amt'.$x),
          'cgst'    => $this->input->post('cgst'.$x),
          'cgst_amt'    => $this->input->post('cgst_amt'.$x),
          'total'    => $this->input->post('tot'.$x),
          'status'    => $status         
        );  

        $this->Edit_billing_model->insert_purchase_item($purchase_item); 

        $ppid = $this->input->post('p_id'.$x);
        $qty = $this->input->post('qty'.$x);
        $dat1 = $this->Edit_billing_model->getpro($ppid);
        foreach ($dat1 as $row) 
        { 
        $qty1 = $row->stock - $qty;

        $pro_up=array(
          'stock'     => $qty1,
        );  
        $this->Edit_billing_model->update_product_stock(array('id' => $this->input->post('p_id'.$x)), $pro_up);             
        }

    }


  



  $view1="Bill Updated Successfully";
       echo json_encode($view1);


}



}
