<?php echo form_open('expenses/edit/' . $param2, array('id' => 'edit_expense', 'method' => 'post', 'data-parsley-validate' => 'true')); ?>
<?php
$staff_attendance = $this->db->get_where('staff_attendance', array('id' => $param2))->result_array();
foreach ($staff_attendance as $row) :
?>
	<div class="form-group">
		<label><?php echo $this->lang->line('name'); ?> *</label>
		<input value="<?php echo $row['name']; ?>" type="text" name="name" placeholder="<?php echo $this->lang->line('name'); ?>" class="form-control" data-parsley-required="true">
	</div>
	 <div class="form-group">
        <label><?php echo $this->lang->line('out_date'); ?> Check Out (mm/dd/yyyy) *</label>
            <input name="check_out" type="datetime-local" class="form-control"  placeholder="<?php echo $this->lang->line('check out'); ?>" data-parsley-required="true" />
    </div>


	<button type="submit" class="mb-sm btn btn-primary"><?php echo $this->lang->line('update'); ?></button>
<?php endforeach; ?>
<?php echo form_close(); ?>

<script>
	$('#edit_expense').parsley();
	FormPlugins.init();

	$('select:not(.normal)').each(function() {
		$(this).select2({
			dropdownParent: $(this).parent()
		});
	});
</script>