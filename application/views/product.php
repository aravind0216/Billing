<?php $this->load->view('includes/header');?>
<?php $this->load->view('includes/menu');?>   
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables/datatables.min.css')?>"/>

            <!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <button class="btn btn-success" onclick="add_product()"><i class="glyphicon glyphicon-plus"></i> Add Product</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active">Product</li>
      </ol>
    </section>







<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Add Product</h3>
      </div>
      <div class="modal-body" id="add-brand-messages"></div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Date</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="datepicker" name="date" value="<?php echo date("d-m-Y"); ?> ">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Product Id</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="pro_id" name="pro_id" placeholder="Product Name">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Product Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="p_name" name="p_name" placeholder="Product Name">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Purchase Price</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="p_price" name="p_price" placeholder="Purchase Price">
              </div>
            </div> 
            <div class="form-group">
              <label class="control-label col-md-3">Distributor Price</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="d_price" name="d_price" placeholder="Sales Price">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Retailor Price</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="r_price" name="r_price" placeholder="Sales Price">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Customer Price</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="c_price" name="c_price" placeholder="Sales Price">
              </div>
            </div>  
            <div class="form-group">
              <label class="control-label col-md-3">S GST (%)</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="sgst" name="sgst" placeholder="S GST">
              </div>
            </div> 
            <div class="form-group">
              <label class="control-label col-md-3">C GST (%)</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="cgst" name="cgst" placeholder="C GST">
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
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">View Product</h3>
    </div>
            <!-- /.box-header -->
<div class="box-body">   
  <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%" >
    <thead>
      <tr>
<!--         <th>S_No</th>
        <th>Date</th>
 -->        <th>Id</th>
        <th>Product</th>
        <th>Purchase Price</th>
        <th>Distributor Price</th>
        <th>Retailor Price</th>
        <th>Customer Price</th>
        <th>Stock</th> 
        <th>S GST</th> 
        <th>C GST</th> 
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
  table = $('#table').DataTable({ 
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('Product/ajax_list')?>",
            'order': []   
        },

    }); 

$('#datepicker').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

});     

var save_method; //for save method string
var table;

function add_product()
{
  $(".text-danger").remove();
    // remove the form error
    $('.form-group').removeClass('has-error').removeClass('has-success');
  save_method = 'add';
  $('#form')[0].reset(); // reset form on modals
  $('#modal_form').modal('show'); // show bootstrap modal
} 

function reload_table()
{
  table.ajax.reload(null, false); 
}


function edit(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals


    $(".text-danger").remove();
    // remove the form error
    $('.form-group').removeClass('has-error').removeClass('has-success');
    
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('Product/edit')?>/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="pro_id"]').val(data.pro_id);
            $('[name="date"]').val(data.date);
            $('[name="p_name"]').val(data.p_name);
            $('[name="p_price"]').val(data.p_price);
            $('[name="d_price"]').val(data.d_price);
            $('[name="r_price"]').val(data.r_price);
            $('[name="c_price"]').val(data.c_price);
            $('[name="sgst"]').val(data.sgst);
            $('[name="cgst"]').val(data.cgst);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Product'); // Set title to Bootstrap modal title


            
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
          url = "<?php echo site_url('Product/save')?>";
      }

      else
      {
        url = "<?php echo site_url('Product/update')?>";
      }  
// remove the error text
    $(".text-danger").remove();
    // remove the form error
    $('.form-group').removeClass('has-error').removeClass('has-success');
    var p_name = $("#p_name").val();
    var pro_id = $("#pro_id").val();
    var p_price = $("#p_price").val();
    var d_price = $("#d_price").val();
    var r_price = $("#r_price").val();
    var c_price = $("#c_price").val();
    var sgst = $("#sgst").val();
    var cgst = $("#cgst").val();
    
    if(pro_id == "") {
      $("#pro_id").after('<p class="text-danger">Product Id is required</p>');
      $('#pro_id').closest('.form-group').addClass('has-error');
    } else {
      // remov error text field
      $("#pro_id").find('.text-danger').remove();
      // success out for form 
      $("#pro_id").closest('.form-group').addClass('has-success');     
    }
    if(p_name == "") {
      $("#p_name").after('<p class="text-danger">Product Name is required</p>');
      $('#p_name').closest('.form-group').addClass('has-error');
    } else {
      // remov error text field
      $("#p_name").find('.text-danger').remove();
      // success out for form 
      $("#p_name").closest('.form-group').addClass('has-success');     
    }
    if(p_price == "") {
      $("#p_price").after('<p class="text-danger">Purchase Price is required</p>');
      $('#p_price').closest('.form-group').addClass('has-error');
    } else {
      // remov error text field
      $("#p_price").find('.text-danger').remove();
      // success out for form 
      $("#p_price").closest('.form-group').addClass('has-success');     
    }
    
    if(d_price == "") {
      $("#d_price").after('<p class="text-danger">Distributor Price is required</p>');
      $('#d_price').closest('.form-group').addClass('has-error');
    } else {
      // remov error text field
      $("#d_price").find('.text-danger').remove();
      // success out for form 
      $("#d_price").closest('.form-group').addClass('has-success');     
    }
    if(r_price == "") {
      $("#r_price").after('<p class="text-danger">Retailor Price is required</p>');
      $('#r_price').closest('.form-group').addClass('has-error');
    } else {
      // remov error text field
      $("#r_price").find('.text-danger').remove();
      // success out for form 
      $("#r_price").closest('.form-group').addClass('has-success');     
    }
    if(c_price == "") {
      $("#c_price").after('<p class="text-danger">Customer Price is required</p>');
      $('#c_price').closest('.form-group').addClass('has-error');
    } else {
      // remov error text field
      $("#c_price").find('.text-danger').remove();
      // success out for form 
      $("#c_price").closest('.form-group').addClass('has-success');     
    }
    if(sgst == "") {
      $("#sgst").after('<p class="text-danger">S GST is required</p>');
      $('#sgst').closest('.form-group').addClass('has-error');
    } else {
      // remov error text field
      $("#sgst").find('.text-danger').remove();
      // success out for form 
      $("#sgst").closest('.form-group').addClass('has-success');     
    }
    if(cgst == "") {
      $("#cgst").after('<p class="text-danger">C GST is required</p>');
      $('#cgst').closest('.form-group').addClass('has-error');
    } else {
      // remov error text field
      $("#cgst").find('.text-danger').remove();
      // success out for form 
      $("#cgst").closest('.form-group').addClass('has-success');     
    }
    
    if(p_name && p_price && d_price && r_price && c_price && sgst && cgst && pro_id )
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




function product_delete(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database

        $.ajax({
            url : "<?php echo site_url('Product/delete_product')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
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

         <!-- add new calendar event modal -->
       



         <!-- add new calendar event modal -->
       

