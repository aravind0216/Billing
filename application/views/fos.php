<?php $this->load->view('includes/header');?>
<?php $this->load->view('includes/menu');?>   
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables/datatables.min.css')?>"/>
            <!-- Right side column. Contains the navbar and content of the page -->
            <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <button class="btn btn-success" onclick="add_customer()"><i class="glyphicon glyphicon-plus"></i> Add Field Officer</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active">Field Officer</li>
      </ol>
    </section>






<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Customer</h3>
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
                <input type="text" class="form-control" id="name" name="name" placeholder="Field Officer">
              </div>
            </div>  
            <div class="form-group">
              <label class="control-label col-md-3">Mobile Number</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">E-Mail Id</label>
              <div class="col-md-9">
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
               </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3">Address</label>
              <div class="col-md-9">
                <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter Address"></textarea>
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








    <!-- Main content -->
    <section class="content container-fluid">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">View Field Officer</h3>
            </div>
            <!-- /.box-header -->
<div class="box-body">   
  <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%" >
    <thead>
      <tr>
        <th>S_No</th>
        <th>Date</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>E-mail</th>               
        <th>Address</th> 
        <th>Action</th>   
      </tr>
    </thead>
    <tbody>
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
        "ajax": {
            "url": "<?php echo site_url('Fos/ajax_list')?>",
            'order': []   
        },

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
        url : "<?php echo site_url('Fos/customer_edit')?>/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="date"]').val(data.date);
            $('[name="name"]').val(data.name);
            $('[name="mobile"]').val(data.mobile);
            $('[name="email"]').val(data.email);
            $('[name="address"]').val(data.address);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Field Officer'); // Set title to Bootstrap modal title


            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}   




function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('Fos/save')?>";
      }

      else
      {
        url = "<?php echo site_url('Fos/update')?>";
      }


$(".text-danger").remove();
    // remove the form error
    $('.form-group').removeClass('has-error').removeClass('has-success');
    var name = $("#name").val();
    var mobile = $("#mobile").val();
    var email = $("#email").val();
    var address = $("#address").val();
    var date = $("#datepicker").val();
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
    if(mobile == "") 
    {
      $("#mobile").after('<p class="text-danger">Mobile Number is required</p>');
      $('#mobile').closest('.form-group').addClass('has-error');
    }
    else
    {
      // remov error text field
      $("#mobile").find('.text-danger').remove();
      // success out for form 
      $("#mobile").closest('.form-group').addClass('has-success');     
    }
    // if(mobile == "")
    // {
    //   $("#mobile").after('<p class="text-danger">Mobile Number is required</p>');
    //   $('#mobile').closest('.form-group').addClass('has-error');
    // }
    // else 
    // {
    //   // remov error text field
    //   $("#mobile").find('.text-danger').remove();
    //   // success out for form 
    //   $("#mobile").closest('.form-group').addClass('has-success');     
    // }
    // if(email == "")
    // {
    //   $("#email").after('<p class="text-danger">E-Mail Id is required</p>');
    //   $('#email').closest('.form-group').addClass('has-error');
    // }
    // else
    // {
    //   // remov error text field
    //   $("#email").find('.text-danger').remove();
    //   // success out for form 
    //   $("#email").closest('.form-group').addClass('has-success');     
    // }
    // if(address == "")
    // {
    //   $("#address").after('<p class="text-danger">Address is required</p>');
    //   $('#address').closest('.form-group').addClass('has-error');
    // }
    // else
    // {
    //   // remov error text field
    //   $("#address").find('.text-danger').remove();
    //   // success out for form 
    //   $("#address").closest('.form-group').addClass('has-success');     
    // }
    // if(date == "")
    // {
    //   $("#datepicker").after('<p class="text-danger">Date is required</p>');
    //   $('#datepicker').closest('.form-group').addClass('has-error');
    // } 
    // else 
    // {
    //   // remov error text field
    //   $("#datepicker").find('.text-danger').remove();
    //   // success out for form 
    //   $("#datepicker").closest('.form-group').addClass('has-success');     
    // }
    // if(gstin == "") {
    //   $("#gstin").after('<p class="text-danger">GSTIN is required</p>');
    //   $('#gstin').closest('.form-group').addClass('has-error');
    // } else {
    //   // remov error text field
    //   $("#gstin").find('.text-danger').remove();
    //   // success out for form 
    //   $("#gstin").closest('.form-group').addClass('has-success');     
    // }
    
    if(mobile && name)
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
         reload_table();
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



function delete_customer(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database

        $.ajax({
            url : "<?php echo site_url('Fos/customer_delete')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}
    
</script>



