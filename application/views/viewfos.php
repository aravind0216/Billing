<?php $this->load->view('includes/header');?>
<?php $this->load->view('includes/menu');?>   
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables/datatables.min.css')?>"/>


            <!-- Right side column. Contains the navbar and content of the page -->
            <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <button class="btn btn-success" onclick="add_customer()"><i class="glyphicon glyphicon-plus"></i> Add Field Officer Work</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active">Field Officer Work</li>
      </ol>
    </section>






<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Field officer Pay</h3>
      </div>
      <div class="modal-body" id="add-brand-messages"></div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="datepicker" name="date" value="<?php echo date("d-m-Y");?> ">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Field Officer</label>
              <div class="col-md-9">
                <select name="name" id="name" class="form-control">
                 <option value="">Select</option>
                 <?php foreach ($fos1 as $key => $fos2) {
                  ?>
                 <option><?php echo $fos2->name; ?></option>
                 <?php } ?>
               </select>
              </div>
            </div>  
            <div class="form-group">
              <label class="control-label col-md-3">Credit</label>
              <div class="col-md-9">
                <input value="0" type="text" class="form-control" id="credit" name="credit" placeholder="Enter Credit">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Debit</label>
              <div class="col-md-9">
                <input value="0" type="text" class="form-control" id="debit" name="debit" placeholder="Enter Debit">
               </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3">Balance</label>
              <div class="col-md-9">
                <input value="0" type="text" class="form-control" id="balance" name="balance" placeholder="Enter Balance">
               </div>
            </div>
 
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save   </button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<!-- End Bootstrap modal -->

    <section class="content container-fluid">


<div class="row">  
<form method="POST" action="<?php echo site_url('Viewfos/datewise_report')?>">   
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




    <!-- Main content -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Field Officer work</h3>
            </div>
            <!-- /.box-header -->
<div class="box-body">   
  <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%" >
    <thead>
      <tr>
        <th>S_No</th>
        <th>Date</th>
        <th>Name</th>
        <th>Credit</th>
        <th>Debit</th>               
        <th>Balance</th> 
        <th>Action</th>   
      </tr>
    </thead>
    <tbody>
      <?php
      $x=1;
      foreach ($result as $key => $fos) {
      $x++;
      ?>
      <tr>
        <td><?php echo $x; ?></td>
        <td><?php echo $fos->date; ?></td>
        <td><?php echo $fos->name; ?></td>
        <td><?php echo $fos->credit; ?></td>
        <td><?php echo $fos->debit; ?></td>
        <td><?php echo $fos->balance; ?></td>
        <td><button class="btn btn-warning" title="Edit" onclick="edit_customer(<?php echo $fos->id; ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
          <button class="btn btn-danger" title="Delete" onclick="delete_customer(<?php echo $fos->id; ?>)"><i class="glyphicon glyphicon-trash"></i></button></td>
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
    table = $('#table').DataTable({ 

        // Load data for the table's content from an Ajax source
        // "ajax": {
        //     "url": "<?php echo site_url('Fos1/ajax_list')?>",
        //     'order': []   
        // },
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

$('#datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        todayHighlight: true,
        // orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });
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

var save_method; //for save method string
var table;



function add_customer()
{
    $(".text-danger").remove();
    // remove the form error
    $('.form-group').removeClass('has-error').removeClass('has-success');

    $("#btnSave").html('Save');
    
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
}

function reload_table()
{
    table.ajax.reload(null, false); 
}
 
function edit_customer(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals

    $("#btnSave").html('Update');
   
    //Ajax Load data from ajax

    $(".text-danger").remove();
    // remove the form error
    $('.form-group').removeClass('has-error').removeClass('has-success');

    $.ajax({
        url : "<?php echo site_url('Fos1/customer_edit')?>/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="date"]').val(data.date);
            $('[name="name"]').val(data.name);
            $('[name="credit"]').val(data.credit);
            $('[name="debit"]').val(data.debit);
            $('[name="balance"]').val(data.balance);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Field Officer'); // Set title to Bootstrap modal title


            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}   


          $( "#name" ).autocomplete({      
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo site_url('Fos1/ajax_autocomplete') ?>",
                    dataType: "json", 
                    data: request, 
                    success: function (data) {
                        if(data.response == 'true') 
                        {
                        response(data.message);
                      }
                      }
                 });      
             }
           });

function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('Fos1/save')?>";
      }

      else
      {
        url = "<?php echo site_url('Fos1/update')?>";
      }


$(".text-danger").remove();
    // remove the form error
    $('.form-group').removeClass('has-error').removeClass('has-success');
    var name = $("#name").val();
    var credit = $("#credit").val();
    if(name == "") 
    {
      $("#name").after('<p class="text-danger">Field Officer is required</p>');
      $('#name').closest('.form-group').addClass('has-error');
    }
    else
    {
      // remov error text field
      $("#name").find('.text-danger').remove();
      // success out for form 
      $("#name").closest('.form-group').addClass('has-success');     
    }
    if(credit == "0") 
    {
      $("#credit").after('<p class="text-danger">Credit is required</p>');
      $('#credit').closest('.form-group').addClass('has-error');
    }
    else
    {
      // remov error text field
      $("#credit").find('.text-danger').remove();
      // success out for form 
      $("#credit").closest('.form-group').addClass('has-success');     
    }
    
    
    if(credit && name)
      {
      $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success:function(data)
            {
        
         // reset the form text
         $("#form")[0].reset();
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
   window.location.href = "<?php echo site_url('Fos1'); ?>";


            },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
            


          });
        }
    
}



function delete_customer(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database

        $.ajax({
            url : "<?php echo site_url('Fos1/customer_delete')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                // reload_table();
window.location.href = "<?php echo site_url('Fos1'); ?>";
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}
    
</script>



