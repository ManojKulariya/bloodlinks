<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
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

<body>
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show">
        <div class="material-loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
            </svg>
            <div class="message">Loading...</div>
        </div>
    </div>
    <!-- end #page-loader -->

    <!-- begin #page-container -->
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-with-wide-sidebar">

        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>
      

  
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('dashboard'); ?></a></li>
        <li class="breadcrumb-item active"><?php echo $this->lang->line(''); ?>Add Service Invoice</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
    
        <a href="<?php echo base_url(); ?>add_service_invoice">
            <button type="button" class="btn btn-inverse"><i class="fa fa-plus"></i> Add Service Invoice</button>
        </a>
    </h1>
    <!-- end page-header -->

    <!-- begin row -->
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                         
                                <th class="text-nowrap">Invoice Number </th>
                                <th class="text-nowrap">Service Name</th>
                                <th class="text-nowrap">Remark</th>
                                <th class="text-nowrap">Start Date</th>
                                <th class="text-nowrap">End Date</th>
                                <th class="text-nowrap">Amount</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //   $this->db->order_by('timestamp', 'desc');
                              $inventories = $this->db->get('invoice_service')->result_array();
                            foreach ($inventories as $inventory) :
                            ?>
                                <tr>
                                    <td><a href="<?php echo base_url(); ?>generate_service_invoice/<?php echo $inventory['tenant_id']; ?>">
                                            #invoice<?php echo html_escape($inventory['tenant_id']); ?>
                                        </a></td>
                                    <td><?php  $data = html_escape($inventory['service_id']); ?><?php echo $this->db->get_where('service', array('service_id' => $data))->row()->name;?></td>
                                    <td><?php echo html_escape($inventory['remark']); ?></td>
                                    <td><?php echo html_escape($inventory['start_date']); ?></td>
                                    <td><?php echo html_escape($inventory['end_date']); ?></td>
                                    <td><?php echo html_escape($inventory['cost']); ?></td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->
</div>
<!-- end #content -->

      <?php include 'modal.php'; ?>
    </div>
    <!-- end page container -->

    <?php include 'includes_bottom.php'; ?>
    <?php include 'toastr.php'; ?>
</body>

</html>


