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






<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Add Payment</h3>
      </div>
      <div class="modal-body" id="add-brand-messages"></div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" id="id" name="id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="datepicker" name="date" value="<?php echo date("d-m-Y");?> ">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Total</label>
              <div class="col-md-9">
                <input readonly type="text" class="form-control" id="total" name="total" >
              </div>
            </div>  
            <div class="form-group">
              <label class="control-label col-md-3">Paid</label>
              <div class="col-md-9">
                <input disabled="true" type="text" class="form-control" id="paid" name="paid">
                <input type="hidden" class="form-control" id="paid1" name="paid1">
              </div>
            </div>
            <div id="hide_pay">
            <div class="form-group">
              <label class="control-label col-md-3">Remaining Pay</label>
              <div class="col-md-9">
                <input readonly type="text" name="balance1" id="balance1" class="form-control">
               </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">New Payment</label>
              <div class="col-md-9">
                <input onBlur="if(this.value=='') this.value='0'" onFocus="if(this.value =='0' ) this.value=''" value="0" type="text" name="pay" id="pay" class="form-control" onkeyup="advance1()" onchange="advance1()" >
               </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Balance</label>
              <div class="col-md-9">
                <input value="0" readonly type="text" name="balance" id="balance" class="form-control">
               </div>
            </div>
          </div>
 
          </div>
        </form>
          </div>
          <div id="hide_pay">
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Add Payment   </button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<!-- End Bootstrap modal -->








    <!-- Main content -->
    <section class="content container-fluid">

  <div class="row">  
<form method="POST" action="<?php echo site_url('Viewbilling1/datewise_report')?>" id="form">   
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
        <th>Name</th>
        <th>Mobile</th>
        <th>Address</th> 
        <th>Sub_Tot</th>
        <th>C GST</th>
        <th>S GST</th>
        <th>Total</th>
        <th>Paid</th>
        <th>Balance</th>
        <th>Action</th>   
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result as $row ) {?>
      <tr>
        <td><?php echo $row->b_id; ?></td>
        <td><?php echo $row->date; ?></td>
        <td><?php echo $row->name; ?></td>
        <td><?php echo $row->mobile; ?></td>
        <td><?php echo $row->address; ?></td>
        <td><?php echo $row->stot; ?></td>
        <td><?php echo $row->cgst; ?></td>
        <td><?php echo $row->sgst; ?></td>
        <td><?php echo $row->tot; ?></td>
        <td><?php echo $row->advance; ?></td>
        <td><?php echo $row->balance; ?></td>
        <td><div class="btn-group">
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Action <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="<?php echo base_url(); ?>edit_billing/fetch_purchase/<?php echo $row->b_id; ?>"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
     
      <li><a type="button" onclick="payment_edit(<?php echo $row->b_id; ?>)"> <i class="glyphicon glyphicon-save"></i> Payment</a></li>

      <li><a target="_blank" href="<?php echo base_url(); ?>Billing_print/fetch_print/<?php echo $row->b_id; ?>"> <i class="glyphicon glyphicon-print"></i> Print</a></li>
      <li><a type="button" id="removeOrderModalBtn" onclick="purchase_cancel(<?php echo $row->b_id; ?>)"> <i class="glyphicon glyphicon-trash"></i> Return</a></li>
             
    </ul>
  </div></td>
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

<script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

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
                    
                    'excel'
                    
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

$('#datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        todayHighlight: true,
        // orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });


});    

var table;



function advance1()
    {
      var total = Number($("#balance1").val());
      var advance=Number($("#pay").val());
      var pa=Number($("#paid").val());



       if(total >= advance)
       {
        var balance=Number(total) - Number(advance);
        var paid=Number(pa) + Number(advance);
        balance = balance.toFixed(2);
        paid = paid.toFixed(2);
        $("#balance").val(balance);
        $("#paid1").val(paid);
       }
       else
       {
          alert('Given Amount is high than Pay Amount');
          $("#pay").val('0');
          $("#balance").val('0');
       }

    }

function add_customer()
{
    // $(".text-danger").remove();
    // // remove the form error
    // $('.form-group').removeClass('has-error').removeClass('has-success');

    // $("#btnSave").html('Save');
    
    //   save_method = 'add';
    //   $('#form')[0].reset(); // reset form on modals
    //   $('#modal_form').modal('show'); // show bootstrap modal
    // //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title


window.location.href = "<?php echo site_url('Billing'); ?>";

}

function reload_table()
{
    table.ajax.reload(null, false); 
}
 
function payment_edit(id)
{
    $('#form')[0].reset(); // reset form on modals

    $("#btnSave").html('Add New Payment');
   
    //Ajax Load data from ajax

    $(".text-danger").remove();
    // remove the form error
    $('.form-group').removeClass('has-error').removeClass('has-success');

    $.ajax({
        url : "<?php echo site_url('viewbilling/edit_payment')?>/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.b_id);
            $('[name="total"]').val(data.tot);
            $('[name="paid"]').val(data.advance);
            $('[name="balance1"]').val(data.balance);
          
            if(data.balance==0)
            {
            $('#hide_pay').hide();
            $('#hide_pay1').hide();
            }
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Add Payment'); // Set title to Bootstrap modal title


            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}   




function purchase_cancel(id)
{
    if(confirm('Are you sure Cancel this Bill?'))
    {
        // ajax delete data to database

        $.ajax({
            url : "<?php echo site_url('Billing/purchase_cancel')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                alert('Bill No: ' +id+ ' Return Sucessfully');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}



function save()
    {
      
$(".text-danger").remove();
    // remove the form error
    $('.form-group').removeClass('has-error').removeClass('has-success');
    var pay = $("#pay").val();
    
    if(pay == "0") 
    {
      $("#pay").after('<p class="text-danger">Enter Payment</p>');
      $('#pay').closest('.form-group').addClass('has-error');
    }
    else
    {
      // remov error text field
      $("#pay").find('.text-danger').remove();
      // success out for form 
      $("#pay").closest('.form-group').addClass('has-success');     
    }
    
    
    if(pay)
      {
      $.ajax({
            url : "<?php echo site_url('Viewbilling/add_payment')?>",
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success:function(data)
            {
        
         // reset the form text
         $("#form")[0].reset();
         // reload_table();
         //   // remove the error text
         $(".text-danger").remove();
         //   // remove the form error
         $('.form-group').removeClass('has-error').removeClass('has-success');
            
         $('#add-brand-messages').html('<div class="alert alert-success">'+
         '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
         '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ data +
         '</div>');

         $(".alert-success").delay(500).show(10, function()
         {
         $(this).delay(3000).hide(10, function() 
            {
            $(this).remove();
            });
         }); // /.alert
   


            },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
            


          });
        }
    
}


    
</script>



