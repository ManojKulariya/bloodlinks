<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
	.hide {
  display: none;
}
.content-wrapper {
    background: #f4f6f9;
    text-transform: capitalize;
}
  .content-header h1 {
    font-size: 18px;
    /* margin: 0 20px; */
    font-weight: bold;
}
.breadcrumb-item a {
    color: #ad1e1d;
}
.form-control{
height: calc(1.70rem + 2px) !important;
	}
.form-group {
    margin-bottom: 5px;
}
label:not(.form-check-label):not(.custom-file-label) {
    /* font-size: 12px; */
}
</style>
<div class="row m-3 p-2">
  <div class="col-12">


  	<div class="card">
  		<div class="card-header">
  			<h3 class="card-title">Lab Details </h3>
  			<div class="btn-group" style="float: right;">
	      	<a href="<?php echo $base_url;?>/labs" data-toggle="tooltip" title="" class="btn btn-sm btn-default" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
	      </div> 
  		</div>
  		<div class="card-body">
  			<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="nav-item">
	              <a class="nav-link <?php echo (!session_userdata('next_step'))?'active':'';?>" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Basic Informations</a>
	            </li>
	          <!--   <li class="nav-item">
	                <a class="nav-link <?php echo (session_userdata('next_step') && in_array(session_userdata('next_step'),array('mics_details')))?'active':'';?>" <?php echo (isset($blood_bank_data))?'id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"':'';?>>Miscellaneous Informations</a>
	            </li>
	            <li class="nav-item">
	                <a class="nav-link <?php echo (session_userdata('next_step') && in_array(session_userdata('next_step'),array('doc_details')))?'active':'';?>" <?php echo (isset($blood_bank_data))?'id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false"':'';?>>Documents</a>
	            </li> -->
            </ul>
            <div class="tab-content" id="custom-tabs-one-tabContent">

                  <div class="tab-pane fade <?php echo (!session_userdata('next_step'))?'show active':'';?>" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                  	
	                    <form id="lab_basic_detail" role="form" novalidate>
	                    	<input type="hidden" name="data_tab">
	                    	<div class="col-md-12" style="padding: 20px;">

		                    	<div class="row">
					    		
									    			<div class="col-md-6">
										          <div class="form-group">
										            <label for="org_name">Lab Name</label>
										            <input type="text" class="form-control" name="org_name" id="org_name" placeholder="Enter Name" value="<?php echo (isset($blood_bank_data))?$blood_bank_data->name:'';?>">
										          </div>
										        </div>

										        <div class="col-md-6">
										         <div class="form-group">
										            <label for="org_short_name">Short Name</label>
										            <input type="text" class="form-control" name="org_short_name" id="org_short_name" placeholder="Enter short name" value="<?php echo (isset($blood_bank_data))?$blood_bank_data->short_name:'';?>">
										          </div>
										        </div>
						    					</div>

									    		<div class="row">

										        <div class="col-md-6">
										          <div class="form-group">
										            <label for="org_contact_name">Contact Person</label>
										            <input type="text" class="form-control" name="org_contact_name" id="org_contact_name" placeholder="Enter contact person name" value="<?php echo (isset($blood_bank_data))?$blood_bank_data->contact_person:'';?>">
										          </div>
										        </div>

										        <div class="col-md-6">
										          <div class="form-group">
										            <label for="org_email">Email</label>
										            <input type="text" class="form-control" name="org_email" id="org_email" placeholder="Enter Email address" oninput="$('#org_username').val($('#org_email').val())"  value="<?php echo (isset($blood_bank_data))?$blood_bank_data->contact_email:'';?>">
										          </div>
										        </div>
                                                </div>
												<div class="row">
										        <div class="col-md-6">
										          <div class="form-group">
										            <label for="org_ph_no">Contact No</label>
										            <input type="text" class="form-control" name="org_ph_no" id="org_ph_no" placeholder="Enter Contact no." value="<?php echo (isset($blood_bank_data))?$blood_bank_data->contact_ph_no:'';?>">
										          </div>
										        </div>
										        <div class="col-md-6">
										          <div class="form-group">
										            <label for="org_fax_no">Fax</label>
										            <input type="text" class="form-control" name="org_fax_no" id="org_fax_no" placeholder="Enter Fax no" value="<?php echo (isset($blood_bank_data))?$blood_bank_data->fax_no:'';?>">
										          </div>
										        </div>
									    		</div>
												
									    		<div class="row">

										        <div class="col-md-6">
										          <div class="form-group">
										            <label for="org_help_line_no">Helpline No</label>
										            <input type="text" class="form-control" name="org_help_line_no" id="org_help_line_no" placeholder="Enter Helpline No" value="<?php echo (isset($blood_bank_data))?$blood_bank_data->help_line_no:'';?>">
										          </div>
										        </div>


										        <div class="col-md-6">
										          <div class="form-group">
										            <label for="org_category">Category</label>
										            <select class="form-control" id="org_category" name="org_category" style="padding:0px !important;">
										            	<option value="0">Select category</option>
										            	<?php
										            	if(!empty($categories)){
										            		foreach ($categories as $key => $value) {
										            			?>
										            			<option value="<?php echo $value['category_id'];?>" <?php echo $value['selected'];?>><?php echo $value['category_name'];?></option>
										            			<?php
										            		}
										            	}
										            	?>
										            </select>
										          </div>
										        </div>
													</div>
													<div class="row">
                                                 <div class="col-md-6">
										          <div class="form-group">
										            <label for="latitude">Latitude</label>
										            <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Enter Latitude" value="<?php echo (isset($blood_bank_data))?$blood_bank_data->latitude:'';?>">
										          </div>
										        </div>
										         <div class="col-md-6">
										          <div class="form-group">
										            <label for="longitude">Longitude</label>
										            <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Enter Longitude" value="<?php echo (isset($blood_bank_data))?$blood_bank_data->longitude:'';?>">
										          </div>
										        </div>
						    					</div>

												
						    					<div class="row">
						    		
										    			<div class="col-md-6">
											          <div class="form-group">
											            <label for="org_state">State</label>
											            <select class="org_state form-control" id="org_state" name="org_state">
											            	<?php
											            	if(!empty($states)){
											            		foreach ($states as $key => $value) {
											            			?>
											            			<option value="<?php echo $value['state_id'];?>" <?php echo $value['selected'];?>><?php echo $value['state_name'];?></option>
											            			<?php
											            		}
											            	}

											            	?>
											            </select>
											          </div>
											        </div>

											        <div class="col-md-6">
											          <div class="form-group">
											            <label for="org_districs">District</label>
											            <select class="org_districs form-control" id="org_districs" name="org_districs">
											            	<option value="0">Select District</option>
											            	<?php
											            	if(!empty($districts)){
											            		foreach ($districts as $key => $value) {
											            			?>
											            			<option value="<?php echo $value['district_id'];?>" <?php echo $value['selected'];?>><?php echo $value['district_name'];?></option>
											            			<?php
											            		}
											            	}
											            	?>
											            </select>
											          </div>
											        </div>
													</div>
													<div class="row">
											        <div class="col-md-6">
											          <div class="form-group">
											            <label for="org_city">City</label>
											            <select class="org_city form-control" id="org_city" name="org_city" style="padding:0px !important;">
											            	<option value="0">Select City</option>
											            	<?php
											            	if(!empty($cities)){
											            		foreach ($cities as $key => $value) {
											            			?>
											            			<option value="<?php echo $value['city_id'];?>" <?php echo $value['selected'];?>><?php echo $value['city_name'];?></option>
											            			<?php
											            		}
											            	}
											            	?>
											            </select>
											          </div>
											        </div>

											        <div class="col-md-6">
											          <div class="form-group">
											            <label for="org_pincode">Pincode</label>
											            <input type="text" class="form-control" name="org_pincode" id="org_pincode" placeholder="Enter Pincode" value="<?php echo (isset($blood_bank_data))?$blood_bank_data->pincode:'';?>">
											          </div>
											        </div>

										    	</div>

										    	<div class="row">
										    		
										    			<div class="col-md-6">
											          <div class="form-group">
											            <label for="org_address1">Address 1</label>
											            <textarea class="form-control" name="org_address1" id="org_address1" placeholder="Enter Address 1" rows="4"><?php echo (isset($blood_bank_data))?$blood_bank_data->address_1:'';?></textarea>
											          </div>
											        </div>

											        <div class="col-md-6">
											          <div class="form-group">
											            <label for="org_address2">Address 2</label>
											            <textarea class="form-control" name="org_address2" id="org_address2" placeholder="Enter Address 2" rows="4"><?php echo (isset($blood_bank_data))?$blood_bank_data->address_2:'';?></textarea>
											          </div>
											        </div>

										    	</div>

						    					<div class="row">

						    						<div class="col-md-6">
										          <div class="form-group">
										            <label for="org_lic_no">Licence No</label>
										            <input type="text" class="form-control" name="org_lic_no" id="org_lic_no" placeholder="Enter Licence No" value="<?php echo (isset($blood_bank_data))?$blood_bank_data->lic_no:'';?>">
										          </div>
										        </div>

										        <div class="col-md-6">
										          <div class="form-group">
										            <label for="org_lic_valid_from">Licence Valid From</label>
										            <div class="input-group date" id="org_lic_valid_from_date" data-target-input="nearest">
								                  <input type="text" class="form-control datetimepicker-input" name="org_lic_valid_from" id="org_lic_valid_from" data-target="#org_lic_valid_from_date"  placeholder="Enter Licence Valid From" value="<?php echo (isset($blood_bank_data))?date('d-m-Y',strtotime($blood_bank_data->lic_valid_from)):'';?>"/>
						                        <div class="input-group-append" data-target="#org_lic_valid_from_date" data-toggle="datetimepicker">
						                          <div class="input-group-text"><i class="fa fa-calendar"></i></div>
						                        </div>
					                    	</div>
										          </div>
										        </div>
														</div>
														<div class="row">
									    			<div class="col-md-6">
										          <div class="form-group">
										            <label for="org_lic_valid_to">Licence Valid To</label>
										            <div class="input-group date" id="org_lic_valid_to_date" data-target-input="nearest">
						                      <input type="text" class="form-control datetimepicker-input" name="org_lic_valid_to" id="org_lic_valid_to" data-target="#org_lic_valid_to_date"  placeholder="Enter Licence Valid From" placeholder="Enter Licence Valid To" value="<?php echo (isset($blood_bank_data))?date('d-m-Y',strtotime($blood_bank_data->lic_valid_to)):'';?>"/>
						                      <div class="input-group-append" data-target="#org_lic_valid_to_date" data-toggle="datetimepicker">
						                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
						                      </div>
					                    	</div>
										          </div>
										        </div>

										        <div class="col-md-6">
										          <div class="form-group">
										            <label for="org_apheresis_facillity">Apheresis Facillity</label>
										            <select class="form-control" id="org_apheresis_facillity" name="org_apheresis_facillity" style="padding:0px !important;">
										            	<option value="yes" <?php echo (isset($blood_bank_data) && ($blood_bank_data->apheresis_facillity=='no'))?'selected':'';?>>Yes</option>
										            	<option value="no" <?php echo (isset($blood_bank_data) && ($blood_bank_data->apheresis_facillity=='no'))?'selected':'';?>>No</option>
										            </select>
										          </div>
										        </div>
										      </div>
                           <div class="row">
                           	   		
									    			<div class="col-md-6">
										          <div class="form-group">
										            <label for="org_component_facillity">Facillity</label>
										            <select class="form-control" id="org_component_facillity" name="org_component_facillity" style="padding:0px !important;">
										            	<option value="component" <?php echo (isset($blood_bank_data) && ($blood_bank_data->component_facillity=='component'))?'selected':'';?>>Yes</option>
										            	<option value="wb" <?php echo (isset($blood_bank_data) && ($blood_bank_data->component_facillity=='wb'))?'selected':'';?>>No</option>
										            	
										            </select>
										          </div>          
										        </div>

										        <div class="col-md-3 pt-2" id="components_div" style="display:<?php echo (isset($blood_bank_data) && ($blood_bank_data->component_facillity=="component")||"both")?'block':'none';?>;">

										        		<?php

										        		if(!empty($components)){
										        			foreach ($components as $key => $value) {
										        				?>
										        				<div class="form-group">
												        			<div class="custom-control custom-checkbox">
							                          <input class="custom-control-input" type="checkbox" name="org_available_components[]" id="org_available_components<?php echo $key;?>" value="<?php echo $value['component_id'];?>" <?php echo $value['selected'];?>>
							                          <label for="org_available_components<?php echo $key;?>" class="custom-control-label"><?php echo $value['component_value'];?> [<?php echo $value['component_short_value'];?>]</label>
							                        </div>
												        		</div>
										        				<?php
										        			}
										        		}

										        		?>
										        		
										        		

										        </div>
                           </div>
	                    		<div class="row">
				    		
					    			<div class="col-md-6">
							          <div class="form-group">
							            <label for="org_username">Username</label>
							            <input type="text" class="form-control" name="org_username" id="org_username" placeholder="Enter Username" value="<?php echo (isset($blood_bank_data))?$blood_bank_data->email:'';?>" disabled>
							          </div>
						        	</div>

						        	<div class="col-md-6">
							          <div class="form-group">
							            <label for="org_password">Password</label>
							            <input type="text" class="form-control" name="org_password" id="org_password" placeholder="Enter Paassword" value="<?php echo (isset($blood_bank_data))?'':'Password@123';?>">
							          </div>
						        	</div>

					    		</div>

						    	<div class="row">
						    		
						    		<div class="col-md-12">
						    			<div class="btn-group" style="float: right;">
						    				<button type="submit" class="btn btn-sm btn-danger" id="btn_save_basic_details"><i class="fas fa-save fw"></i> Save</button>
						    			</div>
						    		</div>

						    	</div>
						    </div>
						  </form>
	                
                  </div>

                  </div>

                </div>

            </div>
  		</div>
  	</div>

  </div>
</div>


<script type="text/javascript">
	var lab_id='<?php echo (isset($lab_id))?$lab_id:'';?>';
  	var lab_add_url='<?php echo $base_url;?>/labs_add';
  	var dist_search_url='<?php echo $base_url;?>/get_districts';
  	var city_search_url='<?php echo $base_url;?>/get_cities';
  	// var file_search_url='<?php echo $base_url;?>/labs_file_search';
  	// var file_delete_url='<?php echo $base_url;?>/labs_file_delete';
</script>
<script type="text/javascript">

function show1(){
  document.getElementById('div1').style.display = 'block';
}
function show2(){
  document.getElementById('div1').style.display = 'none';
}
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#org_component_facillity').on('change', function() {
      if ( this.value == 'wb')
      {
        $("#components_div").hide();
      }
      else
      {
        $("#components_div").show();
      }
    });
});
</script>