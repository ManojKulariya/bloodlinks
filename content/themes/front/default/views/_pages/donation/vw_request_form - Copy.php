<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

 <div class="image-contactus-banner">
    <div class="container">
        <div class="row">
           	<div class="col-md-12">
              <h1 class="lg-text text-dark">Request for Blood issue</h1>
           	</div>
        </div>
    </div>
</div>
<div class="bread-bar">
   	<div class="container">
        <div class="row">
           	<div class="col-md-8 col-sm-6 col-xs-8">
              	<ol class="breadcrumb">
                 	<li><a href="<?php echo base_url();?>">Home</a></li>
                 	<li class="active">Request for Blood issue</li>
              	</ol>
           	</div>
        </div>
    </div>
</div>
<!--request form-->
<!--request form-- end-->
<section class="request-form">
    <div class="container">
        <div class="row">
           	<div class="col-lg-12  text-center ">
              	<div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                	<h2 id="heading">Request for Blood issue</h2>
                	<p>Fill all form field to go to next step</p>
                    
                        <!-- progressbar -->
                        <ul id="progressbar">
                           <li class="active" id="account"><strong>Step 1</strong></li>
                           <li id="personal"><strong>Step 2</strong></li>
                           <li id="payment"><strong>Step 3</strong></li>
                           <li id="payment"><strong>Step 4</strong></li>
                           <li id="payment"><strong>Step 5</strong></li>
                           <li id="payment"><strong>Step 6</strong></li>
                           <li id="confirm"><strong>Finish</strong></li>
                        </ul>
                        <div class="progress">
                           <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <br> <!-- fieldsets -->

                        <div id="step_forms">

                        <form id="form_step_1" class="msform">
                           <fieldset>
                              <!--1st step -->
                              <div class="form-card">
                                 <div class="row">
                                    <div class="col-7">
                                       <h2 class="fs-title">Criteria For Blood Donation</h2>
                                    </div>
                                    <div class="col-5">
                                       <h2 class="steps">Step 1 - 5</h2>
                                    </div>
                                 </div>
                                 <hr>
                                 <div class="row">
                                   <div class="col-md-12">
                                       <label class="fieldlabels">When you'll donate the blood</label>
                                       <div class="pre-question">
                                       	<div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input donation_time_selection" name="donation_time_selection" value="today">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Today</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input donation_time_selection" name="donation_time_selection" value="other_day">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Some Other Day</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                         	</div>
                                       </div> 
                                   </div>
                                   <div class="col-md-12" id="well_feeling_div" style="display: none;">
                                       <label class="fieldlabels">Are You Feeling Well To Donate Blood?</label>
                                       <div class="pre-question">
                                          <div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input" name="well_feeling" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input" name="well_feeling" value="no">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                          </div>
                                       </div> 
                                   </div>

                                   <!-------->
                                   <div class="col-md-12">
                                       <label class="fieldlabels"><span class="number-span">1.</span> Have you donated blood previously ?</label> 
                                       <div class="pre-question">
                                       	<div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_prev_donation" name="has_prev_donation" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_prev_donation" name="has_prev_donation" value="no" checked="checked">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                         	</div>
                                       </div> 
                                   </div>
                                   <div class="col-md-12" id="prev_donation" style="display:none;">
                                       <div class="row" style="padding-left: 50px;padding-right: 50px;padding-bottom: 50px;">
                                          <div class="col-md-3">
                                             <label class="fieldlabels">When Last </label> 
                                             <input type="date" name="uname" placeholder="Date of Admission"/> 
                                          </div>
                                          <div class="col-md-12">
                                             <label class="fieldlabels">In Which Blood Bank You Donated Previously?</label>
                                          </div>

                                          <div class="col-md-4">
                                             <label class="fieldlabels">Blood Bank Name </label> 
                                             <input type="text" name="uname" placeholder="Blood Bank Name"/> 
                                          </div>
                                          <div class="col-md-4">
                                             <label class="fieldlabels">City Name </label> 
                                             <input type="text" name="uname" placeholder="City Name"/> 
                                          </div>
                                          <div class="col-md-4">
                                             <label class="fieldlabels">How many Times </label> 
                                             <input type="number" min="0" name="uname" value="0"/> 
                                          </div>
                                          <div class="col-md-12">
                                             <label class="fieldlabels">Did You Have Any Discomfort During Or After Donation ?</label> 
                                             <div class="pre-question">
                                                <div class="buttons">
                                                   <ul>
                                                      <li>
                                                         <label class="rad-label">
                                                          <input type="radio" class="rad-input" name="" value="yes">
                                                          <div class="rad-design"></div>
                                                          <div class="rad-text">Yes</div>
                                                         </label>   
                                                      </li>
                                                      <li>
                                                         <label class="rad-label">
                                                          <input type="radio" class="rad-input" name="" value="no">
                                                          <div class="rad-design"></div>
                                                          <div class="rad-text">No</div>
                                                         </label> 
                                                      </li>
                                                   </ul>
                                                </div>
                                             </div> 
                                         </div>
                                       </div>
                                   </div>
                                   <!-------->
                                   <div class="col-md-12">
                                       <label class="fieldlabels"><span class="number-span">2.</span> Have You Any Reason To Believe That Donation Shall Infect You ?</label> 
                                       <div class="pre-question">
                                       	<div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input" name="prereg" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input" name="prereg" value="no"  checked="checked">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                         	</div>
                                       </div> 
                                   </div>
                                   <!------->
                                   <div class="col-md-12">
                                       <label class="fieldlabels"><span class="number-span">3.</span> Are You Suffering From :</label> 
                                       <div class="pre-question">
                                       	<div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_general_differs" name="has_general_differs" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_general_differs" name="has_general_differs" value="no"  checked="checked">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                         	</div>
                                       </div> 
                                   </div>
                                   <?php
                                   if(!empty($general_differs)){
                                    ?>
                                    <div class="col-md-12">
                                       <div class="row" style="padding: 26px;border-top:#0000ff" id="general_differs_div">
                                       <?php
                                       foreach ($general_differs as $key => $value) {
                                          ?>
                                          <div class="col-6">
                                             <?php
                                             foreach ($value as $k => $v) {
                                                ?>
                                                <label class="check" style="color: #000;"><?php echo $v->defer_value;?>
                                                   <input type="checkbox" class="check_box" value="<?php echo $v->id;?>" disabled="true">
                                                  <span class="checkmark"></span>
                                                </label>
                                                <?php
                                             }
                                             ?>                                           
                                          </div>
                                          <?php
                                       }
                                       ?>
                                       </div>
                                    </div>
                                    <?php
                                   }
                                   ?>
                                   <!------->
                                   <div class="col-md-12">
                                       <label class="fieldlabels"><span class="number-span">4.</span> Have You Taking Or Have Taken Medicine In Last 72 Hours Any Of The Following:</label> 
                                       <div class="pre-question">
                                       	<div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_taken_medicines" name="has_taken_medicines" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_taken_medicines" name="has_taken_medicines" value="no" checked="checked">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                         	</div>
                                       </div> 
                                   </div>
                                   <?php
                                   if(!empty($medicines)){
                                    ?>
                                    <div class="col-md-12">
                                       <div class="row" style="padding: 26px;border-top:#0000ff" id="medicines_div">
                                       <?php
                                       foreach ($medicines as $key => $value) {
                                          ?>
                                          <div class="col-6">
                                             <?php
                                             foreach ($value as $k => $v) {
                                                ?>
                                                <label class="check" style="color: #000;"><?php echo $v->medicine_name;?>
                                                   <input type="checkbox" class="check_box" value="<?php echo $v->id;?>" disabled="true">
                                                  <span class="checkmark"></span>
                                                </label>
                                                <?php
                                             }
                                             ?>                                           
                                          </div>
                                          <?php
                                       }
                                       ?>
                                       </div>
                                    </div>
                                    <?php
                                   }
                                   ?>
                                   <!------->
                                   <div class="col-md-12">
                                       <label class="fieldlabels"><span class="number-span">5.</span> In The Last 2 Weeks Have You Been Vaccinated/Immunized For Any Of The Following</label> 
                                       <div class="pre-question">
                                       	<div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_vaccinated" name="has_vaccinated" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_vaccinated" name="has_vaccinated" value="no" checked="checked">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                         	</div>
                                       </div> 
                                   </div>
                                   <?php
                                   if(!empty($vaccines)){
                                    ?>
                                    <div class="col-md-12">
                                       <div class="row" style="padding: 26px;border-top:#0000ff" id="vaccines_div">
                                       <?php
                                       foreach ($vaccines as $key => $value) {
                                          ?>
                                          <div class="col-6">
                                             <?php
                                             foreach ($value as $k => $v) {
                                                ?>
                                                <label class="check" style="color: #000;"><?php echo $v->vac_name;?>
                                                   <input type="checkbox" class="check_box" value="<?php echo $v->id;?>" disabled="true">
                                                  <span class="checkmark"></span>
                                                </label>
                                                <?php
                                             }
                                             ?>                                           
                                          </div>
                                          <?php
                                       }
                                       ?>
                                       </div>
                                    </div>
                                    <?php
                                   }
                                   ?>
                                   <!------->
                                   <div class="col-md-12">
                                       <label class="fieldlabels"><span class="number-span">6.</span> In The Last 2 Weeks Did You Suffer From Any Of The Following Diseases</label> 
                                       <div class="pre-question">
                                       	<div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_last_2_week_differs" name="has_last_2_week_differs" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_last_2_week_differs" name="has_last_2_week_differs" value="no" checked="checked">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                         	</div>
                                       </div> 
                                   </div>
                                   <?php
                                   if(!empty($last_2_week_dif)){
                                    ?>
                                    <div class="col-md-12">
                                       <div class="row" style="padding: 26px;border-top:#0000ff" id="last_2_week_differs_div">
                                       <?php
                                       foreach ($last_2_week_dif as $key => $value) {
                                          ?>
                                          <div class="col-6">
                                             <?php
                                             foreach ($value as $k => $v) {
                                                ?>
                                                <label class="check" style="color: #000;"><?php echo $v->defer_value;?>
                                                   <input type="checkbox" class="check_box" value="<?php echo $v->id;?>" disabled="true">
                                                  <span class="checkmark"></span>
                                                </label>
                                                <?php
                                             }
                                             ?>                                           
                                          </div>
                                          <?php
                                       }
                                       ?>
                                       </div>
                                    </div>
                                    <?php
                                   }
                                   ?>
                                   <!------->
                                   <div class="col-md-12">
                                       <label class="fieldlabels"><span class="number-span">7.</span> In The Last 3 Months Have You Had Any Of The Following :</label> 
                                       <div class="pre-question">
                                       	<div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_last_3_month_differs" name="has_last_3_month_differs" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_last_3_month_differs" name="has_last_3_month_differs" value="no" checked="checked">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                         	</div>
                                       </div> 
                                   </div>
                                   <?php
                                   if(!empty($last_3_month_dif)){
                                    ?>
                                    <div class="col-md-12">
                                       <div class="row" style="padding: 26px;border-top:#0000ff" id="last_3_month_differs_div">
                                       <?php
                                       foreach ($last_3_month_dif as $key => $value) {
                                          ?>
                                          <div class="col-6">
                                             <?php
                                             foreach ($value as $k => $v) {
                                                ?>
                                                <label class="check" style="color: #000;"><?php echo $v->defer_value;?>
                                                   <input type="checkbox" class="check_box" value="<?php echo $v->id;?>" disabled="true">
                                                  <span class="checkmark"></span>
                                                </label>
                                                <?php
                                             }
                                             ?>                                           
                                          </div>
                                          <?php
                                       }
                                       ?>
                                       </div>
                                    </div>
                                    <?php
                                   }
                                   ?>
                                   <!------->
                                   <div class="col-md-12">
                                       <label class="fieldlabels"><span class="number-span">8.</span> In The Last 6 Months Have You Had Any Of The Following :</label> 
                                       <div class="pre-question">
                                       	<div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_recent_difers" name="has_recent_difers" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_recent_difers" name="has_recent_difers" value="no" checked="checked">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                         	</div>
                                       </div> 
                                   </div>
                                   <?php
                                   if(!empty($recent_differs)){
                                    ?>
                                    <div class="col-md-12">
                                       <div class="row" style="padding: 26px;border-top:#0000ff" id="recent_differs_div">
                                       <?php
                                       foreach ($recent_differs as $key => $value) {
                                          ?>
                                          <div class="col-6">
                                             <?php
                                             foreach ($value as $k => $v) {
                                                ?>
                                                <label class="check" style="color: #000;"><?php echo $v->defer_value;?>
                                                   <input type="checkbox" class="check_box" value="<?php echo $v->id;?>" disabled="true">
                                                  <span class="checkmark"></span>
                                                </label>
                                                <?php
                                             }
                                             ?>                                           
                                          </div>
                                          <?php
                                       }
                                       ?>
                                       </div>
                                    </div>
                                    <?php
                                   }
                                   ?>
                                   <!------->
                                   <div class="col-md-12">
                                       <label class="fieldlabels"><span class="number-span">9.</span> In The Last 12 Months Have You Had Any Of The Following :</label> 
                                       <div class="pre-question">
                                       	<div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_last_12_month_differs" name="has_last_12_month_differs" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_last_12_month_differs" name="has_last_12_month_differs" value="no" checked="checked">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                         	</div>
                                       </div> 
                                   </div>
                                   <?php
                                   if(!empty($last_12_month_dif)){
                                    ?>
                                    <div class="col-md-12">
                                       <div class="row" style="padding: 26px;border-top:#0000ff" id="last_12_month_differs_div">
                                       <?php
                                       foreach ($last_12_month_dif as $key => $value) {
                                          ?>
                                          <div class="col-6">
                                             <?php
                                             foreach ($value as $k => $v) {
                                                ?>
                                                <label class="check" style="color: #000;"><?php echo $v->defer_value;?>
                                                   <input type="checkbox" class="check_box" value="<?php echo $v->id;?>" disabled="true">
                                                  <span class="checkmark"></span>
                                                </label>
                                                <?php
                                             }
                                             ?>                                           
                                          </div>
                                          <?php
                                       }
                                       ?>
                                       </div>
                                    </div>
                                    <?php
                                   }
                                   ?>
                                   <!------->
                                   <div class="col-md-12">
                                       <label class="fieldlabels"><span class="number-span">10.</span> Have You Ever Had Any Of The Following (Permanent Defer) :</label> 
                                       <div class="pre-question">
                                       	<div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_perm_differ" name="has_perm_differ" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_perm_differ" name="has_perm_differ" checked="checked" value="no" checked="checked">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                         	</div>
                                       </div> 
                                   </div>

                                   <?php
                                   if(!empty($permanent_differs)){
                                   	?>
                                   	<div class="col-md-12">
                                   		<div class="row" style="padding: 26px;border-top:#0000ff" id="differs_div">
                                   		<?php
                                   		foreach ($permanent_differs as $key => $value) {
                                   			?>
                                   			<div class="col-6">
   	                                			<?php
         												foreach ($value as $k => $v) {
         													?>
         													<label class="check" style="color: #000;"><?php echo $v->defer_value;?>
                                                   <input type="checkbox" class="check_box" value="<?php echo $v->id;?>" disabled="true">
         													  <span class="checkmark"></span>
         													</label>
         													<?php
         												}
         												?>                                				
                                   			</div>
                                   			<?php
                                   		}
                                   		?>
                                   		</div>
                                   	</div>
                                   	<?php
                                   }
                                   ?>
                                   <!------->
                                 </div>
                              </div>
                              <input type="button" name="next" class="next action-button" value="Next" />
                           </fieldset>
                           <!--1st step tab end-->
                        </form>

                        <form id="form_step_2" class="msform">
                           <fieldset>
                              <!--2nd step -->
                              <div class="form-card">
                                 <div class="row">
                                    <div class="col-7">
                                       <h2 class="fs-title">Physiological Status for Women:</h2>
                                    </div>
                                    <div class="col-5">
                                       <h2 class="steps">Step 1 - 2</h2>
                                    </div>
                                 </div>
                                 <hr>
                                 <div class="row">
                                    <div class="col-md-12">
                                       <label class="fieldlabels"><span class="number-span">1.</span> Are You Pregnant Or Have You Been Pregnant Within Last Six Months:</label>
                                       <div class="pre-question">
                                          <div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_pregnant" name="has_pregnant" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_pregnant" name="has_pregnant" value="no">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                          </div>
                                       </div> 
                                    </div>
                                    <div class="col-md-12">
                                       <label class="fieldlabels"><span class="number-span">2.</span> Abortion (6 Months)?:</label>
                                       <div class="pre-question">
                                          <div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_abortion" name="has_abortion" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_abortion" name="has_abortion" value="no">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                          </div>
                                       </div> 
                                    </div>
                                    <div class="col-md-5">
                                       <label class="fieldlabels"><span class="number-span">3.</span> When Did You Have Last Menstrual Period</label>
                                       <input type="text" name="uname" placeholder="Blood Bank Name"/>
                                    </div>
                                    <div class="col-md-12">
                                       <label class="fieldlabels"><span class="number-span">4.</span> Are You Breast Feeding (12 Months)?:</label>
                                       <div class="pre-question">
                                          <div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_breast_feeden_last_12_month" name="has_breast_feeden_last_12_month" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_breast_feeden_last_12_month" name="has_breast_feeden_last_12_month" value="no">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                          </div>
                                       </div> 
                                    </div>
                                    <div class="col-md-12">
                                       <label class="fieldlabels"><span class="number-span">5.</span> Do You Have Child Less Than 1 Year Old?:</label>
                                       <div class="pre-question">
                                          <div class="buttons">
                                             <ul>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_child_less_one-year" name="has_child_less_one-year" value="yes">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">Yes</div>
                                                   </label>   
                                                </li>
                                                <li>
                                                   <label class="rad-label">
                                                    <input type="radio" class="rad-input has_child_less_one-year" name="has_child_less_one-year" value="no">
                                                    <div class="rad-design"></div>
                                                    <div class="rad-text">No</div>
                                                   </label> 
                                                </li>
                                             </ul>
                                          </div>
                                       </div> 
                                    </div>
                                 </div>
                              </div>
                              <input type="button" name="next" class="next action-button" value="Next" />
                              <input type="button" name="back" class="back action-button" value="back" />
                           </fieldset>
                           <!--2nd step tab end-->
                        </form>

                        <form id="form_step_3" class="msform">
                           <fieldset>
                              <!--3rd step -->
                              <div class="form-card">
                                 <div class="row">
                                    <div class="col-7">
                                       <h2 class="fs-title">Self Exclusion Quetionaire (Please answer all question honestly your answers will be confidential):</h2>
                                    </div>
                                    <div class="col-5">
                                       <h2 class="steps">Step 1 - 3</h2>
                                    </div>
                                 </div>
                                 <hr>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label class="fieldlabels">Hb gm%: *</label> <input type="text" name="name" placeholder="Hb gm%" /> 
                                    </div>
                                 </div>
                              </div>
                              <input type="button" name="next" class="next action-button" value="Next" />
                              <input type="button" name="back" class="back action-button" value="back" />
                           </fieldset>
                           <!--3rd step tab end-->
                        </form>

                        <form id="form_step_4" class="msform">
                           <fieldset>
                              <!--4th step -->
                              <div class="form-card">
                                 <div class="row">
                                    <div class="col-7">
                                       <h2 class="fs-title">Informed Consent:</h2>
                                    </div>
                                    <div class="col-5">
                                       <h2 class="steps">Step 1 - 4</h2>
                                    </div>
                                 </div>
                                 <hr>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label class="fieldlabels">RBC Conc./Packed RBC Units: *</label> <input type="text" name="name" placeholder="RBC Conc./Packed RBC Units" /> 
                                    </div>
                                    <div class="col-md-6">
                                       <label class="fieldlabels">Random Donor Platlet Conc.Units: *</label> <input type="text" name="uname" placeholder="Random Donor Platlet Conc.Units" /> 
                                    </div>
                                    <div class="col-md-6">
                                       <label class="fieldlabels">Fresh Frozen Plasme Units  *</label> <input type="text" name="fresh" placeholder="Fresh Frozen Plasme Units" /> 
                                    </div>
                                    <div class="col-md-6">
                                       <label class="fieldlabels">Cryo Precipitate Units : *</label> <input type="text" name="uname" placeholder="Cryo Precipitate Units" /> 
                                    </div>
                                    <div class="col-md-6">
                                       <label class="fieldlabels">Whole Blood Units : *</label> <input type="text" name="uname" placeholder="Whole Blood Units" /> 
                                    </div>
                                    <div class="col-md-6">
                                       <label class="fieldlabels">Single Donor Platlet Units : *</label> <input type="text" name="uname" placeholder="Single Donor Platlet Units" /> 
                                    </div>
                                 </div>
                              </div>
                              <input type="button" name="next" class="next action-button" value="Next" />
                              <input type="button" name="back" class="back action-button" value="back" />
                           </fieldset>
                           <!--4th step tab end-->
                        </form>

                        <form id="form_step_5" class="msform">
                           <fieldset>
                              <!--5th step -->
                              <div class="form-card">
                                 <div class="row">
                                    <div class="col-7">
                                       <h2 class="fs-title">Appointmet</h2>
                                    </div>
                                    <div class="col-5">
                                       <h2 class="steps">Step 1 - 5</h2>
                                    </div>
                                 </div>
                                 <hr>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label class="fieldlabels">Requirement Date & Time  *</label> <input type="date" name="date" placeholder="Date of birth" /> 
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group d-flex" id="gender-group">
                                          <label class="fieldlabels">  
                                          Request Type:   
                                          </label>  <br>  
                                          <input type="radio" id="gender" name="gender" value="state"> <label class="fieldlabels">State</label>    
                                          <input type="radio" id="gender" name="gender" value="urgent"><label class="fieldlabels"> Urgent  </label>
                                          <input type="radio" id="gender" name="gender" value="routine">
                                          <label class="fieldlabels">Routine</label>
                                          <input type="radio" id="gender" name="gender" value="reserved">
                                          <label class="fieldlabels">Reserved</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <input type="button" name="next" class="next action-button" value="Next" />
                              <input type="button" name="back" class="back action-button" value="back" />
                           </fieldset>
                           <!--5th step tab end-->
                        </form>

                        <form id="form_step_6" class="msform">
                        <fieldset>
                           <!--6th step -->
                           <div class="form-card">
                              <div class="row">
                                 <div class="col-7">
                                    <h2 class="fs-title">Replacement Details:</h2>
                                 </div>
                                 <div class="col-5">
                                    <h2 class="steps">Step 1 - 5</h2>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <label class="fieldlabels">Voluntary Card ID *</label> <input type="text" name="card" placeholder="Voluntary Card ID" /> 
                                 </div>
                                 <div class="col-md-6">
                                    <label class="fieldlabels">Without Replacement(Recommended By) *</label> <input type="text" name="card" placeholder="Without Replacement(Recommended By)" /> 
                                 </div>
                              </div>
                           </div>
                           <input type="button" name="next" class="next action-button" value="Submit" />
                        </fieldset>
                        <!--6th step tab end-->
                        </form>

                        <form id="form_step_7" class="msform">
                        <!--7th step tab -->
                        <fieldset>
                           <div class="form-card">
                              <div class="row">
                                 <div class="col-7">
                                    <h2 class="fs-title">Finish:</h2>
                                 </div>
                                 <div class="col-5">
                                    <h2 class="steps">Step 1 - 7</h2>
                                 </div>
                              </div>
                              <br><br>
                              <h2 class="purple-text text-center"><strong> Submit Successfully!</strong></h2>
                              <br>
                              <div class="row justify-content-center">
                                 <div class="col-3"> <img src="dist/img/check.png" class="fit-image"> </div>
                              </div>
                              <br><br>
                              <div class="row justify-content-center">
                                 <div class="col-7 text-center">
                                 </div>
                              </div>
                           </div>
                        </fieldset>
                        <!--7th step tab end-->
                        </form>

                     </div>
              	</div>
           	</div>
        </div>
    </div>
</section>


<style type="text/css">
	.questionnaire-content, .questionnaire-header {
       float: left;
       width: 100%;
       padding-left: 20px;
       padding-right: 20px;
       box-sizing: border-box;
   }
   .question-area {
       border: none;
       background: 0 0;
       border-radius: 0;
       margin-top: 40px;
   }
 
   .pre-question {
       margin-left: 30px;
       font-size: 20px;
       font-size: 1.6em;
   }
   .pre-question ol {
       font-size: .7em;
   }
   .pre-question li.question {
       margin-bottom: 45px;
       font-weight: 800;
       font-size: 100%;
   }
   .pre-question li.question fieldset {
       display: inline;
       vertical-align: top;
   }
   .pre-question fieldset>legend {
       display: block;
   }
   .pre-question li.question p.light {
       font-weight: 400;
   }
   .pre-question .buttons ul li{
       display: inline-block;
       /*margin-top: 30px;*/
   }

   .pre-questionnaire-container .quest-question-area {
       margin: 0;
       width: 100%;
   }
   .quest-question-area {
       width: 50%;
       box-sizing: border-box;
       font-size: inherit;
       margin: 45px 20px 20px 70px;
       float: left;
       line-height: 130%;
       text-align: center;
   }

   .continueRegisterationBtnContainer {
       text-align: center;
       line-height: 100%;
       padding: 0 50px;
       margin: 0;
       font-size: inherit;
   }
   .continueRegisterationBtnContainer a {
       color: #fff;
       font-size: inherit;
       margin-top: 0;
       font-weight: 700;
       background-color: #ab1d07;
       text-decoration: none;
   }
   .continueRegisterationBtn {
       background: #d81e05;
       background: -ms-linear-gradient(top,#d81e05 0,#ab010a 100%);
       background: linear-gradient(to bottom,#d81e05 0,#ab010a 100%);
       border-radius: 5px;
       text-align: center;
       color: #fff;
       border: none;
       padding: 15px 60px;
       font-size: inherit;
       width: auto;
       cursor: pointer;
       margin: 30px auto 0;
       display: inline-block;
   }
   .disabledContinue {
       background: #595959!important;
       opacity: .5;
   }

   .rad-label {
     display: flex;
     align-items: center;
     border-radius: 100px;
     margin: 10px 0;
     cursor: pointer;
     transition: .3s;
   }

   .rad-input {
     position: absolute;
     left: 0;
     top: 0;
     width: 1px;
     height: 1px;
     opacity: 0;
     z-index: -1;
     visibility: hidden;
   }

   .rad-design {
       width: 22px;
       height: 22px;
       border-radius: 100px;
       background: linear-gradient(to right bottom, hsl(356deg 59% 46%), hsl(356deg 59% 46%));
       position: relative;
   }

   .rad-design::before {
     content: '';

     display: inline-block;
     width: inherit;
     height: inherit;
     border-radius: inherit;

     background: hsl(0, 0%, 90%);
     transform: scale(1.1);
     transition: .3s;
   }

   .rad-input:checked+.rad-design::before {
     transform: scale(0);
   }

   .rad-text {
     color: #000000;
     margin-left: 14px;
     letter-spacing: 3px;
     text-transform: uppercase;
     font-size: 10px;
     font-weight: 900;

     transition: .3s;
   }

   .rad-input:checked~.rad-text {
     color: #000000
   }

   .fieldlabels{
   		font-weight: 900;
   }

   
   
/* The check */
.check {
    display: block;
    position: relative;
    padding-left: 25px;
    margin-bottom: 12px;
    padding-right: 15px;
    cursor: pointer;
    font-size: 13px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.check input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 3px;
    left: 0;
    height: 18px;
    width: 18px;
    background-color: #fff ;
    border-color:#f8204f;
    border-style:solid;
    border-width:2px;
}



/* When the checkbox is checked, add a blue background */
.check input:checked ~ .checkmark {
    background-color: #fff  ;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.check input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.check .checkmark:after {
    left: 5px;
    top: 1px;
    width: 5px;
    height: 10px;
    border: solid ;
    border-color:#f8204f;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

.cust-btn{
	margin-bottom: 10px;
	background-color: #f8204f;
	border-width: 2px;
	border-color: #f8204f;
	color: #fff;
}
.cust-btn:hover{
	
	border-color: #f8204f;
	background-color: #fff;
	color: #f8204f;
	border-radius: 20px;
	transform-style: 2s;

}

span.number-span{
	font-weight: 900;
}

</style>