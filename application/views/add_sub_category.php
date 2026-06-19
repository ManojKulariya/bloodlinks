<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('dashboard'); ?></a></li>
        <li class="breadcrumb-item active"><?php echo $this->lang->line('add_category'); ?></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
    <?php echo $this->lang->line('add_category_header'); ?>
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
                    <?php echo form_open('sub_category/sub', array('method' => 'post', 'data-parsley-validate' => 'true')); ?>
                    
                        <div class="form-group">
                                <div>
                                          <label><?php echo $this->lang->line('category_name'); ?> Category Name</label>
                                <select style="width: 100%" class="form-control default-select2" data-parsley-required="true" name="name">
                                    <option value=""><?php echo $this->lang->line('select_category'); ?>Select</option>
                                    <?php
                                    $inventory_category = $this->db->get_where('inventory_category')->result_array();
                                    foreach ($inventory_category as $category) :
                                    ?>
                                        <option value="<?php echo html_escape($category['id']); ?>"><?php echo html_escape($category['category_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('category_name'); ?> Sub Category</label>
                            <input name="sub_name" type="text" class="form-control"  placeholder="<?php echo $this->lang->line('category'); ?>"/>
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