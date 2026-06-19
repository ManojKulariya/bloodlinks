

<form role="form" id="form_blood_bank_registrtion" novalidate="novalidate">
  		<div class="timeline">
  			<div class="time-label">
                <span class="bg-red">Basic Informations</span>
            </div>
		  	<div class="card">
		  		<div class="card-header">
			        <!-- <h3 class="card-title">Register Blood Bank</h3> -->
			        <div class="btn-group" style="float: right;">
			          <button type="submit" class="btn btn-sm btn-outline-danger btn_save_category" id="btn_save_category"><i class="fas fa-save fw"></i></button>
		      			<a href="<?php echo $base_url;?>/bloodbanks" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
			        </div>
			    </div>
			    <div class="card-body">
			    	<div class="row">
			    		
			    		<div class="col-md-6">
				          <div class="form-group">
				            <label for="org_name">Name</label>
				            <input type="text" class="form-control" name="org_name" id="org_name" placeholder="Enter Name">
				          </div>
				        </div>

				        <div class="col-md-6">
				          <div class="form-group">
				            <label for="org_parent_hospital">Parent Hospital</label>
				            <input type="text" class="form-control" name="org_parent_hospital" id="org_parent_hospital" placeholder="Enter Parent Hospital Name">
				          </div>
				        </div>

			    	</div>

			    	<div class="row">

			    		<div class="col-md-3">
				          <div class="form-group">
				            <label for="org_short_name">Short Name</label>
				            <input type="text" class="form-control" name="org_short_name" id="org_short_name" placeholder="Enter short name">
				          </div>
				        </div>
			    		
			    		<div class="col-md-3">
				          <div class="form-group">
				            <label for="org_category">Category</label>
				            <select class="form-control" id="org_category" name="org_category">
				            	
				            </select>
				          </div>
				        </div>

				        <div class="col-md-3">
				          <div class="form-group">
				            <label for="org_contact_name">Contact Person</label>
				            <input type="text" class="form-control" name="org_contact_name" id="org_contact_name" placeholder="Enter contact person name">
				          </div>
				        </div>

				        <div class="col-md-3">
				          <div class="form-group">
				            <label for="org_email">Email</label>
				            <input type="text" class="form-control" name="org_email" id="org_email" placeholder="Enter Email address">
				          </div>
				        </div>

				        

			    	</div>

			    	<div class="row">

			    		<div class="col-md-3">
				          <div class="form-group">
				            <label for="org_ph_no">Contact No</label>
				            <input type="text" class="form-control" name="org_ph_no" id="org_ph_no" placeholder="Enter Contact no.">
				          </div>
				        </div>
			    		
			    		<div class="col-md-3">
				          <div class="form-group">
				            <label for="org_fax_no">Fax</label>
				            <input type="text" class="form-control" name="org_fax_no" id="org_fax_no" placeholder="Enter Fax no">
				          </div>
				        </div>

				        <div class="col-md-3">
				          <div class="form-group">
				            <label for="org_lic_no">Licence No</label>
				            <input type="text" class="form-control" name="org_lic_no" id="org_lic_no" placeholder="Enter Licence No">
				          </div>
				        </div>

				        <div class="col-md-3">
				          <div class="form-group">
				            <label for="org_lic_valid_from">Licence Valid From</label>
				            <input type="text" class="form-control" name="org_lic_valid_from" id="org_lic_valid_from" placeholder="Enter Licence Valid From">
				          </div>
				        </div>

			    	</div>


			    	<div class="row">

			    		<div class="col-md-3">
				          <div class="form-group">
				            <label for="org_lic_valid_to">Licence Valid To</label>
				            <input type="text" class="form-control" name="org_lic_valid_to" id="org_lic_valid_to" placeholder="Enter Licence Valid To">
				          </div>
				        </div>
			    		
			    		<div class="col-md-3">
				          <div class="form-group">
				            <label for="org_component_facillity">Component Facillity</label>
				            <select class="form-control" id="org_component_facillity" name="org_component_facillity">
				            	<option value="yes">Yes</option>
				            </select>
				          </div>
				        </div>

				        <div class="col-md-3">
				          <div class="form-group">
				            <label for="org_apheresis_facillity">Apheresis Facillity</label>
				            <select class="form-control" id="org_apheresis_facillity" name="org_apheresis_facillity">
				            	<option value="yes">Yes</option>
				            </select>
				          </div>
				        </div>

				        <div class="col-md-3">
				          <div class="form-group">
				            <label for="org_help_line_no">Helpline No</label>
				            <input type="text" class="form-control" name="org_help_line_no" id="org_help_line_no" placeholder="Enter Helpline No">
				          </div>
				        </div>

			    	</div>

			    	<div class="row">
			    		
			    		<div class="col-md-3">
				          <div class="form-group">
				            <label for="org_state">State</label>
				            <select class="form-control" id="org_state" name="org_state">
				            	<option value="yes">Yes</option>
				            </select>
				          </div>
				        </div>

				        <div class="col-md-3">
				          <div class="form-group">
				            <label for="org_districs">District</label>
				            <select class="form-control" id="org_districs" name="org_districs">
				            	<option value="yes">Yes</option>
				            </select>
				          </div>
				        </div>

				        <div class="col-md-3">
				          <div class="form-group">
				            <label for="org_city">City</label>
				            <select class="form-control" id="org_city" name="org_city">
				            	<option value="yes">Yes</option>
				            </select>
				          </div>
				        </div>

				        <div class="col-md-3">
				          <div class="form-group">
				            <label for="org_pincode">Pincode</label>
				            <input type="text" class="form-control" name="org_pincode" id="org_pincode" placeholder="Enter Pincode">
				          </div>
				        </div>

			    	</div>

			    	<div class="row">
			    		
			    		<div class="col-md-6">
				          <div class="form-group">
				            <label for="org_address1">Address 1</label>
				            <textarea class="form-control" name="org_address1" id="org_address1" placeholder="Enter Address 1" rows="4"></textarea>
				          </div>
				        </div>

				        <div class="col-md-6">
				          <div class="form-group">
				            <label for="org_address2">Address 2</label>
				            <textarea class="form-control" name="org_address2" id="org_address2" placeholder="Enter Address 2" rows="4"></textarea>
				          </div>
				        </div>

			    	</div>

			    </div>
		  	</div>
		</div>

		<div class="timeline">
			<div class="time-label">
                <span class="bg-red">Donation Informations</span>
            </div>
            <div class="card timeline-item">
            	<div class="card-header">
	            	<h3 class="card-title">Donar Type</h3>
	            </div>
	            <div class="card-body timeline-body">
	            	

	            </div>
	        </div>
	        <div class="card timeline-item">
            	<div class="card-header">
	            	<h3 class="card-title">Donation Type</h3>
	            </div>
	            <div class="card-body timeline-body">
	            	

	            </div>
	        </div>
	        <div class="card timeline-item">
            	<div class="card-header">
	            	<h3 class="card-title">Component Type</h3>
	            </div>
	            <div class="card-body timeline-body">
	            	

	            </div>
	        </div>
          
            <div class="card timeline-item">
            	<div class="card-header">
	            	<h3 class="card-title">Bag Type</h3>
	            </div>
	            <div class="card-body timeline-body">
	            	

	            </div>
	        </div>


	        <div class="card timeline-item">
	        	<div class="card-header">
	            	<h3 class="card-title">TTI Type</h3>
	            </div>	            	
            	<div class="card-body timeline-body">
            		<div class="row">
            			<div class="col-sm-6">
            				<div class="form-group clearfix">
		                      <div class="icheck-danger d-inline">
		                        <input type="checkbox" id="checkboxPrimary1" value="HIV 1&2">
		                        <label for="checkboxPrimary1">HIV 1&2</label>
		                      </div>
		                    </div>
            			</div>
            		</div>
            		<div class="row"></div>
            	</div>
        	</div>
		</div>

		<div class="timeline">
			<div class="time-label">
                <span class="bg-red">Miscellaneous Informations</span>
            </div>
            <div class="card timeline-item">
            	<div class="card-header">
            		<h3 class="card-title">Charge/Tarrif Details</h3>
            	</div>
            	<div class="card-body timeline-body">
            		
            		<div class="row">
			    		
			    		<div class="col-md-6">
				          <div class="form-group">
				            <label for="org_tariff_name">Tarrif Name </label>
				            <input type="text" class="form-control" name="org_tariff_name" id="org_tariff_name" placeholder="Enter Tarrif Name">
				          </div>
				        </div>

				        <div class="col-md-6">
				          <div class="form-group">
				            <label for="org_tariff_charge">Charges In Rs </label>
				            <input type="text" class="form-control" name="org_tariff_charge" id="org_tariff_charge" placeholder="Enter Charges In Rs ">
				          </div>
				        </div>

			    	</div>

            	</div>
            </div>

            <div class="card timeline-item">
            	<div class="card-header">
            		<h3 class="card-title">Area Details</h3>
            	</div>
            	<div class="card-body timeline-body">
            		
            		<div class="row">
			    		
			    		<div class="col-md-4">
				          <div class="form-group">
				            <label for="org_area_name">Area Name </label>
				            <input type="text" class="form-control" name="org_area_name" id="org_area_name" placeholder="Enter Area Name">
				          </div>
				        </div>

				        <div class="col-md-4">
				          <div class="form-group">
				            <label for="org_area_usability">Area Usability </label>
				            <input type="text" class="form-control" name="org_area_usability" id="org_area_usability" placeholder="Enter Area Usability">
				          </div>
				        </div>

				        <div class="col-md-4">
				          <div class="form-group">
				            <label for="org_area_room_no">Room No. </label>
				            <input type="text" class="form-control" name="org_area_room_no" id="org_area_room_no" placeholder="Enter Area Room No.">
				          </div>
				        </div>

			    	</div>

            	</div>
            </div>

            <div class="card timeline-item">
            	<div class="card-header">
            		<h3 class="card-title">Storage Details</h3>
            	</div>
            	<div class="card-body timeline-body">
            		
            		<div class="row">
			    		
			    		<div class="col-md-4">
				          <div class="form-group">
				            <label for="org_storage_name">Storage Name </label>
				            <input type="text" class="form-control" name="org_storage_name" id="org_storage_name" placeholder="Enter Storage Name">
				          </div>
				        </div>

				        <div class="col-md-4">
				          <div class="form-group">
				            <label for="org_storage_type">Storage Type </label>
				            <input type="text" class="form-control" name="org_storage_type" id="org_storage_type" placeholder="Enter Storage Type">
				          </div>
				        </div>

				        <div class="col-md-4">
				          <div class="form-group">
				            <label for="org_storage_area_name">Area Name </label>
				            <input type="text" class="form-control" name="org_storage_area_name" id="org_storage_area_name" placeholder="Enter Area Name">
				          </div>
				        </div>

			    	</div>

            	</div>
            </div>

            <div class="card timeline-item">
            	<div class="card-header">
            		<h3 class="card-title">Refreshment Details</h3>
            	</div>
            	<div class="card-body timeline-body">
            		
            		<div class="row">
			    		
			    		<div class="col-md-6">
				          <div class="form-group">
				            <label for="org_refreshment_name">Refreshment Name </label>
				            <input type="text" class="form-control" name="org_refreshment_name" id="org_refreshment_name" placeholder="Enter Refreshment Name">
				          </div>
				        </div>

				        <div class="col-md-6">
				          <div class="form-group">
				            <label for="org_refreshment_quality">Refreshment Quantity </label>
				            <input type="text" class="form-control" name="org_refreshment_quality" id="org_refreshment_quality" placeholder="Enter Refreshment Quantity">
				          </div>
				        </div>

			    	</div>

            	</div>
            	<div class="card-footer">
            		<div class="btn-group" style="float: right;">
			          <button type="submit" class="btn btn-sm btn-outline-danger btn_save_category" id="btn_save_category"><i class="fas fa-save fw"></i></button>
		      			<a href="<?php echo $base_url;?>/bloodbanks" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
			        </div>
            	</div>
            </div>
		</div>
	</form>