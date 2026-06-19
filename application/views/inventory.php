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
        <li class="breadcrumb-item active"><?php echo $this->lang->line('add_inventory'); ?></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
    
        <a href="<?php echo base_url(); ?>add_inventory">
            <button type="button" class="btn btn-inverse"><i class="fa fa-plus"></i> <?php echo $this->lang->line('add_inventory'); ?></button>
        </a>
    </h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
                      <?php
                    if(!empty($name == "name")){
                        $sql=" SELECT * FROM inventory WHERE 	inventory_category like '%".$value."%'";
                    }elseif(!empty($name == "value")){
                        // $sql=" SELECT * FROM inventory WHERE remark like '%".$inventory_inventory."%'";
                        $sql=" SELECT * FROM inventory WHERE status like '%".$value."%'";
                    }elseif(!empty($name == "date")){
                        $sql=" SELECT * FROM inventory WHERE created_at BETWEEN '" . $value . "' AND  '" . $value2 . "'ORDER by id DESC";
                    }else{
                        $sql=" SELECT * FROM inventory";
                    }
                    
                    $query = $this->db->query($sql);
                    $inventorys = $query->result_array();
                    
                    
                    $select_data = $this->db->get('inventory')->result_array();
                // $this->db->where('inventory BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
                ?>
        <!-- begin col-12 -->
        <div class="col-md-3">
                            <div class="panel panel-inverse">
                                <!-- begin panel-body -->
                                <div class="panel-body">
                                  
                                    <div class="form-group">
                                        <label>inventory Name</label>
                                        <div>
                                            <select style="width:280px;" class="form-control default-select2" data-parsley-required="true" id="inventory_name">
                                                <option value="" class="form-control" style="width:280px;">Select Name</option>
                                                <?php foreach ($select_data as $select){ ?>
                                                    <option <?= (!empty($value) && $value == $select['inventory_category']) ? 'selected': '' ?> ><?php echo html_escape($select['inventory_category']); ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                    <button type="button" onclick="sreacrTegentName()" class="mb-sm btn btn-block btn-primary"><?php echo $this->lang->line('show'); ?></button>
                                
                                <!-- end panel-body -->
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="panel panel-inverse">
                                <!-- begin panel-body -->
                                <div class="panel-body d-flex justify-content-around">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <div>
                                            <input type="date" id="inventory_start_date" placeholder="YYYY-MM-DD" class="form-control" style="width:280px;" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <div>
                                            <input type="date" id="inventory_end_date" placeholder="YYYY-MM-DD" class="form-control" style="width:280px;">
                                        </div>
                                    </div>
                                </div>
                                    <button type="button" onclick="sreacrTegentDate()" class="mb-sm btn btn-block btn-primary"><?php echo $this->lang->line('show'); ?></button>
                            </div>
                        </div>
                        
                        
                        
                        
                    </div>
                       
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="1%">#</th>
                                <th class="text-nowrap"><?php echo $this->lang->line('inventory_category'); ?>Inventory Category</th>
                                
                                <th class="text-nowrap"><?php echo $this->lang->line('inventory_name'); ?>Inventory Name</th>
                                <th class="text-nowrap"><?php echo $this->lang->line('vendor_name'); ?>Vendor Name</th>
                                <th class="text-nowrap"><?php echo $this->lang->line('vendor_contact'); ?>Vendor Contact</th>
                                 <th class="text-nowrap"><?php echo $this->lang->line(''); ?>Services</th>
                                <th class="text-nowrap"><?php echo $this->lang->line(''); ?>Due Services</th>
                                <th class="text-nowrap"><?php echo $this->lang->line('in_inventory'); ?>In Inventory</th>
                                <th class="text-nowrap"><?php echo $this->lang->line('out_inventory'); ?>Out Inventory</th>
                                <th class="text-nowrap"><?php echo $this->lang->line('current'); ?>current</th>
                                <th class="text-nowrap"><?php echo $this->lang->line('current'); ?></th
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $this->db->order_by('timestamp', 'desc');
                            //  $inventories = $this->db->get('inventory')->result_array();
                            foreach ($inventorys as $inventory) :
                            ?>
                                <tr>
                                    <td><?php echo html_escape($inventory['id']); ?></td>
                                    <td><?php echo html_escape($inventory['inventory_category']); ?></td>
                                    
                                    <td><?php echo html_escape($inventory['name']); ?></td>
                                    <td><?php echo html_escape($inventory['vendor_name']); ?></td>
                                    
                                    <td><?php echo html_escape($inventory['vendor_contact']); ?></td>
                                    <td><?php echo html_escape($inventory['services1']); ?></td>
                                    <td><?php echo html_escape($inventory['services']); ?></td>
                                     <td><?php echo html_escape($inventory['in_inventory']); ?></td>
                                    <td><?php echo html_escape($inventory['out_inventory']); ?></td>
                                    <td><?php echo html_escape($inventory['total']); ?> <?php echo html_escape($inventory['category_type']); ?></td>
                                    <td>
                                          <div class="btn-group">
                                                <a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_in_inventory/<?php echo $inventory['id']; ?>');">
                                                <?php echo $this->lang->line('In Inventory'); ?>In Inventory
                                                </a>
                                        </div>
                                        <div class="btn-group">
                                                <a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_out_inventory/<?php echo $inventory['id']; ?>');">
                                                <?php echo $this->lang->line('Out Inventory'); ?>Out Inventory
                                                </a>
                                        </div>
                                        <div class="btn-group">
                                                <a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_details_inventory/<?php echo $inventory['id']; ?>');">
                                                <?php echo $this->lang->line('Edit'); ?>Edit Inventory
                                                </a>
                                        </div>
                                        
                                         <div class="btn-group">
                                            <button type="button" class="btn btn-white btn-xs"><?php echo $this->lang->line('action'); ?></button>
                                            <button type="button" class="btn btn-white btn-xs dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_show_inventory_details/<?php echo $inventory['id']; ?>');">
                                                    <?php echo $this->lang->line('details'); ?>
                                                </a>
                                                </div>
                                       </div>
                                    </td>
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


<script>

    function sreacrTegentName() {
        var inventory_name = $("#inventory_name").val();

        url = "<?php echo base_url(); ?>inventory/name/" + inventory_name;

        window.location = url;
        
    }
    
    
    function sreacrTegentAttendance() {
        var attendace = $("#inventory_attendance").val();

        url = "<?php echo base_url(); ?>inventory/attendace/"+attendace;

        window.location = url;
        
    }
    
    function sreacrTegentDate(){
        
        var start_date = $("#inventory_start_date").val();
        var end_date = $("#inventory_end_date").val();

        url = "<?php echo base_url(); ?>inventory/date/" + start_date + '/' + end_date;

        window.location = url;
        
    }
    
</script>


