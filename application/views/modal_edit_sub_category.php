<?php echo form_open('sub_category/edit/' . $param2, array('id' => 'edit_sub_category', 'method' => 'post', 'data-parsley-validate' => 'true')); ?>
<?php $tenant_info = $this->db->get_where('sub_inventory', array('id' => $param2))->result_array();
foreach ($tenant_info as $tenant) :
    ?>
                        <div class="form-group">
                            <div>
                            <label><?php echo $this->lang->line('category_name'); ?> Category Name</label>
                            
                            
                            <input type="text" class="form-control" value="<?php  $service_costs = $tenant['inventory_id'];?> <?php echo $this->db->get_where('inventory_category', array('id' => $service_costs))->row()->category_name;?>" name="name" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?php echo $this->lang->line('category_name'); ?> Sub Category</label>
                            <input value="<?php echo html_escape($tenant['name']); ?>" name="sub_name" type="text" class="form-control"  placeholder="<?php echo $this->lang->line('category'); ?>"/>
                        </div>
	<button type="submit" class="mb-sm btn btn-primary"><?php echo $this->lang->line('update'); ?></button>
	<?php endforeach; ?>
<?php echo form_close(); ?>

<script>
	$('#edit_sub_category').parsley();
	FormPlugins.init();

	$('select:not(.normal)').each(function() {
		$(this).select2({
			dropdownParent: $(this).parent()
		});
	});
</script>