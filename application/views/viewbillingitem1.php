<?php $this->load->view('includes/header');?>
<?php $this->load->view('includes/menu');?>   

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables/datatables.min.css')?>"/>

            <!-- Right side column. Contains the navbar and content of the page -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <button class="btn btn-success" onclick="add_customer()"><i class="glyphicon glyphicon-plus"></i> Add New Billing</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active">Billing</li>
      </ol>
    </section>






    <!-- Main content -->
    <section class="content container-fluid">

  <div class="row">  
<form method="POST" action="<?php echo site_url('Viewbillingitem1/datewise_report')?>" id="form">   
   <div class="col-sm-3">
        <h6>From Date:</h6>
        <div class="form-group">
          <input type="text" class="form-control" id="fdate" name="fdate" placeholder="From Date">
        </div>
      </div>
      <div class="col-sm-3">
        <h6>To Date:</h6>
        <div class="form-group">
          <input type="text" class="form-control" id="tdate" name="tdate" placeholder="To Date">
        </div>
      </div>
      <div class="col-sm-3">
        <div class="form-group">
          <br>
          <button type="submit" id="search" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
        </div>
      </div>
    </form>
    </div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Bill</h3>
            </div>
            <!-- /.box-header -->
<div class="box-body">   
  <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%" >
    <thead>
      <tr>
        <th>B_No</th>
        <th>Date</th>
        <th>Product</th>
        <th>Price</th>
        <th>Qty</th> 
        <th>Sub_Tot</th>
        <th>S GST(%)</th>
        <th>S GST Amt</th>
        <th>C GST(%)</th>
        <th>C GST Amt</th>
        <th>Total</th>   
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result as $row ) {?>
      <tr>
        <td><?php echo $row->b_id; ?></td>
        <td><?php echo $row->date; ?></td>
        <td><?php echo $row->pname; ?></td>
        <td><?php echo $row->s_price; ?></td>
        <td><?php echo $row->qty; ?></td>
        <td><?php echo $row->stot; ?></td>
        <td><?php echo $row->sgst; ?></td>
        <td><?php echo $row->sgst_amt; ?></td>
        <td><?php echo $row->cgst; ?></td>
        <td><?php echo $row->cgst_amt; ?></td>
        <td><?php echo $row->total; ?></td>        
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
        </div>


    </section>
  
</div>

       
 <?php $this->load->view('includes/footer');?>

<script src="<?php echo base_url('assets/datatables/datatables.min.js')?>"></script>

<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>


<script type="text/javascript">
    

$(document).ready(function()
{
    //datatables
   $('#table').DataTable({
                "dom": 'lBfrtip',
     "buttons": [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
    });

   // $('#table').DataTable({
   //              "dom": 'lBfrtip',
   //   "buttons": [
   //          {
   //              extend: 'collection',
   //              text: 'Export',
   //              buttons: [
   //                  'copy',
   //                  'excel',
   //                  'csv',
   //                  'pdf',
   //                  'print'
   //              ]
   //          }
   //      ]
   //  });

    $('#fdate').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        todayHighlight: true,
        // orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });
$('#tdate').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        todayHighlight: true,
        // orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });



});    

var table;
function add_customer()
{
window.location.href = "<?php echo site_url('Billing'); ?>";
}

function reload_table()
{
    table.ajax.reload(null, false); 
}
 
    
</script>



