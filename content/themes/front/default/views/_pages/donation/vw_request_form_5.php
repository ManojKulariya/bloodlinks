<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- progressbar -->
<!-- <ul id="progressbar">
   <li class="active" id="account"><strong>Step 1</strong></li>
   <li id="personal"><strong>Step 2</strong></li>
   <li id="payment"><strong>Step 3</strong></li>
   <li id="payment"><strong>Step 4</strong></li>
   <li id="payment"><strong>Step 5</strong></li>
   <li id="payment"><strong>Step 6</strong></li>
   <li id="confirm"><strong>Finish</strong></li>
</ul>
<div class="progress">
   <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
</div> -->
<br> 
<!-- fieldsets -->

<form id="form_step_5" class="msform">
    <div class="panel panel-default hf-temp-perm-d" >
          <!-- <div class="panel-heading" >
            <h4 class="panel-title">
              <a class="primary" data-parent="#accordion" href="#book-appointment-blk">Appointment Booking</a>
            </h4>
          </div> -->

                <div class="form-card">
         <div class="row">
            <div class="col-7">
               <!-- <a class="primary" data-parent="#accordion" href="#book-appointment-blk">Appointment Booking</a> -->
            </div>
            <div class="col-5">
               <h2 class="steps">Step <?php echo $step_no;?></h2>
            </div>
         </div>
         <hr>
         
          <div id="book-appointment-blk" class="" >
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                 <center>
                  
                    <span style="font-size: 24px;">
                      <strong>Thanks for filling up the form </strong>
                    </span>
                    <br>
                    <input type="hidden" value="0" id="schedule_appointment" name="schedule-appointment">
                    Please click here to <a class="back action-button" href="<?php echo base_url('schedule-appointment');?>"  id="set_schedule_appointment" style="float: none; line-height: 50px;" >Schedule Appointment</a>
                    <!-- href="schedule-appointment.php" -->
                  </center>
                      <!-- <div class="doneted_out">
                        <span>
                          <input type="radio" checked id="hosp" name="loc" value="hospital" >
                          <label class="fieldlabels" for="hosp" >hospital</label>
                        </span>
                        <span>
                          <input type="radio" id="b-bank" name="loc" value="blood_bank" >
                          <label class="fieldlabels" for="b-bank">blood bank</label>
                        </span>

                        <span>
                          <span class="btn btn-secondary" id="get-nearby-HBBC">check</span>
                        </span>
                        
                      </div>  -->
                    </li>

                  </ul>
                  <div class="doneted_out">
                    <div id="regularvoluntary_err"></div>
                    <div id="reg_voluntary" class='regularvoluntary' >
                      <span>
                      
                        <!-- <input type="checkbox" class='regularvoluntary' id="Birthday" name="volunteer-type" value="yes">
                        <label class="fieldlabels">Birthday</label> -->
                      </span>
                      <div class="row">
                     <!--  <select name="locations" class="select2 form-select col-md-3" id="locations">
                        <option  >choose hospital</option>
                      </select> -->
                      </div>
                      
                      <div id="location-blk"  class="row" ></div>
                    </div>
                  </div>
                </div>
              </div>
              
          <!--    <input type="submit" name="back" class="back action-button" data-form_type="step_<?php echo $step_back;?>" value="Back"/> 
             <input type="submit" name="submit" id="fin-submit" class="back action-button" value="Submit" style="
              float: right;"> -->
              <!-- <a class="btn btn-warning btn-md pull-left" id="appointmentPrevBtn">Prev</a> -->


          
              <!-- <a class="btn btn-success btn-md pull-right" id="primaryNextBtn">Next</a> -->
            </div>
          </div>
        </div> <!-- primary -->
      </div>
</form>

<script>
  window.scrollTo(0, 0);
</script>