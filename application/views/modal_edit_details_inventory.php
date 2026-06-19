<?php echo form_open('inventory/edit/' . $param2, array('id' => 'edit_in_inventory', 'method' => 'post', 'data-parsley-validate' => 'true')); ?>
<?php
$inventory = $this->db->get_where('inventory', array('id' => $param2))->result_array();
foreach ($inventory as $row) :
?>
<div class="form-group">
		<label><?php echo $this->lang->line('Id'); ?> Id</label>
		<input value="<?php echo $row['id']; ?>" type="text" name="id" placeholder="<?php echo $this->lang->line('id'); ?>" class="form-control"   readonly>
	</div><label><?php echo $this->lang->line(' '); ?>Inventory Category </label>
                            <div>
                                <select value="<?php echo $row['inventory_category']; ?>" style="width: 100%" class="form-control default-select2"   name="inventory_category">
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
                         <input value="<?php echo $row['name']; ?>" name="name" type="text" class="form-control"  placeholder="<?php echo $this->lang->line('inventory_name'); ?>"   />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('quantity'); ?>Item Quantity </label>
                         <input value="<?php echo $row['quantity']; ?>" name="quantity" type="number" class="form-control"  placeholder="<?php echo $this->lang->line('quantity'); ?>"   />
                    </div>
                     <div class="form-group">
						<label><?php echo $this->lang->line('Service'); ?> Suffix </label>
						<select style="width: 100%" class="form-control"  name="category_type" value="<?php echo $row['quantity']; ?>">
							<option value=""><?php echo $this->lang->line('select'); ?>Select Category</option>
							<option value="Kg"><?php echo $this->lang->line('Due'); ?>Kg</option>
                            <option value="Piece"><?php echo $this->lang->line(''); ?>piece</option>
                            <option value="Packet"><?php echo $this->lang->line(''); ?>Packets</option>
                                </select>
					</div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('vendor name'); ?>Vendor Name </label>
                         <input value="<?php echo $row['vendor_name']; ?>" name="vendor_name" type="text" class="form-control"  placeholder="<?php echo $this->lang->line('vendor_name'); ?>"  />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line('vendor Address'); ?>Vendor Address </label>
                         <input value="<?php echo $row['vendor_address']; ?>"  name="vendor_address" type="text" class="form-control"  placeholder="<?php echo $this->lang->line('vendor_address'); ?>"   />
                    </div>
                    <div class="form-group">
                        <label><?php echo $this->lang->line(''); ?>Vendor Contact No. </label>
                         <input value="<?php echo $row['vendor_contact']; ?>" name="vendor_contact" type="number" class="form-control"  placeholder="<?php echo $this->lang->line('vendor_contact'); ?>"   />
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
                         <input name="total" type="number" class="form-control"  placeholder="<?php echo $this->lang->line('total'); ?>"   />
                    </div>
                    
    <div class="form-group">
        <label><?php echo $this->lang->line(''); ?> Remark</label>
            <input name="remark" type="text" class="form-control"  placeholder="<?php echo $this->lang->line('remark'); ?>" />
    </div>


	<button type="submit" class="mb-sm btn btn-primary"><?php echo $this->lang->line('update'); ?></button>
<?php endforeach; ?>
<?php echo form_close(); ?>
</div>

<script>
	$('#edit_in_inventory').parsley();
	FormPlugins.init();

	$('select:not(.normal)').each(function() {
		$(this).select2({
			dropdownParent: $(this).parent()
		});
	});
</script>