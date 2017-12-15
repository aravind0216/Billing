<?php $this->load->view('includes/header');?>
<?php $this->load->view('includes/menu');?>   

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/datatables/datatables.min.css')?>"/>
  <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/fileinput/css/fileinput.min.css">


            <!-- Right side column. Contains the navbar and content of the page -->
            <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- <button class="btn btn-success" onclick="add_user()"><i class="glyphicon glyphicon-plus"></i> New Register</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button> -->
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

<?php
foreach ($userid as $userids) 
{
 $userid = $userids->id;
}
?>

<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content" style="max-height:600px; overflow:auto;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Users</h3>
      </div>
      <div class="modal-body" id="add-brand-messages"></div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
          <input type="hidden" value="" name="id"/>
          <div class="form-body">
            <div class="form-group">
            <label for="productImage" class="col-sm-3 control-label">Employee Image: </label>
            <label class="col-sm-1 control-label">: </label>
            <div class="col-sm-8">
              <!-- the avatar markup -->
            <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>              
              <div class="kv-avatar center-block">                  
                <input type="file" class="form-control" id="userimage" name="userimage" class="file-loading" style="width:auto;"/>
              </div>
              
            </div>
          </div> <!-- /form-group-->  
            <div class="form-group">
              <label class="control-label col-md-3">Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="name" name="name" placeholder="User Name">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">User Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="user" name="user" placeholder="User Name" onblur="check_username();">
                <div id="Info"></div>
              </div>
            </div>  
            <div class="form-group">
              <label class="control-label col-md-3">Password</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="pass" name="pass" placeholder="Password">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">E-Mail Id</label>
              <div class="col-md-9">
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
               </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Mobile Number</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile">
              </div>
            </div>
            
            <div class="form-group">
              <label class="control-label col-md-3">User Role</label>
              <div class="col-md-9">
                <select name="role" id="role" class="form-control">
                 <option value="">Select</option>
                 <option>Admin</option>
                 <option>Staff</option>
               </select>
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
              <h3 class="box-title">View Users</h3>
            </div>
            <!-- /.box-header -->
<div class="box-body">   
  <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%" >
    <thead>
      <tr>
        <th>S_No</th>
        <th>Name</th>
        <th>User Name</th>
        <th>Password</th>
        <th>Mobile</th>
        <th>E-mail</th>               
        <th>Role</th> 
        <th>Action</th>   
      </tr>
    </thead>
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
  <script src="<?php echo base_url()?>/assets/plugins/fileinput/js/fileinput.min.js"></script> 




<script type="text/javascript">
    


$(document).ready(function(){
    //datatables
    table = $('#table').DataTable({ 

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('User/ajax_list')?>",
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




    $("#userimage").fileinput({
        overwriteInitial: true,
        maxFileSize: 2500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: '<img src="<?php echo base_url()?>assets/images/photo_default.png" alt="Profile Image" style="width:30%;">',
        layoutTemplates: {main2: '{preview} {remove} {browse}'},                    
        allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
      });   


});    

var save_method; //for save method string
var table;



// function check_username()
// {
//         var user = $("#user").val();
//         if(user.length > 4)
//         {
//             $.post("<?php echo base_url(); ?>User/check_user", {
//                 user: $('#user').val(),
//                 }, 
//                 function(response)
//                 {
//                 $('#Info').fadeOut();
//                 setTimeout("finishAjax('Info', '"+escape(response)+"')", 400);
//                 });
//         }
        
// }

// function finishAjax(id, response)
// {
//   $('#'+id).html(unescape(response));
//   $('#'+id).fadeIn(1000);
// } 



function add_user()
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
 
function edit_user(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals

    $("#btnSave").html('Update');
   
    //Ajax Load data from ajax

    $(".text-danger").remove();
    // remove the form error
    $('.form-group').removeClass('has-error').removeClass('has-success');

    $.ajax({
        url : "<?php echo site_url('User/user_edit')?>/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="user"]').val(data.user);
            $('[name="pass"]').val(data.pass);
            $('[name="name"]').val(data.name);
            $('[name="mobile"]').val(data.mobile);
            $('[name="email"]').val(data.email);
            $('[name="role"]').val(data.role);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title


            
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
          url = "<?php echo site_url('User/save')?>";
      }

      else
      {
        url = "<?php echo site_url('User/update')?>";
      }


$(".text-danger").remove();
    // remove the form error
    $('.form-group').removeClass('has-error').removeClass('has-success');
    var name = $("#name").val();
    var user = $("#user").val();
    var pass = $("#pass").val();
    var mobile = $("#mobile").val();
    var email = $("#email").val();
    var role = $("#role").val();
    if(name == "") 
    {
      $("#name").after('<p class="text-danger">Name field is required</p>');
      $('#name').closest('.form-group').addClass('has-error');
    }
    else
    {
      // remov error text field
      $("#name").find('.text-danger').remove();
      // success out for form 
      $("#name").closest('.form-group').addClass('has-success');     
    }
    if(user == "") 
    {
      $("#user").after('<p class="text-danger">User Name is required</p>');
      $('#user').closest('.form-group').addClass('has-error');
    }
    else
    {
      // remov error text field
      $("#user").find('.text-danger').remove();
      // success out for form 
      $("#user").closest('.form-group').addClass('has-success');     
    }
    if(pass == "") 
    {
      $("#pass").after('<p class="text-danger">Password is required</p>');
      $('#pass').closest('.form-group').addClass('has-error');
    }
    else
    {
      // remov error text field
      $("#pass").find('.text-danger').remove();
      // success out for form 
      $("#pass").closest('.form-group').addClass('has-success');     
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
    if(email == "")
    {
      $("#email").after('<p class="text-danger">E-Mail Id is required</p>');
      $('#email').closest('.form-group').addClass('has-error');
    }
    else
    {
      // remov error text field
      $("#email").find('.text-danger').remove();
      // success out for form 
      $("#email").closest('.form-group').addClass('has-success');     
    }
    if(role == "")
    {
      $("#role").after('<p class="text-danger">Select Role is required</p>');
      $('#role').closest('.form-group').addClass('has-error');
    }
    else
    {
      // remov error text field
      $("#role").find('.text-danger').remove();
      // success out for form 
      $("#role").closest('.form-group').addClass('has-success');     
    }
    
    
    if(role && name && mobile && email && user && pass)
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



function delete_user(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database

        $.ajax({
            url : "<?php echo site_url('User/user_delete')?>/" + id,
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



// user id get
  var id = <?php echo $userid;?>;
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals

    $("#btnSave").html('Update');
   
    //Ajax Load data from ajax

    $(".text-danger").remove();
    // remove the form error
    $('.form-group').removeClass('has-error').removeClass('has-success');

    $.ajax({
        url : "<?php echo site_url('User/user_edit')?>/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="user"]').val(data.user);
            $('[name="pass"]').val(data.pass);
            $('[name="name"]').val(data.name);
            $('[name="mobile"]').val(data.mobile);
            $('[name="email"]').val(data.email);
            $('[name="role"]').val(data.role);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title


            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });



</script>



