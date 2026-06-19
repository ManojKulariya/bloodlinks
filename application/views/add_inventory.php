<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><?php echo $this->lang->line('dashboard'); ?></a></li>
        <li class="breadcrumb-item active"><?php echo $this->lang->line('add_inventory'); ?></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
    <?php echo $this->lang->line('add_inventory_header'); ?>
    </h1>
    <!-- end page-header -->

    <!-- begin row --><div class="row">
        <!-- begin col-12 -->
        <div class="col-lg-12">
    
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-body -->
                <div class="panel-body">
                    <?php echo form_open_multipart('inventory/add', array('method' => 'post', 'data-parsley-validate' => 'true')); ?>
                     <div class="form-group">
                        <label><?php echo $this->lang->line(' '); ?>Inventory Category </label>
                            <div>
                                <select style="width: 100%" class="form-control default-select2" data-parsley-required="true" name="inventory_category">
                                    <option value=""><?php echo $this->lang->line('select_category'); ?>Select</option>
                                    <?php
                                    $inventory_category = $this->db->get_where('inventory_category')->result_array();
                                    foreach ($inventory_category as $category) :
                                    ?>
                                        <option value="<?php echo html_escape($category['category_name']); ?>"><?php echo html_escape($category['category_name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            </div>
                             
                    <div class="form-group">
                        <label><?php echo $this->lang->line('inventory_name'); ?>Inventory Name  </label>
                         <div>
                                <select style="width: 100%" class="form-control default-select2" data-parsley-required="true" name="name">
                                    <option value=""><?php echo $this->lang->line('select_category'); ?>Select</option>
                                    <?php
                                    $inventory_category = $this->db->get_where('sub_inventory')->result_array();
                                    foreach ($inventory_category as $category) :
                                    ?>
                                        <option value="<?php echo html_escape($category['name']); ?>"><?php echo html_escape($category['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('quantity'); ?>Item Quantity </label>
                         <input name="quantity" type="number" class="form-control"  placeholder="<?php echo $this->lang->line('quantity'); ?>" data-parsley-required="true" />
                    </div>
                     <div class="form-group">
						<label><?php echo $this->lang->line('Service'); ?> Suffix </label>
						<select style="width: 100%" class="form-control"  name="category_type">
							<option value=""><?php echo $this->lang->line('select'); ?>Select Category</option>
							<option value="Kg"><?php echo $this->lang->line('Due'); ?>Kg</option>
                            <option value="Piece"><?php echo $this->lang->line(''); ?>piece</option>
                            <option value="Packet"><?php echo $this->lang->line(''); ?>Packets</option>
                                </select>
					</div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('vendor name'); ?>Vendor Name </label>
                         <input name="vendor_name" type="text" class="form-control"  placeholder="<?php echo $this->lang->line('vendor_name'); ?>" data-parsley-required="true" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('vendor Address'); ?>Vendor Address </label>
                         <input name="vendor_address" type="text" class="form-control"  placeholder="<?php echo $this->lang->line('vendor_address'); ?>" data-parsley-required="true" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('vendor name'); ?>Vendor Contact No. </label>
                         <input name="vendor_contact" type="number" class="form-control"  placeholder="<?php echo $this->lang->line('vendor_contact'); ?>" data-parsley-required="true" />
                    </div>
                         <div class="form-group">
                                <label><?php echo $this->lang->line(''); ?>Bill</label>
                                  <input class="form-control" type="file" name="image">
                                
                            </div>
                            
                           <div class="form-group">
                        <label><?php echo $this->lang->line('warranty'); ?>Warranty From </label>
                         <input name="warranty_from" type="date" class="form-control"  placeholder="<?php echo $this->lang->line('warranty from'); ?>" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('warranty'); ?>Warranty To </label>
                         <input name="warranty_to" type="date" class="form-control"  placeholder="<?php echo $this->lang->line('warranrty to'); ?>"/>
                    </div>
                        
                     <div class="form-group">
						<label><?php echo $this->lang->line('Service'); ?> Service</label>
						<select style="width: 100%" class="form-control"  name="service">
							<option value=""><?php echo $this->lang->line('select'); ?>Select</option>
							<option value="Due"><?php echo $this->lang->line('Due'); ?>Due</option>
                            <option value="Paid"><?php echo $this->lang->line(''); ?>Paid</option>
                                </select>
					</div>
					<div class="form-group">
						<label><?php echo $this->lang->line('Service'); ?> Services</label>
						<select style="width: 100%" class="form-control"  name="services1">
							<option value="No"><?php echo $this->lang->line('Due'); ?>No</option>
                            <option value="Yes"><?php echo $this->lang->line(''); ?>Yes</option>
                                </select>
					</div>
                    <div class="form-group">
						<label><?php echo $this->lang->line('Services'); ?>Due Service</label>
						<input name="services" type="date" class="form-control"  placeholder="<?php echo $this->lang->line('due services'); ?>"  />
                    
					</div>
                    
                    <div class="form-group">
                        <label><?php echo $this->lang->line('Total'); ?>Total Item Quantity</label>
                         <input name="total" type="number" class="form-control"  placeholder="<?php echo $this->lang->line('total'); ?>" data-parsley-required="true" />
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
