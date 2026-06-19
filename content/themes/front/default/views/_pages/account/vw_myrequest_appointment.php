<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
if(isset($_POST['submit'])) {
   if(!empty($_POST['rescheduale_date'])){
                      // print_r($_POST);die();
     // print_r($_SESSION); die;

    $o_id = $_POST['form_request_id'];
    $o_date = $_POST['rescheduale_date'];
    $o_reasion = $_POST['reasion'];

    $id = $_SESSION['customer_id'];
     $update = $this->db->query("UPDATE bl_blood_request SET requested_schedule_date = '$o_date', reason = '$o_reasion' WHERE id = '$o_id'");
          if($update == true){
               // redirect('myaccount');

          	echo '<script>alert("Your Request Reschedule successfully")</script>';
          	 //echo '<script>window.location.reload()</script>';
              } else{
               echo "fail";
              }

  }
}
?>
<style type="text/css">
	#h_category_err::before {
		margin: 10px;
	}
	#update-profile{
		display: none;
	}
	ul.profile_out li {
		width: 100%;
		margin-bottom: 10px;
		padding: 10px;
		border-radius: 0px !important;
	}
	ul.profile_out li {
		width: 100%;
		margin-bottom: 10px;
		padding: 10px;
		border-radius: 0px !important;
		font-size: 15px;
		text-transform: capitalize;
		background: #343a40;
		color: #fff !important;
	}
	.login-cta{
		border-bottom: 1px solid #ced4da;
		padding-bottom: 15px;
		padding:34px 0px;
	}
	.br-1 {
		border-left: 1px solid #ced4da;
	}
	.feils_out {
		display: flex;
		padding-bottom: 12px;
		align-items: center;
	}
	.feils_out span {
		margin-right: 15px !important;
		width: 212px;
		font-weight: 600;
		text-transform: capitalize;
	}
	.feils_out label {
		color: #000 !important;
		padding: 0px;
		margin: 0px;
	}
	.btn-shik4{
		font-size: 14px;
    padding: 7px 18px;
    /* margin: auto; */
    /* display: flex; */
    width: 131px;
    /* margin: auto; */
    /* display: flex; */
   
}
.request-hrs{
	width:19%;
	margin:auto;
	border-bottom:2px solid red;
}
</style>
<div class="image-contactus-banner">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="lg-text text-dark">My Request Appointments</h1>
				<h6><a href="index.html">Home /</a> My Request</h6>
			</div>
		</div>
	</div>
</div>

<section class="sign-in-page my-5">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="contact-wrapper">
					<header class="login-cta">
						<h2 id="current-tab">My Request Appointments</h2>
						<hr class="request-hrs">
					</header>
					<div class="row">
		<!-- 				<br>
						<div class="col-md-3 mt-5 pr-4">

							<ul class="profile_out">
								<li class="btn side-nav-btn active-btn" id="view-appointments">My Appointments</li>
								<li class="btn side-nav-btn" id="view-reschedule-list">Re Scheduled Appointments</li>
							</ul>
            

      </div> -->
      <div class="col-md-12 pl-4 pt-5">
      	<div id="show-appointments">
      		<div class="table-responsive">
      			<!-- table -->
      			<table id="requests_data" class="table table-bordered table-striped">
      				<thead>
      					<tr>
      						<th width="15%">Request Id</th>
      						<th width="25%">Requested Date</th>
      						<th width="25%">Organization Name</th>
      						<th width="15%">Actions</th>
      						<!-- <th width="15%">organization Type</th> -->
      					</tr>
      				</thead>
      				<tbody>

          <?php  $id = $_SESSION['customer_id'];
          // print_r($id);die();
          $query = $this->db->query("SELECT * FROM bl_blood_request WHERE user_id = '$id'");
 //print_r(json_encode($query));

                   foreach ($query->result() as $row)
                   {
                 //print_r($row->org_id); die();
                   	$bank_id = $row->org_id;
                   	// print_r($bank_id);die();
           $query1 = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id = '$bank_id'");

// id	
	// user_id	        
// org_id	
// org_type	
// donation_form_id	
// approved_status	
// donation_status	
// requested_schedule_date	
// reason	
// re_schedule_status	
// updated_at	
// created_at	
// created_by	
// updated_by	
 
                     ?>
      					<tr>
      						<td><?php echo $row->id; ?></td>
      						<td><?php echo $row->requested_schedule_date; ?></td>
                        <?php  foreach ($query1->result() as $org)
                        {?>
                          <td><?php echo $org->name; ?></td>
	                   <?php } ?>
					   
      						
      						<td><span class="btn-shik4 btn new-red book<?php echo $row->id; ?>" id="<?php echo $row->id; ?>">Re-schedule</span>
      							</td>
      					</tr>
      					<!-- Modal -->
<div class="modal fade" id="book-appointment-modal<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Re Schedule Appointment</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			 <form id="scheduling-confirm" action = "<?php $_PHP_SELF ?>" method = "POST" style="padding-bottom: 0px!important; margin: 0px!important;">
           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<div class="modal-body">

                    <!-- <?php print_r($row->id); ?> -->
                    <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 new-popup">Re-Scheduling Date</label>
                     <div class="col-sm-8">
                        <input type="date" class="form-control" name="rescheduale_date" required="">
					<input type="hidden" name="" id="req_id">
                     </div>
                  </div>
                   <div class="row mb-3">
                     <label for="colFormLabel" class="col-sm-4 new-popup">Mention Reason For Re-Scheduling</label>
                     <div class="col-sm-8">
                        <textarea name="reasion" class="form-control" rows="3"></textarea>
                     </div>
                  </div>
				<!-- <div class="form-row">
					<span for=""><strong>Re-Scheduling Date</strong></span>
					<input type="date" class="form-control" name="rescheduale_date" required="">
					<input type="hidden" name="" id="req_id">
				</div> -->
				<!-- <div class="form-row mt-2">
					<span for=""><strong> Mention Reason For Re-Scheduling</strong></span>
					<textarea name="reasion" class="form-control" rows="3"></textarea>
				</div> -->
				<br>
				 <input type="hidden" value="<?php echo $row->id; ?>" name="form_request_id">
			<!-- 	<div class="form-row">
					<div id="schedule-response"></div>
				</div> -->

			</div>
			<div class="modal-footer">
				<button type="button" class="btn new-red" data-dismiss="modal">Close</button>
				<button type="submit" name="submit" class="btn new-red " id="scheduling-confirm">Schedule</button>
			</div>
			</form>
		</div>
	</div>
</div>
  <script type="text/javascript">
     $(document).on( 'click', '.book<?php echo $row->id; ?>', function () { 
    // $('#bb-name').html($(this).attr('data-name'));
    // $('#bb-cat').html($(this).attr('data-cat'));
    // $('#bb-addrs').html($(this).attr('data-addrs'));
    // $('#bb-id').val($(this).attr('id'));
    $('#book-appointment-modal<?php echo $row->id; ?>').modal('show');
    // $('#book-appointment-modal').appendTo("body").modal('hide');
  });
  </script>
                    <?php } ?>
      		</tbody>
      	</table>
      </div>
      <script type="text/javascript">
      	$(document).ready(function(){

      		$('#requests_data').DataTable( {
      			responsive: true
      		} );
      	});

      </script>
  </div>
</div>
</div>
</div>
</div>
</div>
</section>
<!--request form-->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#re-schedule-appointment">
  Launch demo modal
</button> -->



<script type="text/javascript">
	$('#change-pass-req').on('click', function(){
		$('#passcode').toggle();
		if($('#passcode').is(':visible') == false){
			$('#password').val($('#old_password').val())
		}
		if($('#passcode').is(':visible') == true){
			$('#password').val("");
		}
	});
	$('#view-edit-profile').on('click', function(){
		$('#show-donations').hide();
		$('#update-profile').show();
		$('#current-tab').html('Edit Profile');
	});
	$('#view-donations').on('click', function(){
		$('#show-donations').show();
		$('#update-profile').hide();
		$('#current-tab').html('All Donations');
	});

	$('#view-appointments').on('click', function(){
		$('#reschedule-list').hide();
		$('#show-appointments').show();
		$('#current-tab').html('My Appointments');
	});
</script>