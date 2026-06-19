<?php
	$count = 1;
	$inventory_details = $this->db->get_where('inventory', array('id' => $param2))->result_array();
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
					<td><?php echo $this->lang->line(''); ?>Inventory Category</td>
					<td><?php echo $inventory['inventory_category'] ? html_escape($inventory['inventory_category']) : 'N/A'; ?></td>
				</tr>
					<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Category Type </td>
					<td><?php echo $inventory['category_type'] ? html_escape($inventory['category_type']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Inventory Name</td>
					<td><?php echo $inventory['name'] ? html_escape($inventory['name']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Quantity</td>
					<td><?php echo $inventory['quantity'] ? html_escape($inventory['quantity']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Vendor Name</td>
					<td><?php echo $inventory['vendor_name'] ? html_escape($inventory['vendor_name']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Vendor address</td>
					<td><?php echo $inventory['vendor_address'] ? html_escape($inventory['vendor_address']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Vendor Contact</td>
					<td><?php echo $inventory['vendor_contact'] ? html_escape($inventory['vendor_contact']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Bill</td>
					<td><?php echo $inventory['bill'] ? html_escape($inventory['bill']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Warranty From</td>
					<td><?php echo $inventory['warranty_from'] ? html_escape($inventory['warranty_from']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Warranty To</td>
					<td><?php echo $inventory['warranty_to'] ? html_escape($inventory['warranty_to']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Services</td>
					<td><?php echo $inventory['services'] ? html_escape($inventory['services']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>service</td>
					<td><?php echo $inventory['service'] ? html_escape($inventory['service']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>In Inventory</td>
					<td><?php echo $inventory['in_inventory'] ? html_escape($inventory['in_inventory']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Out Inventory</td>
					<td><?php echo $inventory['out_inventory'] ? html_escape($inventory['out_inventory']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Total Item </td>
					<td><?php echo $inventory['total'] ? html_escape($inventory['total']) : 'N/A'; ?></td>
				</tr>
				
				
			</tbody>
		</table>
	</div>
<?php endforeach; ?>
