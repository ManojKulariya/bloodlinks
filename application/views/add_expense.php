<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('dashboard'); ?></a></li>
        <li class="breadcrumb-item active"><?php echo $this->lang->line('add_expense'); ?></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h5 class="page-header">
    <!--<?php echo $this->lang->line(''); ?>Student Attendance-->
    </h5>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-lg-6 ">
            <!-- begin panel -->
            <h4>Student Attendance</h4>
            <div class="panel panel-inverse">
                <!-- begin panel-body -->
                <div class="panel-body">
                    <?php echo form_open_multipart('expenses/add', array('method' => 'post', 'data-parsley-validate' => 'true')); ?>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('tenant '); ?>Name And Room Number </label>
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
                            <label><?php echo $this->lang->line('in_date'); ?> Date (mm/dd/yyyy) *</label>
                            <input name="in_date" type="datetime-local" class="form-control"  placeholder="<?php echo $this->lang->line('in_date'); ?>"  />
                        </div>
                        <div class="form-group">
						<label><?php echo $this->lang->line('Remark'); ?> Status</label>
						<select style="width: 100%" class="form-control default-select1"  name="remark">
							<option value="present"><?php echo $this->lang->line('select'); ?></option>
							<option value="absent" ><?php echo $this->lang->line('Absent'); ?>Absent</option>
                            <option value="leave"><?php echo $this->lang->line('Leave'); ?>Leave</option>
                        </select>
					</div>
					
    
                    <button type="submit" class="mb-sm btn btn-primary"><?php echo $this->lang->line('submit'); ?></button>
                    <?php echo form_close(); ?>
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
        
        <div class="col-lg-6 ">
            
    <h4>Staff Attendance</h4>
    
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-body -->
                <div class="panel-body">
                    <?php echo form_open('expenses/staff', array('method' => 'post', 'data-parsley-validate' => 'true')); ?>
                    
                   <div class="form-group">
                        <label><?php echo $this->lang->line('staff '); ?>Staff Attendance</label>
                            <div>
                                <select style="width: 100%" class="form-control" name="staff_name">
                                    <option value=""><?php echo $this->lang->line('select_category'); ?>Select</option>
                                    <?php
                                    $staffs = $this->db->get_where('staff')->result_array();
                                    foreach ($staffs as $staff) :
                                    ?>
                                        <option value="<?php echo html_escape($staff['name']); ?>"><?php echo html_escape($staff['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            </div>
                    
                      <div class="form-group">
                            <label><?php echo $this->lang->line('in_date'); ?> Date (mm/dd/yyyy) *</label>
                            <input name="in_date" type="datetime-local" class="form-control"  placeholder="<?php echo $this->lang->line('in_date'); ?>"  />
                        </div>
                        <div class="form-group">
						<label><?php echo $this->lang->line('Remark'); ?> Status</label>
						<select style="width: 100%" class="form-control"  name="remark">
							<option value="present"><?php echo $this->lang->line('select'); ?></option>
							<option value="absent"><?php echo $this->lang->line('Absent'); ?>Absent</option>
                            <option value="leave"><?php echo $this->lang->line('Leave'); ?>Leave</option>
                        </select>
					</div>
					
    
                    <button type="submit" class="mb-sm btn btn-primary"><?php echo $this->lang->line('submit'); ?></button>
                    <?php echo form_close(); ?>
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>

    </div>
    <!-- end row -->
</div>
<!-- end #content -->