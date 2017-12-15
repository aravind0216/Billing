<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
          
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active"><a href="<?php echo base_url(); ?>Dashboard""><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder-open"></i> <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>Customer"><i class="fa fa-users"></i> Customer</a></li>
            <li><a href="<?php echo base_url(); ?>Supplier"><i class="fa fa-user"></i> Supplier</a></li>
            <li><a href="<?php echo base_url(); ?>Product"><i class="fa fa-stack-exchange"></i> Product</a></li>
            <li><a href="<?php echo base_url(); ?>Fos"><i class="fa fa-user"></i> Field Officer</a></li>
            <!-- <li><a href="<?php //echo base_url(); ?>User"><i class="fa fa-circle-o"></i> New Users</a></li> -->
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Purchase</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>Purchase"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Add Purchase</span></a></li>
            <li><a href="<?php echo base_url(); ?>Viewpurchase"><i class="glyphicon glyphicon-record"></i> Purchase Report</a></li>
            </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-money" aria-hidden="true"></i> <span>Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url(); ?>Billing"><i class="fa fa-money" aria-hidden="true"></i> <span> Sales</span></a></li>
            <li><a href="<?php echo base_url(); ?>Viewbilling"><i class="fa fa-eye"></i> Sales Report</a></li>
            <li><a href="<?php echo base_url(); ?>Viewbillingitem"><i class="fa fa-eye"></i> Sales Product Report</a></li>
            </ul>
        </li>
         
        <li><a href="<?php echo base_url(); ?>Product"><i class="fa fa-star text-red"></i> <span> View Stock</span></a></li>
        <li><a href="<?php echo base_url(); ?>Fos1"><i class="fa fa-star text-red"></i> <span> Field Officer Work</span></a></li>
        <li><a href="<?php echo base_url(); ?>Backup"><i class="fa fa-database text-red"></i> <span>DB_Backup</span></a></li>
        <li><a href="<?php echo base_url(); ?>Login/logout"><i class="fa fa-sign-out text-red"></i> <span>Sign out</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>