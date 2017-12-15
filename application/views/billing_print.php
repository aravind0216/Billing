
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>INVOICE</title>
    <link rel="stylesheet" href="<?php echo base_url()?>assets\dist\css\style_print.css">

  </head>
  <body>
  	<?php foreach ($purchase as $row ) {?>
    <header class="clearfix">
      <div id="logo">
        <img src="logo.png">
      </div>
      <h1>INVOICE</h1>
      <div id="company" class="clearfix">
        <div>Arunachalam Enterprises</div>
        <div>GST NO - 33CZGPP7684A1Z8</div>
        <div>No 2, North Veli Street<br /> Madurai-2</div>
        <div>(91) 9566696262</div>
<!--         <div><a href="mailto:company@example.com">company@example.com</a></div>
 -->      </div>
      <div id="project">
        <div><span>Bill No</span> #<?php echo $row->b_id; ?></div>
        <div><span>Company Name</span> <?php echo $row->name; ?></div>
		<div><span>GSTIN</span> <?php echo $row->gstin; ?></div>       
		<div><span>ADDRESS</span> <?php echo $row->address; ?></div>
        <div><span>Mobile</span> <?php echo $row->mobile; ?></div>
        <div><span>DATE</span> <?php echo date('d-m-Y', strtotime($row->date)); ?></div>
        <?php if($row->mode == 'Credit'){ ?>
        <div><span>DUE DATE</span> <?php echo date('d-m-Y', strtotime($row->duedate)); ?></div>
        <?php } ?>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="desc">PRODUCT</th>
            <th style="text-align:right;" class="desc">PRICE</th>
            <th style="text-align:right;" class="unit">QTY</th>
            <TH style="text-align:right;" class="unit">SUB TOTAL</TH>
            <TH style="text-align:right;" class="unit">SGST</TH>
            <TH style="text-align:right;" class="unit">CGST</TH>
            <th style="text-align:right;"  class="unit">TOTAL</th>
          </tr>
        </thead>
        <tbody>
        	<?php foreach ($purchase_item as $row1) 
			  		{
			  		?>
          <tr>
            <td class="desc"><?php echo $row1->pname; ?></td>
            <td class="unit">₹<?php echo $row1->s_price; ?></td>
            <td class="unit"><?php echo $row1->qty; ?></td>
            <td class="unit">₹<?php echo $row1->stot; ?></td>
            <td class="unit">₹<?php echo $row1->sgst_amt; ?></td>
            <td class="unit">₹<?php echo $row1->cgst_amt; ?></td>
            <td class="unit">₹<?php echo $row1->total; ?></td>
          </tr>
          <?php } ?>
          
          <!-- <tr>
            <td class="grand total" colspan="6">SUBTOTAL</td>
            <td class="grand total">₹<?php echo $row->stot; ?></td>
          </tr>
          <tr>
            <td colspan="6">SGST</td>
            <td class="total">₹<?php echo $row->sgst; ?></td>
          </tr>
          <tr>
            <td colspan="6">CGST</td>
            <td class="total">₹<?php echo $row->cgst; ?></td>
          </tr> -->
          <tr>
            <td colspan="6" class="grand total">GRAND TOTAL</td>
            <td class="grand total">₹<?php echo $row->tot; ?></td>
          </tr>
          <?php if($row->mode == 'Credit')
          { ?>
          <tr>
            <td colspan="6">PAID</td>
            <td>₹<?php echo $row->advance; ?></td>
          </tr>
          <tr>
            <td colspan="6">BALANCE</td>
            <td>₹<?php echo $row->balance; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <!-- <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">No Refundable</div>
      </div> -->
    </main>
    

    <!-- <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer> -->
    <?php } ?>
  </body>
</html>