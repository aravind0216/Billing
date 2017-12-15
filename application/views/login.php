<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Billing | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>BILL</b>ING</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"></p>

    <form method="post" action="<?php echo base_url(); ?>Login/login_validation ">
      <div class="form-group has-feedback">
        <input type="text" id="userid" name="userid" class="form-control" placeholder="User Name">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="text-danger"><?php echo form_error('userid'); ?></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="text-danger"><?php echo form_error('password'); ?></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <center><?php echo'<label class="text-danger">'.$this->session->flashdata("error"); ?></center>
        <!-- /.col -->
      </div>
    </form>

    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <a href="#modal_form" data-toggle="modal" >Forgot Password!</a>
    <!-- <a href="#" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->






<!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Forget Password</h3>
      </div>
      <div class="modal-body" id="add-brand-messages"></div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">E-Mail Id</label>
              <div class="col-md-9">
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
               </div>
            </div> 
          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Forget_password   </button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<!-- End Bootstrap modal -->






<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script type="text/javascript">

function save()
{
      
$(".text-danger").remove();
    // remove the form error
    $('.form-group').removeClass('has-error').removeClass('has-success');
    var email = $("#email").val();
    if(email == "") 
    {
      $("#email").after('<p class="text-danger">E-mail is required</p>');
      $('#email').closest('.form-group').addClass('has-error');
    }
    else
    {
      // remov error text field
      $("#email").find('.text-danger').remove();
      // success out for form 
      $("#email").closest('.form-group').addClass('has-success');     
    }
    
    
    if(email)
      {
      $.ajax({
            url : "<?php echo site_url('Login/forget_pass')?>",
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
         '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Your Password is :  '+ data +
         '</div>');

         // $(".alert-success").delay(500).show(10, function()
         // {
         // $(this).delay(3000).hide(10, function() 
         //    {
         //    $(this).remove();
         //    });
         // }); // /.alert
   
          },
        error: function (jqXHR, textStatus, errorThrown)
        {
        $("#form")[0].reset();
         //   // remove the error text
         $(".text-danger").remove();
         //   // remove the form error
         $('.form-group').removeClass('has-error').removeClass('has-success');
            
         $('#add-brand-messages').html('<div class="alert alert-danger fade in">'+
         '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
         '<strong>Error!</strong> Enter a Wrong Mail ID  '+
         '</div>');
        }
            


          });
        }
    
}

</script>
</body>
</html>
