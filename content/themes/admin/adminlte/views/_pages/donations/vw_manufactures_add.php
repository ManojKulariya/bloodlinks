<?php 

if(!empty($_POST['vender_name'])){

	//print_r($_POST); die;
	$vendor_name = $_POST['vender_name'];
	$contact_person = $_POST['contact_person'];
	$contact_no = $_POST['contact_no'];
	$alt_contact_no = $_POST['alt_contact_no'];
	$fax = $_POST['fax_no'];
	$address = $_POST['address'];
	$pincode = $_POST['pincode'];

	$insert = $this->db->query("INSERT INTO bl_manufactures (vendor_name, contact_person, contact_no, alt_contact_no, fax, address, pincode) VALUES ('$vendor_name','$contact_person', '$contact_no', '$alt_contact_no', '$fax','$address' ,'$pincode')");
// echo $this->db->insert_id();die;
	if($insert==true){
    // echo 'hiii';
    // die();
		redirect('donations/manufactures');

	} else{
		echo "fail";
	}
}
?>
<div class="timeline">
<!--   			<div class="time-label">
                <span class="bg-red">Manufacture</span>
              </div> -->
              <div class="card">
              	<div class="card-header">
              		<!-- <h3 class="card-title">Register Blood Bank</h3> -->
              		<div class="btn-group" style="float: right;">
              			<!-- 			          <button type="submit" class="btn btn-sm btn-outline-danger btn_save_category" id="btn_save_category"><i class="fas fa-save fw"></i></button> -->
              			<a href="<?php echo $base_url;?>/donations/manufactures" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-danger" data-original-title="Add New"><i class="fas fa-reply fw"></i></a>
              		</div>
              	</div>
              	<div class="card-body">
              		<form action = "<?php $_PHP_SELF ?>" method = "POST">
              			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              			<div class="row">
              				
              				<div class="col-md-6">
              					<div class="form-group">
              						<label for="vender_name">Vender Name</label>
              						<input type="text" class="form-control" name="vender_name" id="vender_name" placeholder="Enter Name">
              					</div>
              				</div>

              				<div class="col-md-6">
              					<div class="form-group">
              						<label for="contact_person">Contact Person</label>
              						<input type="text" class="form-control" name="contact_person" id="contact_person" placeholder="Enter Contact Person">
              					</div>
              				</div>

              			</div>

              			<div class="row">

              				<div class="col-md-6">
              					<div class="form-group">
              						<label for="contact_no">Contact No.</label>
              						<input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Enter Contact No.">
              						
              					</div>
              					
              				</div>
              				<div class="col-md-6">
              					<div class="form-group">
              						<label for="alt_contact_no">Alt Contact No.</label>
              						<input type="text" class="form-control" id="alt_contact_no" name="alt_contact_no" placeholder="Enter Alt Contact No.">
              						
              					</div>
              					
              				</div>

              				
              			</div>
              			<div class="row">	
              				<div class="col-md-6">
              					<div class="form-group">
              						<label for="fax_no">Fax No.</label>
              						<input type="text" class="form-control" id="fax_no" name="fax_no" placeholder="Enter Fax No.">
              						
              					</div>
              				</div>

              				<div class="col-md-6">
              					<div class="form-group">
              						<label for="pincode">Pincode</label>
              						<input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter Pincode">
              						
              					</div>
              					
              				</div>
              			</div>
              			<div class="row">
              				
              				<div class="col-md-12">
              					<div class="form-group">
              						<label for="company_address">Full Address</label>
              						<textarea class="form-control" name="address" id="company_address" placeholder="Enter Full Address" rows="4"></textarea>
              					</div>
              				</div>

              			</div>
              			<div class="col-md-12">
              				<div class="btn-group" style="float: right;">
              					<button type="submit" name="submit" class="btn btn-sm btn-danger" id="btn_save_basic_details"><i class="fas fa-save fw"></i> Save</button>
              				</div>
              			</div>
              		</form>
              	</div>
              </div>