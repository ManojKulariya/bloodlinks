<!-- begin #content -->



<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('dashboard'); ?></a></li>
        <li class="breadcrumb-item active"><?php echo $this->lang->line('expenses'); ?></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
        <a href="<?php echo base_url(); ?>add_expense">
            <button type="button" class="btn btn-inverse"><i class="fa fa-plus"></i> <?php echo $this->lang->line('Attendance'); ?>Attendance</button>
        </a>
    </h1>
    <!-- end page-header -->
    
<!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-lg-12">
            <h4>User Attendance</h4>
            
            <!-- begin panel -->
         
                <?php
                    if(!empty($name == "name")){
                        $sql=" SELECT * FROM attendance WHERE name like '%".$value."%'";
                    }elseif(!empty($name == "attendace")){
                        // $sql=" SELECT * FROM attendance WHERE remark like '%".$tenant_attendance."%'";
                        $sql=" SELECT * FROM attendance WHERE remark like '%".$value."%'";
                    }elseif(!empty($name == "date")){
                        $sql=" SELECT * FROM attendance WHERE created_at BETWEEN '" . $value . "' AND  '" . $value2 . "'ORDER by id DESC";
                    }else{
                        $sql=" SELECT * FROM attendance";
                    }
                    
                    $query = $this->db->query($sql);
                    $attendances = $query->result_array();
                    
                    
                    $select_data = $this->db->get('attendance')->result_array();
                // $this->db->where('attendance BETWEEN "'. date('Y-m-d', strtotime($start_date)). '" and "'. date('Y-m-d', strtotime($end_date)).'"');
                ?>
                <!-- begin panel-body -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="panel panel-inverse">
                                <!-- begin panel-body -->
                                <div class="panel-body">
                                  
                                    <div class="form-group">
                                        <label>Tenant Name</label>
                                        <div>
                                            <select style="width:270px;" class="form-control default-select2" data-parsley-required="true" id="tenant_name">
                                                <option value="" class="form-control" style="width:280px;">Select Name</option>
                                                <?php foreach ($select_data as $select){ ?>
                                                    <option <?= (!empty($value) && $value == $select['name']) ? 'selected': '' ?> ><?php echo html_escape($select['name']); ?> </option>
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
                                            <input type="date" id="tenant_start_date" placeholder="YYYY-MM-DD" class="form-control" style="width:290px;" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <div>
                                            <input type="date" id="tenant_end_date" placeholder="YYYY-MM-DD" class="form-control" style="width:290px;">
                                        </div>
                                    </div>
                                </div>
                                    <button type="button" onclick="sreacrTegentDate()" class="mb-sm btn btn-block btn-primary"><?php echo $this->lang->line('show'); ?></button>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-3">
                            <div class="panel panel-inverse">
                                <!-- begin panel-body -->
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>Tenant Status</label>
                                        <div>
                                            <select style="width:270px;" id="tenant_attendance" class="form-control default-select2" data-parsley-required="true">
                                                <option value=""> select date </option>
                                                <option value="present" <?= (!empty($value) && $value == 'present') ? 'selected': '' ?> > Present </option>
                                                <option value="absent" <?= (!empty($value) && $value == 'absent') ? 'selected': '' ?> > Absent </option>
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                    <button type="button" onclick="sreacrTegentAttendance()" class="mb-sm btn btn-block btn-primary"><?php echo $this->lang->line('show'); ?></button>
                                
                                <!-- end panel-body -->
                            </div>
                        </div>
                        
                    </div>
                   
            <div class="panel panel-inverse">
                    <table id="data-table-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr><th class="text-nowrap"><?php echo $this->lang->line('#'); ?>#</th>
                                <th class="text-nowrap"><?php echo $this->lang->line('tanant_name'); ?>Tanant Name</th>
                                <th class="text-nowrap"><?php echo $this->lang->line('tanant_id'); ?>Tanant Id</th>
                                <th class="text-nowrap"><?php echo $this->lang->line('room_number'); ?>Room Number</th>
                                <th class="text-nowrap"><?php echo $this->lang->line('Check in'); ?>Check In</th>
                                <th class="text-nowrap"><?php echo $this->lang->line('Check Out'); ?>Check Out</th>
                                <th class="text-nowrap"><?php echo $this->lang->line('Remark'); ?>Status</th>
                                <th class="text-nowrap"><?php echo $this->lang->line('Remark'); ?></th>
                                
                                    </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $this->db->order_by('timestamp', 'desc');
                            
                            foreach ($attendances as $attendance) :
                                ?>
                                <tr>
                                    <td><?php echo html_escape($attendance['id']); ?></td>
                                    <td><?php echo html_escape($attendance['name']); ?></td>
                                    <td><?php echo html_escape($attendance['tenant_id']); ?></td>
                                    <td><?php echo html_escape($attendance['room_number']); ?></td>
                                    <td><?php echo html_escape($attendance['check_in']); ?></td>
                                    <td><?php echo html_escape($attendance['check_out']); ?></td>
                                    <td><?php echo html_escape($attendance['remark']); ?></td>
                                    <td>
                                          <div class="btn-group">
                                                <a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_edit_expense/<?php echo $attendance['id']; ?>');">
                                                <?php echo $this->lang->line('Check Out'); ?>Check Out
                                                </a>
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
   

</div>
<!-- end #content -->


<script>

    function sreacrTegentName() {
        var tenant_name = $("#tenant_name").val();

        url = "<?php echo base_url(); ?>expenses/name/" + tenant_name;

        window.location = url;
        
    }
    
    
    function sreacrTegentAttendance() {
        var attendace = $("#tenant_attendance").val();

        url = "<?php echo base_url(); ?>expenses/attendace/"+attendace;

        window.location = url;
        
    }
    
    function sreacrTegentDate(){
        
        var start_date = $("#tenant_start_date").val();
        var end_date = $("#tenant_end_date").val();

        url = "<?php echo base_url(); ?>expenses/date/" + start_date + '/' + end_date;

        window.location = url;
        
    }
    
</script>

