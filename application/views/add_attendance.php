<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('dashboard'); ?></a></li>
        <li class="breadcrumb-item active"><?php echo $this->lang->line('add_expense'); ?></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
    <?php echo $this->lang->line('add_expense_header'); ?>
    </h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-lg-6 offset-lg-3">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-body -->
                <div class="panel-body">
                    <?php echo form_open('attendance/add', array('method' => 'post', 'data-parsley-validate' => 'true')); ?>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('tenant '); ?>Name </label>
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
                            <label><?php echo $this->lang->line('status'); ?> *</label>
                            <div>
                                <select style="width: 100%" class="form-control default-select2" data-parsley-required="true" name="status">
                                    <option value=""><?php echo $this->lang->line('select_attendance'); ?>select_attendance</option>
                                    <option value="0"><?php echo $this->lang->line('check in'); ?>check in</option>
                                    <option value="1"><?php echo $this->lang->line('check out'); ?>check out</option>
                                </select>
                            </div>
                        </div>
                       
                      <div class="form-group">
                            <label><?php echo $this->lang->line('in_date'); ?> Date (mm/dd/yyyy) *</label>
                            <input name="in_date" type="text" class="form-control" id="datepicker-inline" placeholder="<?php echo $this->lang->line('in_date'); ?>" data-parsley-required="true" />
                        </div>

                        <div class="form-group">
                            <label><?php echo $this->lang->line('in_time'); ?>time (mm/dd/yyyy) *</label>
                            <input name="in_time" type="time" class="form-control"   data-parsley-required="true" />
                        </div>
                    
                    <button type="submit" class="mb-sm btn btn-primary"><?php echo $this->lang->line('submit'); ?></button>
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