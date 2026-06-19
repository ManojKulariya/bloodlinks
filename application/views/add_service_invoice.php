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
<style>
    .panel {
    margin-bottom: 20px;
    background-color: #fff;
    border: none;
    box-shadow: 0 2px 10px rgb(0 0 0 / 15%);
    border-radius: 3px;
    padding: 15px;
}
</style>
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
            <div class="panel panel-inverse">
                    <?php echo form_open('add_service_invoice/add', array('method' => 'post')); ?>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('tenant'); ?> *</label>
                            <div>
                                <select style="width: 100%" class="form-control default-select2" data-parsley-required="true" name="tenant_id">
                                    <option value=""><?php echo $this->lang->line('select_tenant'); ?></option>
                                    <?php
                                    $tenants = $this->db->get_where('tenant', array('status' => 1))->result_array();
                                    foreach ($tenants as $tenant) :
                                    ?>
                                        <option value="<?php echo html_escape($tenant['tenant_id']); ?>"><?php echo html_escape($tenant['name'] . ' - ' . $this->db->get_where('room', array('room_id' => $tenant['room_id']))->row()->room_number); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                       
                <div class="form-group">
                    <label><?php echo $this->lang->line('service_name'); ?> *</label>
                    <select style="width: 100%" class="form-control default-select2" data-parsley-required="true" name="service_id">
                        <option value=""><?php echo $this->lang->line('select_invoice_service'); ?></option>
                        <?php
                        $services = $this->db->get('service')->result_array();
                        foreach ($services as $service) :
                        ?>
                            <option  value="<?php echo html_escape($service['service_id']); ?>"><?php echo html_escape($service['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
           
                <div class="form-group">
                     <label><?php echo $this->lang->line(''); ?>Cost</label>
                     <input type="text" name="cost" placeholder="<?php echo $this->lang->line(''); ?>" class="form-control">
                </div>
                
                <div class="form-group">
                     <label><?php echo $this->lang->line(''); ?>Remark</label>
                     <input type="text" name="remark" placeholder="Remark" class="form-control">
                </div>
               
                    <div class="form-group">
                     <label><?php echo $this->lang->line(''); ?>Start Date</label>
                     <input type="date" name="start_date" placeholder="start_date" class="form-control">
                </div>
           
                    <div class="form-group">
                     <label><?php echo $this->lang->line(''); ?>End Date</label>
                     <input type="date" name="end_date" placeholder="end date" class="form-control">
                </div>
           
     
           <button type="submit" class="mb-sm btn btn-block btn-primary">Generate Service Invoice</button>
                        <?php echo form_close(); ?>
                   
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


