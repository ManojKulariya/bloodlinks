<?php
	$count = 1;
	$tenant_details = $this->db->get_where('tenant', array('tenant_id' => $param2))->result_array();
	foreach ($tenant_details as $tenant):
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
					<td><?php echo $this->lang->line(''); ?>Date Of Birth</td>
					<td><?php echo $tenant['dob'] ? html_escape($tenant['dob']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line('email'); ?></td>
					<td><?php echo $tenant['email'] ? html_escape($tenant['email']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line('profession'); ?></td>
					<td><?php echo $tenant['profession_id'] ? html_escape($this->db->get_where('profession', array('profession_id' => $tenant['profession_id']))->row()->name) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line('lease_period'); ?></td>
					<td><?php echo ($tenant['lease_start'] ? date('d M, Y', $tenant['lease_start']) : 'N/A') . ' to ' . ($tenant['lease_end'] ? date('d M, Y', $tenant['lease_end']) : 'N/A'); ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Age</td>
					<td><?php echo $tenant['age'] == '<br>' ? 'N/A' : $tenant['age']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Security Amount</td>
					<td><?php echo $tenant['security_amount'] == '<br>' ? 'N/A' : $tenant['security_amount']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Father Name</td>
					<td><?php echo $tenant['father_name'] == '<br>' ? 'N/A' : $tenant['father_name']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Father Contact</td>
					<td><?php echo $tenant['father_contact'] == '<br>' ? 'N/A' : $tenant['father_contact']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Father Email</td>
					<td><?php echo $tenant['father_email'] == '<br>' ? 'N/A' : $tenant['father_email']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Mother Name</td>
					<td><?php echo $tenant['mother_name'] == '<br>' ? 'N/A' : $tenant['mother_name']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Mother Contact No.</td>
					<td><?php echo $tenant['mother_contact'] == '<br>' ? 'N/A' : $tenant['mother_contact']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Mother Email</td>
					<td><?php echo $tenant['mother_email'] == '<br>' ? 'N/A' : $tenant['mother_email']; ?></td>
				</tr>
				
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Religion</td>
					<td><?php echo $tenant['religion'] == '<br>' ? 'N/A' : $tenant['religion']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>National</td>
					<td><?php echo $tenant['national'] == '<br>' ? 'N/A' : $tenant['national']; ?></td>
				</tr>
				
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Emergency Person</td>
					<td><?php echo $tenant['emergency_person'] == '<br>' ? 'N/A' : $tenant['emergency_person']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Blood Group</td>
					<td><?php echo $tenant['blood_group'] == '<br>' ? 'N/A' : $tenant['blood_group']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Medical Allergy</td>
					<td><?php echo $tenant['medical_allergy'] == '<br>' ? 'N/A' : $tenant['medical_allergy']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Food Allergy</td>
					<td><?php echo $tenant['food_allergy'] == '<br>' ? 'N/A' : $tenant['food_allergy']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Course</td>
					<td><?php echo $tenant['course'] == '<br>' ? 'N/A' : $tenant['course']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Accommodation</td>
					<td><?php echo $tenant['accommodation'] == '<br>' ? 'N/A' : $tenant['accommodation']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Reference</td>
					<td><?php echo $tenant['reference'] == '<br>' ? 'N/A' : $tenant['reference']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Emergency Contact</td>
					<td><?php echo $tenant['emergency_contact'] == '<br>' ? 'N/A' : $tenant['emergency_contact']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Emergency Email</td>
					<td><?php echo $tenant['emergency_email'] == '<br>' ? 'N/A' : $tenant['emergency_email']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Purpose Of Stay</td>
					<td><?php echo $tenant['purpose_of_stay'] == '<br>' ? 'N/A' : $tenant['purpose_of_stay']; ?></td>
				</tr>
					<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>PAN Number</td>
					<td><?php echo $tenant['pan_number'] == '<br>' ? 'N/A' : $tenant['pan_number']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line(''); ?>Id Type</td>
					<td><?php echo $tenant['id_type_id'] == '<br>' ? 'N/A' : $tenant['id_type_id']; ?></td>
				</tr>
				
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line('home_address'); ?></td>
					<td><?php echo $tenant['home_address'] == '<br>' ? 'N/A' : $tenant['home_address']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line('work_address'); ?></td>
					<td><?php echo $tenant['work_address'] == '<br>' ? 'N/A' : $tenant['work_address']; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line('extra_note'); ?></td>
					<td><?php echo $tenant['extra_note']?  html_escape($tenant['extra_note']) : 'N/A'; ?></td>
				</tr>
				
				<tr>
					<td><?php echo $count++; ?></td>
					<td>Reference Contact</td>
					<td><?php echo $tenant['reference_contact']?  html_escape($tenant['reference_contact']) : 'N/A'; ?></td>
				</tr>
								<tr>
					<td><?php echo $count++; ?></td>
					<td>Reference Organization	</td>
					<td><?php echo $tenant['reference_organization']?  html_escape($tenant['reference_organization']) : 'N/A'; ?></td>
				</tr>
				
				<tr>
					<td><?php echo $count++; ?></td>
					<td>Agreement</td>
				 <td class="with-img">
                    <?php if ($tenant['agreement']) : ?>
                    <a href="<?php echo base_url(); ?>uploads/tenants/<?php echo html_escape($tenant['agreement']); ?>" target="_blank"><?php echo base_url(); ?>uploads/tenants/<?php echo html_escape($tenant['agreement']); ?></a>
                    <?php endif; ?>
                </td>
                </tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td>Image</td>
				 <td class="with-img">
                    <?php if ($tenant['image_link']) : ?>
                    <a href="<?php echo base_url(); ?>uploads/tenants/<?php echo html_escape($tenant['image_link']); ?>" target="_blank"><?php echo base_url(); ?>uploads/tenants/<?php echo html_escape($tenant['image_link']); ?></a>
                    <?php endif; ?>
                </td>
                </tr>
                <td><?php echo $count++; ?></td>
					<td>Id Front Image</td>
				 <td class="with-img">
                    <?php if ($tenant['id_front_image_link']) : ?>
                    <a href="<?php echo base_url(); ?>uploads/tenants/<?php echo html_escape($tenant['id_front_image_link']); ?>" target="_blank"><?php echo base_url(); ?>uploads/tenants/<?php echo html_escape($tenant['id_front_image_link']); ?></a>
                    <?php endif; ?>
                </td>
                </tr>
                <td><?php echo $count++; ?></td>
					<td>Id Back Image</td>
				 <td class="with-img">
                    <?php if ($tenant['id_back_image_link']) : ?>
                    <a href="<?php echo base_url(); ?>uploads/tenants/<?php echo html_escape($tenant['id_back_image_link']); ?>" target="_blank"><?php echo base_url(); ?>uploads/tenants/<?php echo html_escape($tenant['id_back_image_link']); ?></a>
                    <?php endif; ?>
                </td>
                </tr>
				
				<tr>
					<td><?php echo $count++; ?></td>
					<td>Reference Organization</td>
					<td><?php echo $tenant['reference_organization']?  html_escape($tenant['reference_organization']) : 'N/A'; ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line('created_on'); ?></td>
					<td><?php echo date('d M, Y', $tenant['created_on']); ?></td>
				</tr>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $this->lang->line('created_by'); ?></td>
					<td>
						<?php
							$user_type =  $this->db->get_where('user', array('user_id' => $tenant['created_by']))->row()->user_type;
							if ($user_type == 1) {
								echo 'Admin';
							} else {
								$person_id = $this->db->get_where('user', array('user_id' => $tenant['created_by']))->row()->person_id;
								echo html_escape($this->db->get_where('staff', array('staff_id' => $person_id))->row()->name);
							}
						?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
<?php endforeach; ?>
