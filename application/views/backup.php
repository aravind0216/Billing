<?php $this->load->view('includes/header');?>
<?php $this->load->view('includes/menu');?>   
<link rel="stylesheet" href="<?php echo base_url()?>assets\datatables\css\jquery.dataTables.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets\datatables\css\dataTables.bootstrap.min.css"> 
            <!-- Right side column. Contains the navbar and content of the page -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="<?php echo base_url(); ?>Dashboard/database_backup"><button class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Database Backup</button></a>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> home</a></li>
        <li class="active">Database Backup and Restore</li>
      </ol>
    </section>







<!-- Bootstrap modal -->

<section class="content container-fluid">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Database Backup</h3>
    </div>

      <div class="modal-body" id="add-brand-messages"></div>
      <div class="modal-body form">
       <center><a href="<?php echo base_url(); ?>Dashboard/database_backup"><button class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Database Backup</button></a></center>
        <!-- <form action="<?php echo base_url();?>Backup/reStore" enctype="multipart/form-data" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Select Database</label>
              <div class="col-md-6">
                <input type="file" class="form-control" name="database" placeholder="Select Database">
              </div>
            </div>
            
            
          </div>
        
          </div>
          <div class="modal-footer">
            <center><button type="submit" id="btnSave" class="btn btn-primary">Restore   </button>
            <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancel</button></center>
          </div>
          </form> -->
        </div>

</section>  








  
</div>


       
<?php $this->load->view('includes/footer');?>   

