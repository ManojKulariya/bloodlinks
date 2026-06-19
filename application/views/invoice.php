<style>
	@page {
		size: A4
	}
</style>

<!-- begin #content -->
<div id="content" class="content">
	<!-- begin breadcrumb -->
	<ol class="breadcrumb hidden-print pull-right">
		<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('dashboard'); ?></a></li>
		<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>invoices"><?php echo $this->lang->line('all_rents'); ?></a></li>
		<li class="breadcrumb-item active"><?php echo $this->lang->line('invoice'); ?></li>
	</ol>
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header hidden-print">
	<?php echo $this->lang->line('invoice'); ?>#<?php echo $invoice_number = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->invoice_number; ?>
	</h1>
	<!-- end page-header -->
	<?php $tenant_id = $this->db->get_where('tenant_rent', array('invoice_id' => $invoice_id))->row()->tenant_id; ?>
	<!-- begin invoice -->
	<div class="invoice print-body">
		<!-- begin invoice-company -->
		<div class="invoice-company text-inverse f-w-600">
			<span class="pull-right hidden-print">
				<a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5 hidden-print">
					<i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> <?php echo $this->lang->line('print'); ?>
				</a>
			</span>
			<?php echo '<img src="' . base_url() . 'uploads/website/' . $this->db->get_where('setting', array('name' => 'favicon'))->row()->content . '" alt="Mars Room Management System"' . '/>'; ?>
			<!--<?php echo html_escape($this->db->get_where('setting', array('name' => 'tagline'))->row()->content); ?>-->
		</div>
		<!-- end invoice-company -->
		<!-- begin invoice-header -->
		<div class="invoice-header">
			<div class="container mt-5">
      <div class="row">
        <div class="col-sm-4">
         
          <address>
            From<br />
            <?php echo html_escape($this->db->get_where('setting', array('name' => 'system_name'))->row()->content); ?><br/>
            <?php echo $this->db->get_where('setting', array('name' => 'address'))->row()->content; ?><br />
            <?php echo $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->tenant_mobile; ?><br />
            <?php echo $this->db->get_where('tenant', array('tenant_id' => $tenant_id))->row()->email; ?> <br />
          </address>
        </div>
        <div class="col-sm-4">
        
          <address>
            To<br />
           <b> <?php echo $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->tenant_name; ?> </b> D/O <br />
            <?php echo $this->db->get_where('tenant', array('tenant_id' => $tenant_id))->row()->father_name; ?> <br/>
            <?php echo $this->db->get_where('tenant', array('tenant_id' => $tenant_id))->row()->work_address; ?><br />
            <?php echo $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->tenant_mobile; ?><br />
            <?php echo $this->db->get_where('tenant', array('tenant_id' => $tenant_id))->row()->email; ?> <br />
            
         </address>
        </div>
        <div class="col-sm-4">
         
          <address>
          <?php
				// 		echo $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->status ? $this->lang->line('paid') : $this->lang->line('due');
						if ($this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->payment_method_id) {
							$payment_method_query  =   $this->db->get_where('payment_method', array('payment_method_id' => $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->payment_method_id));
							if ($payment_method_query->num_rows() > 0) {
								echo ' (' . $payment_method_query->row()->name . ')';
							}
						}
					?>
          <b>  Invoice :  #<?php echo $invoice_number; ?><br /></b>
            <b>Category:</b><?php echo $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->room_number; ?><br />
            <b>Invoice Date:</b> <?php echo date('d M, Y', $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->due_date); ?><br />
            <b>Status:</b>  <br/>
            <b>Amount:</b> <?php echo $this->db->get_where('setting', array('name' => 'currency'))->row()->content; ?> <?php echo $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->total_amount; ?><br />
            GST: XXXXXXXXXXXXX
          </address>
        </div>
      </div>
       <?php 
       ?>
      <div class="row">
        <div class="col-sm-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Qty</th>
                <th scope="col">Product</th>
                <th scope="col">Serial #</th>
                <th scope="col">Description</th>
                <th scope="col">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td><?php echo $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->room_number; ?></td>
                <td><?php echo $invoice_number; ?></td>
                <td><?php echo $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->room_number; ?></td>
                <td><?php echo $total = $this->db->get_where('setting', array('name' => 'currency'))->row()->content; ?> <?php echo $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->amount; ?></td>
              </tr>
 
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
        </div>
        <div class="col-sm-4">
          <table class="table">
            <tbody>
                
              <tr>
                <th scope="row">Discount:</th>
                <td><?php echo $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->discount; ?></td>
              </tr>
              <tr>
              <tr>
                <th scope="row">Subtotal:</th>
                <td><?php echo $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->dis_amount; ?></td>
              </tr>
              <tr>
                <th scope="row">SGST <?php $gst =$this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->tax; ?>
                        <?php echo $gst/2 ?>%</th>
                <td><?php $gst =$this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->tax_amount; ?>
                        <?php echo $gst/2 ?>
            </td>
              </tr>
              <tr>
                <th scope="row">CGST <?php $gst =$this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->tax; ?>
                        <?php echo $gst/2 ?>%</th>
                <td><?php $gst =$this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->tax_amount; ?>
                        <?php echo $gst/2 ?></td>
              </tr>
              <tr>
                <th scope="row">Sub Total:</th>
                <td><?php echo $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row()->total_amount; ?></td>
              </tr>
        
            </tbody>
          </table>
        </div>

		<!-- end invoice-content -->
	</div>
	<!-- end invoice -->
</div>
<!-- end #content -->

<style>
	@media print {
		.hidden-print {
			display: none;
		}

		.invoice-header {
			display: grid;
			grid-template-columns: 1fr 1fr 1fr;
		}

		.invoice-to {
			margin-top: 0 !important;
			text-align: center !important;
		}

		.invoice-date {
			margin-top: 0 !important;
			text-align: right !important;
		}

		.invoice-price {
			display: grid;
			grid-template-columns: repeat(4, 1fr);
			grid-gap: 10px;
			grid-auto-rows: 100px;
			grid-template-areas:
				"a a a a b b b b"
				"c c c c d d d d";
			align-items: end;
		}

		.invoice-price-left {
			grid-area: b;
		}

		.invoice-price-right {
			grid-area: d;
		}
	}
</style>