<?php
	$count = 1;
	$inventory_details = $this->db->get_where('invoice', array('invoice_id' => $param2))->result_array();
	foreach ($inventory_details as $inventory):
?>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th><b><?php echo $this->lang->line('name'); ?></b></th>
					<th><b><?php echo $this->lang->line('content'); ?></b></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Tenant Name</td>
					<td><?php echo $inventory['tenant_name'] ? html_escape($inventory['tenant_name']) : 'N/A'; ?></td>
				</tr>
					<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Tenant Mobile </td>
					<td><?php echo $inventory['tenant_mobile'] ? html_escape($inventory['tenant_mobile']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Room Number</td>
					<td><?php echo $inventory['room_number'] ? html_escape($inventory['room_number']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Room Amount</td>
					<td><?php echo $inventory['amount'] ? html_escape($inventory['amount']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Tax</td>
					<td><?php echo $inventory['tax'] ? html_escape($inventory['tax']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Discount Amount</td>
					<td><?php echo $inventory['discount'] ? html_escape($inventory['discount']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Tax Amount</td>
					<td><?php echo $inventory['tax_amount'] ? html_escape($inventory['tax_amount']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Total Amount</td>
					<td><?php echo $inventory['total_amount'] ? html_escape($inventory['total_amount']) : 'N/A'; ?></td>
				</tr>
					
				
			</tbody>
		</table>
	</div>
<?php endforeach; ?>
