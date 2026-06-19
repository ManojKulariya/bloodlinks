
<?php echo form_open_multipart('tenants/update/' . $param2, array('id' => 'edit_tenant', 'method' => 'post', 'data-parsley-validate' => 'true')); ?>
<?php
$tenant_info = $this->db->get_where('tenant', array('tenant_id' => $param2))->result_array();
foreach ($tenant_info as $tenant) :
?>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label><?php echo $this->lang->line('name'); ?> *</label>
				<input value="<?php echo html_escape($tenant['name']); ?>" type="text" name="name" placeholder="<?php echo $this->lang->line('enter_name'); ?>" class="form-control"  >
			</div>
			<div class="form-group">
				<label><?php echo $this->lang->line('mobile'); ?> *</label>
				<input value="<?php echo html_escape($tenant['mobile_number']); ?>" type="text" name="mobile_number" placeholder="<?php echo $this->lang->line('enter_mobile_number'); ?>" class="form-control"  >
			</div>
			<div class="form-group">
			<label><?php echo $this->lang->line('email'); ?> (<?php echo $this->lang->line('for_tenant_login'); ?>)</label>
				<?php
				if ($this->db->get_where('user', array('user_type' => 3, 'person_id' => $tenant['tenant_id']))->num_rows() > 0) {
					$tenant_email = $this->db->get_where('user', array('user_type' => 3, 'person_id' => $tenant['tenant_id']))->row()->email;
				} else {
					$tenant_email = '';
				}
				?>
				<input value="<?php echo html_escape($tenant['email']); ?>" type="email" name="email" placeholder="<?php echo $this->lang->line('enter_email'); ?>" class="form-control">
			</div>
			<?php if (!$tenant_email) : ?>
			
				<div class="form-group">
					<label><?php echo $this->lang->line('password'); ?> (<?php echo $this->lang->line('for_tenant_login'); ?>)</label>
					<input type="text" name="password" id="password-indicator-visible" class="form-control m-b-5">
					<div id="passwordStrengthDiv2" class="is0 m-t-5"></div>
				</div>
				<div class="note note-yellow m-b-15">
					<span><?php echo $this->lang->line('default_password'); ?></span>
				</div>
			<?php endif; ?>
			<div class="form-group">
				<label><?php echo $this->lang->line('id_type'); ?></label>
				<div>
					<select style="width: 100%" class="form-control default-select2" name="id_type_id">
						<option value=""><?php echo $this->lang->line('select_id_type'); ?></option>
						<?php
						$id_types = $this->db->get('id_type')->result_array();
						foreach ($id_types as $id_type) :
						?>
							<option <?php if ($id_type['id_type_id'] == $tenant['id_type_id']) echo 'selected'; ?> value="<?php echo html_escape($id_type['id_type_id']); ?>"><?php echo html_escape($id_type['name']); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			 <div class="form-group">
                                <label><?php echo $this->lang->line('father Name'); ?>Father Name</label>
                             <input value="<?php echo html_escape($tenant['father_name']); ?>" type="text" name="father_name" placeholder="<?php echo $this->lang->line('father_name'); ?>" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label><?php echo $this->lang->line('father Contact'); ?>Father Contact No.</label>
                             <input value="<?php echo html_escape($tenant['father_contact']); ?>" type="number" name="father_contact" placeholder="<?php echo $this->lang->line('father_number'); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label><?php echo $this->lang->line('father email'); ?>Father email</label>
                             <input value="<?php echo html_escape($tenant['father_email']); ?>" type="text" name="father_email" placeholder="<?php echo $this->lang->line('father_email'); ?>" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label><?php echo $this->lang->line('Mother Name'); ?>Mother Name</label>
                             <input value="<?php echo html_escape($tenant['mother_name']); ?>" type="text" name="mother_name" placeholder="<?php echo $this->lang->line('mother_name'); ?>" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label><?php echo $this->lang->line('mother Contact'); ?>Mother Contact No.</label>
                             <input value="<?php echo html_escape($tenant['mother_contact']); ?>" type="number" name="mother_contact" placeholder="<?php echo $this->lang->line('mother_number'); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label><?php echo $this->lang->line('mother email'); ?>Mother email</label>
                             <input type="text" name="mother_email" placeholder="<?php echo $this->lang->line('mother_email'); ?>" class="form-control">
                            </div>
                            
                            
                            <div class="form-group">
                                <label><?php echo $this->lang->line('age'); ?>Age</label>
                             <input value="<?php echo html_escape($tenant['age']); ?>" type="text" name="age" placeholder="<?php echo $this->lang->line('age'); ?>" class="form-control"  >
                            </div>
                            <div class="form-group">
                                <label><?php echo $this->lang->line('dob'); ?>DOB</label>
                             <input value="<?php echo html_escape($tenant['dob']); ?>" type="date" name="dob" placeholder="<?php echo $this->lang->line('dob'); ?>" class="form-control"  >
                            </div>
                            <div class="form-group">
                                <label><?php echo $this->lang->line('national'); ?>National</label>
                             <input value="<?php echo html_escape($tenant['national']); ?>" type="text" name="national" placeholder="<?php echo $this->lang->line('national'); ?>" class="form-control"  >
                            </div>
                            <div class="form-group">
                                <label><?php echo $this->lang->line('religion'); ?>Religion</label>
                             <input value="<?php echo html_escape($tenant['religion']); ?>" type="text" name="religion" placeholder="<?php echo $this->lang->line('religion'); ?>" class="form-control"  >
                            </div>
                            <div class="form-group">
                                <label><?php echo $this->lang->line(''); ?>Security Amount</label>
                                <input value="<?php echo html_escape($tenant['security_amount']); ?>" name="security_amount" type="text" placeholder="<?php echo $this->lang->line(''); ?>Security Amount" class="form-control">
                            </div>
                            
                            <!--new-->
                            <div class="form-group">
                                <label><?php echo $this->lang->line('PAN Number'); ?>PAN Number</label>
                                <input value="<?php echo html_escape($tenant['pan_number']); ?>" name="pan_number" type="text" placeholder="<?php echo $this->lang->line('pan_number'); ?>" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label><?php echo $this->lang->line('id_type'); ?></label>
                                <select  value="<?php echo html_escape($tenant['id_type_id']); ?>" style="width: 100%" class="form-control default-select2" name="id_type_id">
                                    <option value="not"><?php echo $this->lang->line('select_id_type'); ?></option>
                                    <?php
                                    $id_types = $this->db->get('id_type')->result_array();
                                    foreach ($id_types as $id_type) :
                                    ?>
                                        <option value="<?php echo html_escape($id_type['id_type_id']); ?>"><?php echo html_escape($id_type['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            
                			<div class="form-group">
                				<label><?php echo $this->lang->line('id_number'); ?></label>
                				<input value="<?php echo html_escape($tenant['id_number']); ?>" name="id_number" type="text" placeholder="<?php echo $this->lang->line('enter_id_number'); ?>" class="form-control">
                			</div>
                			<div class="form-group">
                				<label><?php echo $this->lang->line(''); ?>Date Of Occupancy</label>
                				<div class="input-group input-daterange">
                					<input type="text" class="form-control" value="<?php echo $tenant['lease_start'] ? date('m/d/Y', $tenant['lease_start']) : ''; ?>" name="lease_start" placeholder="<?php echo $this->lang->line('date_start'); ?>" />
                					<span class="input-group-addon">to</span>
                					<input type="text" class="form-control" value="<?php echo $tenant['lease_end'] ? date('m/d/Y', $tenant['lease_end']) : ''; ?>" name="lease_end" placeholder="<?php echo $this->lang->line('date_end'); ?>" />
                				</div>
                			</div>
                			<div class="form-group">
                				<label><?php echo $this->lang->line('home_address'); ?></label>
                				<input value="<?php echo html_escape(explode('<br>', $tenant['home_address'])[0]); ?>" name="home_address_line_1" type="text" placeholder="<?php echo $this->lang->line('enter_home_address_line_1'); ?>" class="form-control">
                			</div>
                			<div class="form-group">
                				<input value="<?php echo html_escape(explode('<br>', $tenant['home_address'])[1]); ?>" name="home_address_line_2" type="text" placeholder="<?php echo $this->lang->line('enter_home_address_line_2'); ?>" class="form-control">
                			</div>
                			<div class="form-group">
                				<label><?php echo $this->lang->line('emergency_person'); ?></label>
                				<input value="<?php echo html_escape($tenant['emergency_person']); ?>" type="text" name="emergency_person" placeholder="<?php echo $this->lang->line('enter_emergency_person_name'); ?>" class="form-control">
                			</div>
                		</div>
                
            		<div class="col-md-6">
            			<div class="form-group">
            				<label><?php echo $this->lang->line('emergency_contact'); ?></label>
            				<input value="<?php echo html_escape($tenant['emergency_contact']); ?>" type="text" name="emergency_contact" placeholder="<?php echo $this->lang->line('enter_emergency_person_mobile_number'); ?>" class="form-control">
            			</div>
            			<div class="form-group">
    				<label><?php echo $this->lang->line('room'); ?></label>
    				<div>
					<select style="width: 100%" class="form-control default-select2" name="room_id">
						<option value=""><?php echo $this->lang->line('select_room'); ?></option>
						<?php if ($tenant['room_id'] > 0) : ?>
							<option value="<?php echo html_escape($tenant['room_id']); ?>" selected><?php echo html_escape($this->db->get_where('room', array('room_id' => $tenant['room_id']))->row()->room_number); ?></option>
						<?php
						endif;
						$rooms = $this->db->get_where('room', array('status' => 0))->result_array();
						foreach ($rooms as $room) :
						?>
							<option value="<?php echo html_escape($room['room_id']); ?>"><?php echo html_escape($room['room_number']); ?></option>
						<?php endforeach; ?>
    					</select>
            				</div>
            			</div>
			            <div class="form-group">
                                <label><?php echo $this->lang->line(''); ?>Purpose Of Stay</label>
                             <input value="<?php echo html_escape($tenant['purpose_of_stay']); ?>" type="text" name="purpose_of_stay" placeholder="<?php echo $this->lang->line('emergency_email'); ?>Purpose Of Stay" class="form-control">
                            </div>
        			    <div class="note note-yellow m-b-15">
        				<span><?php echo $this->lang->line('to_assign_room'); ?>.</span>
        			    </div>
        			    <div class="form-group">
        				<label><?php echo $this->lang->line('profession'); ?></label>
        				<div>
        					<select style="width: 100%" class="form-control default-select2" name="profession_id">
    						<option value=""><?php echo $this->lang->line('select_profession'); ?></option>
						<?php
						$professions = $this->db->get('profession')->result_array();
						foreach ($professions as $profession) :
						?>
							<option <?php if ($profession['profession_id'] == $tenant['profession_id']) echo 'selected'; ?> value="<?php echo html_escape($profession['profession_id']); ?>"><?php echo html_escape($profession['name']); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label><?php echo $this->lang->line('work_address'); ?></label>
				<input value="<?php echo html_escape(explode('<br>', $tenant['work_address'])[0]); ?>" name="work_address_line_1" type="text" placeholder="<?php echo $this->lang->line('enter_work_address_line_1'); ?>" class="form-control">
			</div>
			<div class="form-group">
				<input value="<?php echo html_escape(explode('<br>', $tenant['work_address'])[1]); ?>" name="work_address_line_2" type="text" placeholder="<?php echo $this->lang->line('enter_work_address_line_2'); ?>" class="form-control">
			</div>
			<div class="form-group">
                                <label><?php echo $this->lang->line('Blood Group'); ?>Blood Group</label>
                            <select value="<?php echo html_escape($tenant['blood_group']); ?>" style="width: 100%" class="form-control"  name="blood_group">
							
							
							<option value="<?=$tenant['blood_group']?>"><?=$tenant['blood_group']?></option>
							<option <?php if ($tenant['blood_group'] == "A+") echo 'selected'; ?> value="A+">A+</option>
                            <option <?php if ($tenant['blood_group'] == "B+") echo 'selected'; ?>value="B+">B+</option>
                            <option <?php if ($tenant['blood_group'] == "O-") echo 'selected'; ?>value="O-">O-</option>
                            <option <?php if ($tenant['blood_group'] == "AB-") echo 'selected'; ?>value="AB-">O+</option>
                            <option <?php if ($tenant['blood_group'] == "AB+"){ echo 'selected';}else{} ?>value="AB+">AB+</option>
                        	<option <?php if ($tenant['blood_group'] == "A-") echo 'selected'; ?>value="A-">A-</option>
                            <option <?php if ($tenant['blood_group'] == "B-") echo 'selected'; ?>value="B-">B-</option>
                            <option <?php if ($tenant['blood_group'] == "AB-") echo 'selected'; ?>value="AB-">AB-</option>
                        </select>
                        </div>
                        
                        <div class="form-group">
                                <label><?php echo $this->lang->line(''); ?>Agreement</label>
                                <a href="<?php echo base_url(); ?>uploads/tenants/<?php echo html_escape($tenant['agreement']); ?>" target="_blank"><?php echo html_escape($tenant['agreement']); ?></a>
                                <span class="btn btn-primary fileinput-button">
                                    <i class="fa fa-plus"></i>
                                    <span><?php echo $this->lang->line('add_file'); ?></span>
                                    <input  class="form-control" type="file" name="agreement">
                                </span>
                            </div>
                        
                            
                         <div class="form-group">
                                <label><?php echo $this->lang->line('program/Course'); ?>Program / Course</label>
                                <input  value="<?php echo html_escape($tenant['course']); ?>" type="text" name="course" placeholder="<?php echo $this->lang->line('course'); ?>" class="form-control">
                            
                        </div>
                        <div class="form-group">
                                <label><?php echo $this->lang->line('Session'); ?>Session</label>
                                <input value="<?php echo html_escape($tenant['session']); ?>" type="text" name="session" placeholder="<?php echo $this->lang->line('session'); ?>" class="form-control">
                            
                        </div>
                        
                        <div class="form-group">
                                <label><?php echo $this->lang->line('medical allergy'); ?>Medical Allergy</label>
                                <input value="<?php echo html_escape($tenant['medical_allergy']); ?>" type="text" name="medical_allergy" placeholder="<?php echo $this->lang->line('medical_allergy'); ?>" class="form-control">
                            
                        </div>
                           <div class="form-group">
                                <label><?php echo $this->lang->line('Food_Allergy'); ?>Food Allergy</label>
                                <input value="<?php echo html_escape($tenant['food_allergy']); ?>" type="text" name="food_allergy" placeholder="<?php echo $this->lang->line('food_allergy'); ?>" class="form-control">
                            </div> 
                            <div class="form-group">
                                <label><?php echo $this->lang->line('Occupation'); ?>Occupation</label>
                                <input value="<?php echo html_escape($tenant['occupation']); ?>" type="text" name="occupation" placeholder="<?php echo $this->lang->line('occupation'); ?>" class="form-control">
                            </div>  
                            <div class="form-group">
                                <label><?php echo $this->lang->line('accommodation'); ?>Accommodation Type </label>
                                <input <?php if ($tenant['accommodation'] == 'Single') echo 'checked="checked"'; ?> type="radio" name="accommodation" value="Single" placeholder="<?php echo $this->lang->line('accommodation'); ?>" >Single 
                                <input <?php if ($tenant['accommodation']==  'Double') echo 'checked="checked"'; ?> type="radio" name="accommodation" value="Double" placeholder="<?php echo $this->lang->line('accommodation'); ?>" > Double 
                                <input <?php if ($tenant['accommodation'] == 'Triple') echo 'checked="checked"'; ?>  type="radio" name="accommodation" value="Triple" placeholder="<?php echo $this->lang->line('accommodation'); ?>"> Triple 
                             </div>  
                           
                			<div class="form-group">
                				<label><?php echo $this->lang->line('status'); ?> *</label>
                				<div>
                					<select value="<?php echo html_escape($tenant['status']); ?>" style="width: 100%" class="form-control default-select2"   name="status">
                						<option value=""><?php echo $this->lang->line('select_status'); ?></option>
                						<option <?php if ($tenant['status'] == 1) echo 'selected'; ?> value="1"><?php echo $this->lang->line('active'); ?></option>
                						<option <?php if ($tenant['status'] == 0) echo 'selected'; ?> value="0"><?php echo $this->lang->line('inactive'); ?></option>
                					</select>
                				</div>
                			</div>
                			<div class="note note-yellow m-b-15">
                				<span><?php echo $this->lang->line('to_activate_tenant'); ?>.</span>
                			</div>
                			<div class="form-group">
                				<label><?php echo $this->lang->line('extra_note'); ?></label>
                				<textarea style="resize: none" type="text" name="extra_note" placeholder="<?php echo $this->lang->line('enter_extra_note'); ?>" class="form-control"><?php echo html_escape($tenant['extra_note']); ?></textarea>
                			</div>
                            <div class="form-group">
                                <label><?php echo $this->lang->line(''); ?>Reference</label>
                                <input type="text" name="reference" placeholder="<?php echo $this->lang->line('reference'); ?>reference" class="form-control">
                            </div>
            
                            <div class="form-group">
                                <label><?php echo $this->lang->line(''); ?>Reference Contact</label>
                             <input type="text" name="reference_contact" placeholder="<?php echo $this->lang->line('reference_contact'); ?>reference_contact" class="form-control">
                            </div>

                            <div class="form-group">
                                <label><?php echo $this->lang->line(''); ?>Reference Organization</label>
                             <input type="text" name="reference_organization" placeholder="<?php echo $this->lang->line('reference_organization'); ?>reference_organization" class="form-control">
                            </div>
		</div>
	</div>

	<button type="submit" class="mb-sm btn btn-primary"><?php echo $this->lang->line('update'); ?></button>
<?php endforeach; ?>
<?php echo form_close(); ?>

<script>
	$('#edit_tenant').parsley();
	FormPlugins.init();

	$('.modal-dialog').css('max-width', '1080px');

	$('select:not(.normal)').each(function() {
		$(this).select2({
			dropdownParent: $(this).parent()
		});
	});
</script>