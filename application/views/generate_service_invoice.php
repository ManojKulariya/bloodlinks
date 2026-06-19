<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title><?php echo $this->db->get_where('setting', array('name' => 'system_name'))->row()->content; ?> - <?php echo $this->db->get_where('setting', array('name' => 'tagline'))->row()->content; ?> | <?php echo $page_title; ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="<?php echo $this->db->get_where('setting', array('name' => 'tagline'))->row()->content; ?>" name="description" />
    <meta content="t1m9m.com" name="author" />

    <link rel="icon" type="image/*" href="<?php echo base_url(); ?>uploads/website/<?php echo $this->db->get_where('setting', array('name' => 'favicon'))->row()->content; ?>">

    <?php include 'includes_top.php'; ?>
</head>

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
	<?php echo $this->lang->line('invoice'); ?>#<?php echo $invoice_number = $this->db->get_where('invoice_service', array('tenant_id' => $tenant_id))->row()->tenant_id; ?>
	</h1>
	<!-- end page-header -->
	<?php $tenant_id = $this->db->get_where('tenant', array('tenant_id' => $tenant_id))->row()->tenant_id; ?>
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
            <?php echo $this->db->get_where('tenant', array('tenant_id' => $tenant_id))->row()->email; ?> <br />
          </address>
        </div>
        <div class="col-sm-4">
        
          <address>
            To<br />
           <b> <?php echo $this->db->get_where('tenant', array('tenant_id' => $tenant_id))->row()->name; ?> </b> D/O <br />
            <?php echo $this->db->get_where('tenant', array('tenant_id' => $tenant_id))->row()->father_name; ?> <br/>
           
         </address>
        </div>
        <div class="col-sm-4">
         
          <address>
         
          <b>  Invoice :  #<?php echo $invoice_number; ?><br /></b>
            <b>Category:</b><?php echo $this->db->get_where('invoice', array('tenant_id' => $tenant_id))->row()->room_number; ?><br />
            <b>Invoice Date:</b> <?php echo $this->db->get_where('invoice_service', array('tenant_id' => $tenant_id))->row()->timestamp; ?><br />
            <b>Status:</b>  <br/>
            <b>Amount:</b> <?php echo $this->db->get_where('setting', array('name' => 'currency'))->row()->content; ?> <?php echo $this->db->get_where('invoice_service', array('tenant_id' => $tenant_id))->row()->cost; ?><br />
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
                <th scope="col">S.No</th>
                <th scope="col">Service Name</th>
                <th scope="col">Remark </th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Amount </th>
                
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td><?php  $bill_info = $this->db->get_where('invoice_service', array('tenant_id' => $tenant_id))->row()->service_id; ?><?php echo $this->db->get_where('service', array('service_id' => $bill_info))->row()->name;?></td>
                <td><?php echo $this->db->get_where('invoice_service', array('tenant_id' => $tenant_id))->row()->remark; ?></td>
                <td><?php echo $this->db->get_where('invoice_service', array('tenant_id' => $tenant_id))->row()->start_date; ?></td>
                <td><?php echo $this->db->get_where('invoice_service', array('tenant_id' => $tenant_id))->row()->end_date; ?></td>
                <td><?php echo $this->db->get_where('invoice_service', array('tenant_id' => $tenant_id))->row()->cost; ?></td>
                </tr>
 
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-8">
        </div>
        <div class="col-sm-4">
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