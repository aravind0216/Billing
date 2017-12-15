<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller 
{
	function __Construct(){ 
        parent::__Construct(); 
        $this->load->database(); 
        $this->load->model('Purchase_model');    
     }

	public function index()
	{
        
		$this->load->model('Purchase_model');
		$data['values'] = $this->Purchase_model->get_count();
		$this->load->view('purchase',$data);

	}

	
	public function fetchProductData($productId)
	{
		$this->load->model('Purchase_model');
		$data = $this->Purchase_model->fetchProductData($productId);
		echo json_encode($data);
	}
	public function fetchSupplierData($SupplierID)
	{

		$this->load->model('Purchase_model');
		$data = $this->Purchase_model->fetchSupplierData($SupplierID);
		echo json_encode($data);
	}


    public function save1(){
        $status=1;
$insertdata = array(
  'p_id' => $this->input->post('pid'),
  'pdate' => date('Y-m-d', strtotime($this->input->post('pdate'))),
  'cname' => $this->input->post('cname'),
  'sname' => $this->input->post('sname'),
  'mobile' => $this->input->post('mobile'),
  'address' => $this->input->post('address'),
  'gstin' => $this->input->post('gstin'),
  'stot' => $this->input->post('subtot'),
  'sgst' => $this->input->post('sgst_tot'),
  'cgst' => $this->input->post('cgst_tot'),
  'tot' => $this->input->post('total'),
  'duedate' =>date('Y-m-d', strtotime($this->input->post('duedate'))),
  'mode' => $this->input->post('mode'),
  'advance' => $this->input->post('advance'),
  'balance' => $this->input->post('balance'),
  'status' => $status);

$this->load->model("Purchase_model");
$this->Purchase_model->insert_data($insertdata);


$phis1 = array(
  'p_id' => $this->input->post('pid'),
  'date' => $this->input->post('pdate'),
  'pay' => $this->input->post('advance'),
  'status' => $status);

$this->Purchase_model->addpay($phis1);

    

  $tc = $this->input->post('tc');
  for ($x=1; $x<$tc; $x++) 
    {
        $purchase_item = array(
          'p_id'     => $this->input->post('pid'),
          'pdate' => date('Y-m-d', strtotime($this->input->post('pdate'))),
          'product_id'   => $this->input->post('p_id'.$x),
          'pname'    => $this->input->post('pname'.$x),
          'p_price'    => $this->input->post('p_price'.$x),
          'qty'    => $this->input->post('qty'.$x),
          'stot'    => $this->input->post('stot'.$x),
          'sgst'    => $this->input->post('sgst'.$x),
          'sgst_amt'    => $this->input->post('sgst_amt'.$x),
          'cgst'    => $this->input->post('cgst'.$x),
          'cgst_amt'    => $this->input->post('cgst_amt'.$x),
          'total'    => $this->input->post('tot'.$x),
          'status'    => $status         
        );  

        $this->Purchase_model->insert_purchase_item($purchase_item); 

        $ppid = $this->input->post('p_id'.$x);
        $qty = $this->input->post('qty'.$x);
        $dat1 = $this->Purchase_model->getpro($ppid);
        foreach ($dat1 as $row) 
        { 
        $qty1 = $qty + $row->stock;

        $pro_up=array(
          'stock'     => $qty1,
        );  
        $this->Purchase_model->update_product_stock(array('id' => $this->input->post('p_id'.$x)), $pro_up);             
        }

    }


    $view1="Purchase Added Successfully";
       echo json_encode($view1);
}



    public function ajax_autocomplete(){
        $searchText = $_GET['term'];
        $availableResults = $this->Purchase_model->get_autocomplete_results($searchText);
        
        if(!empty($availableResults)){     
            $data['response'] = 'true'; //If username exists set true
            $data['message'] = array();       
            foreach ($availableResults as $key => $value) {                
                $data['message'][] = array(  
                    'label' => $value->cname,
                    'value' => $value->cname,
                    'id'=>$value->id
                );
            }        
        }else{
            $data['response'] = 'false';
        }
        
        echo json_encode($data); 
     }

     public function ajax_autocomplete1(){
        $searchText = $_GET['term'];
        $availableResults = $this->Purchase_model->get_autocomplete_results1($searchText);
        
        if(!empty($availableResults)){     
            $data['response'] = 'true'; //If username exists set true
            $data['message'] = array();       
            foreach ($availableResults as $key => $value) {                
                $data['message'][] = array(  
                    'label' => $value->p_name,
                    'value' => $value->p_name,
                    'pid'=>$value->id
                );
            }        
        }else{
            $data['response'] = 'false';
        }
        echo json_encode($data); 
     }
     
     


public function purchase_cancel($id)
{
  $this->load->model('Edit_purchase_model');
  $this->load->model('Purchase_model');

  $status=0;
                $status1=array(
                'status'     => $status,
                );
  $this->Edit_purchase_model->purchase_cancel(array('p_id' => $id), $status1);
  $this->Edit_purchase_model->purchase_item_cancel(array('p_id' => $id), $status1);
  $this->Edit_purchase_model->purchase_phis_cancel(array('p_id' => $id), $status1);

$dat11 = $this->Edit_purchase_model->getpurchase_item($id);
        foreach ($dat11 as $row1) 
        { 
        $pr_id=$row1->product_id;
        $pur_qty=$row1->qty;
        $pro_idqty = $this->Edit_purchase_model->getpro_qty($pr_id);

              foreach ($pro_idqty as $row2)  
              {
                $pur_qty1=$row2->stock - $pur_qty;
      
                $pro_up12=array(
                'stock'     => $pur_qty1,
                );
                $this->Edit_purchase_model->update_product_stock1(array('id' => $pr_id), $pro_up12);
              }
                     
        }
        
$view1="Purchase Return Successfully";
       echo json_encode($view1);

}  

// public function search()
//   {
//     $json = [];

//     $this->load->database();

    
//     if(!empty($this->input->get("q"))){
//       $this->db->like('cname', $this->input->get("q"));
//       $query = $this->db->select('id,cname as text')
//             ->limit(10)
//             ->get("supplier");
//       $json = $query->result();
//     }

    
//     echo json_encode($json);
//   }









// public function save1()
// {


// require_once 'db_connect.php';

// $valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// // print_r($valid);
// if($_POST) {  

//   $pdate            = date('Y-m-d', strtotime($_POST['pdate']));  
//   $p_id             = $_POST['pid'];
//   $cname            = $_POST['cname'];
//   $sname            = $_POST['sname'];
//   $mobile           = $_POST['mobile'];
//   $address          = $_POST['address'];
//   $stot             = $_POST['subtot'];
//   $sgst_tot         = $_POST['sgst_tot'];
//   $cgst_tot         = $_POST['cgst_tot'];
//   $tot              = $_POST['total'];
//   $duedate          = date('Y-m-d', strtotime($_POST['duedate']));
//   $mode             = $_POST['mode'];
//   $advance          = $_POST['advance'];
//   $balance          = $_POST['balance'];
//   $status           = 1;

        
//   $sql = "INSERT INTO purchase (p_id, pdate, cname, sname, mobile, address, stot, sgst_tot, cgst_tot, tot, duedate, mode, advance, balance, status) VALUES ($p_id,$pdate, $cname, $sname, $mobile, $address, '$stot', '$sgst_tot', '$cgst_tot', '$tot', '$duedate', $mode, '$advance', '$balance', $status)";
  
  
//   $order_id;
//   $orderStatus = false;
//   if($connect->query($sql) === true) {
//     $order_id = $connect->insert_id;
//     $valid['order_id'] = $order_id; 

//     $orderStatus = true;
//   }

    
//   // echo $_POST['productName'];
//   $orderItemStatus = false;

//   for($x = 0; $x < count($_POST['p_id']); $x++) {      
//     $updateProductQuantitySql = "SELECT product.stock FROM product WHERE product.id = ".$_POST['p_id'][$x]."";
//     $updateProductQuantityData = $connect->query($updateProductQuantitySql);
    
    
//     while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
//       $updateQuantity[$x] = $updateProductQuantityResult[0] + $_POST['stock'][$x];             
//         // update product table
//         $updateProductTable = "UPDATE product SET stock = '".$updateQuantity[$x]."' WHERE id = ".$_POST['p_id'][$x]."";
//         $connect->query($updateProductTable);

//         // add into order_item
//         $orderItemSql = "INSERT INTO purchase_item (id,p_id, product_id, pname, p_price, qty, stot, sgst, sgst_amt, cgst, cgst_amt, total, status) 
//         VALUES ('',$order_id', '".$_POST['p_id'][$x]."','".$_POST['p_name'][$x]."','".$_POST['p_price'][$x]."','".$_POST['qty'][$x]."', '".$_POST['stot'][$x]."', '".$_POST['sgst'][$x]."', '".$_POST['sgst_amt'][$x]."','".$_POST['cgst'][$x]."','".$_POST['cgst_amt'][$x]."','".$_POST['tot'][$x]."', 1)";

//         $connect->query($orderItemSql);   

//         if($x == count($_POST['p_id'])) {
//           $orderItemStatus = true;
//         }   
//     } // while  
//   } // /for quantity

//   $valid['success'] = true;
//   $valid['messages'] = "Successfully Added";    
  
//   $connect->close();

//   echo json_encode($valid);
 
// }

// }










}
