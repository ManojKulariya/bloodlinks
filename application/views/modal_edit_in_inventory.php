<?php echo form_open('inventory/update/' . $param2, array('id' => 'edit_in_inventory', 'method' => 'post', 'data-parsley-validate' => 'true')); ?>
<?php
$inventory = $this->db->get_where('inventory', array('id' => $param2))->result_array();
foreach ($inventory as $row) :
?>
<div class="form-group">
		<label><?php echo $this->lang->line('Id'); ?> Id</label>
		<input value="<?php echo $row['id']; ?>" type="text" name="id" placeholder="<?php echo $this->lang->line('id'); ?>" class="form-control" data-parsley-required="true" readonly>
	</div>
	<div class="form-group">
		<label><?php echo $this->lang->line('name'); ?> Name</label>
		<input value="<?php echo $row['name']; ?>" type="text" name="name" placeholder="<?php echo $this->lang->line('name'); ?>" class="form-control" data-parsley-required="true" readonly>
	</div>
	 <div class="form-group">
        <label><?php echo $this->lang->line('in Inventory'); ?> In Inventory</label>
            <input name="in_inventory" type="text" class="form-control"  placeholder="<?php echo $this->lang->line('in_inventory'); ?>" data-parsley-required="true" />
    </div>
    <div class="form-group">
        <label><?php echo $this->lang->line(''); ?> Remark</label>
            <input name="remark" type="text" class="form-control"  placeholder="<?php echo $this->lang->line('remark'); ?>" />
    </div>


	<button type="submit" class="mb-sm btn btn-primary"><?php echo $this->lang->line('update'); ?></button>
<?php endforeach; ?>
<?php echo form_close(); ?>

<script>
	$('#edit_in_inventory').parsley();
	FormPlugins.init();

	$('select:not(.normal)').each(function() {
		$(this).select2({
			dropdownParent: $(this).parent()
		});
	});
</script>