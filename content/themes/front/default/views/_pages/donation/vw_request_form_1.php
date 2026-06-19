<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- progressbar -->
<ul id="progressbar">
<!--   <li class="active" id="account"><strong>Step 1</strong></li>
   <li id="personal"><strong>Step 2</strong></li>
   <li id="payment"><strong>Step 3</strong></li>
   <li id="payment"><strong>Step 4</strong></li>
   <li id="payment"><strong>Step 5</strong></li>
   <li id="payment"><strong>Step 6</strong></li>
   <li id="confirm"><strong>Finish</strong></li>
   </ul>
   <div class="progress">
   <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
   </div>
   <br> --> 
<!-- fieldsets -->
<form id="form_step_1" class="msform">
   <fieldset>
      <!--1st step -->
      <div class="form-card">
         <div class="row">
            <div class="col-7">
               <h2 class="fs-title" >Criteria For Blood Donation</h2>
            </div>
            <div class="col-5">
               <h2 class="steps">Step <?php echo $step_no;?></h2>
            </div>
         </div>
         <hr>
         <div class="row">
            <div class="col-md-12">
               <label class="fieldlabels"><span class="number-span">1.</span>When you'll donate the blood</label>
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input donation_time_selection" name="donation_time_selection" id="donation_time_today" value="today" <?php echo (!empty($form_data) && ($form_data->donation_time_selection->ans=='today'))?'checked="checked"':'';?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Today</div>
                           </label>
                        </li>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input donation_time_selection" name="donation_time_selection" value="other_day"  <?php echo (!empty($form_data) && ($form_data->donation_time_selection->ans=='other_day'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Some Other Day</div>
                           </label>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-12 well_feeling_div" style="<?php echo (!empty($form_data) && isset($form_data->donation_time_selection->ans) && ($form_data->donation_time_selection->ans=='today'))?'display: block;padding-left:50px;':'display: none;';?>">
               <label class="fieldlabels"><span class="number-span">a)</span> Are You Feeling Well Today To Donate Blood?</label>
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input" name="well_feeling" value="yes" <?php echo (!empty($form_data) && isset($form_data->donation_time_selection->ans_data->well_feeling) && ($form_data->donation_time_selection->ans_data->well_feeling=='yes'))?'checked="checked"':'';?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Yes</div>
                           </label>
                        </li>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input" name="well_feeling" value="no" <?php echo (!empty($form_data) && isset($form_data->donation_time_selection->ans_data->well_feeling) && ($form_data->donation_time_selection->ans_data->well_feeling=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">No</div>
                           </label>
                        </li>
                     </ul>
                  </div>
                  <label id="well_feeling-error" class="error" for="well_feeling" style="display:none;"></label>
               </div>
            </div>
            <div class="col-md-12 well_feeling_div" style="<?php echo (!empty($form_data) && isset($form_data->donation_time_selection->ans) && ($form_data->donation_time_selection->ans=='today'))?'display: block;padding-left:50px;':'display: none;';?>">
               <label class="fieldlabels"><span class="number-span">b)</span> Did you have anything to eat in last 4 hours?</label>
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input" name="fed_in_last_4_hrs" value="yes" <?php echo (!empty($form_data) && isset($form_data->donation_time_selection->ans_data->fed_in_last_4_hrs) && ($form_data->donation_time_selection->ans_data->fed_in_last_4_hrs=='yes'))?'checked="checked"':'';?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Yes</div>
                           </label>
                        </li>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input" name="fed_in_last_4_hrs" value="no" <?php echo (!empty($form_data) && isset($form_data->donation_time_selection->ans_data->fed_in_last_4_hrs) && ($form_data->donation_time_selection->ans_data->fed_in_last_4_hrs=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">No</div>
                           </label>
                        </li>
                     </ul>
                  </div>
                  <label id="fed_in_last_4_hrs-error" class="error" for="fed_in_last_4_hrs" style="display:none;"></label>
               </div>
            </div>
            <div class="col-md-12 well_feeling_div" style="<?php echo (!empty($form_data) && isset($form_data->donation_time_selection->ans) && ($form_data->donation_time_selection->ans=='today'))?'display: block;padding-left:50px;':'display: none;';?>">
               <label class="fieldlabels"><span class="number-span">c)</span> Did you sleep well last night?</label>
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input" name="well_slept_last_night" value="yes" <?php echo (!empty($form_data) && isset($form_data->donation_time_selection->ans_data->well_slept_last_night) && ($form_data->donation_time_selection->ans_data->well_slept_last_night=='yes'))?'checked="checked"':'';?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Yes</div>
                           </label>
                        </li>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input" name="well_slept_last_night" value="no" <?php echo (!empty($form_data) && isset($form_data->donation_time_selection->ans_data->well_slept_last_night) && ($form_data->donation_time_selection->ans_data->well_slept_last_night=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">No</div>
                           </label>
                        </li>
                     </ul>
                  </div>
                  <label id="well_slept_last_night-error" class="error" for="well_slept_last_night" style="display:none;"></label>
               </div>
            </div>
            <!-------->
            <div class="col-md-12" style="display: none;" >
               <label class="fieldlabels"><span class="number-span">1.</span> Have you donated blood previously ?</label> 
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_prev_donation" id="has_prev_donation" name="has_prev_donation" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_prev_donation->ans) && ($form_data->has_prev_donation->ans=='yes'))?'checked="checked"':'';?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Yes</div>
                           </label>
                        </li>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_prev_donation" name="has_prev_donation" value="no" <?php echo (!empty($form_data) && isset($form_data->has_prev_donation->ans) && ($form_data->has_prev_donation->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">No</div>
                           </label>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-12" id="prev_donation" style="<?php echo (!empty($form_data) && isset($form_data->has_prev_donation->ans) && ($form_data->has_prev_donation->ans=='yes'))?'display:block;':'display:none;';?>">
               <div class="row" style="padding-left: 50px;padding-right: 50px;padding-bottom: 50px;">
                  <div class="col-md-3">
                     <label class="fieldlabels">When Last </label> 
                     <input type="text" name="prev_donation_date" placeholder="Date of Admission" id="last_blood_donation" readonly  value="<?php echo (!empty($form_data) && isset($form_data->has_prev_donation->ans_data->prev_donation_date))?$form_data->has_prev_donation->ans_data->prev_donation_date:'';?>" /> 
                  </div>
                  <div class="col-md-12">
                     <label class="fieldlabels">In Which Blood Bank You Donated Previously?</label>
                  </div>
                  <div class="col-md-5">
                     <label class="fieldlabels">Blood Bank Name </label> 
                     <input type="text" name="prev_donation_bloodbank" placeholder="Blood Bank Name" value="<?php echo (!empty($form_data) && isset($form_data->has_prev_donation->ans_data->prev_donation_bloodbank))?$form_data->has_prev_donation->ans_data->prev_donation_bloodbank:'';?>"/> 
                  </div>
                  <div class="col-md-4">
                     <label class="fieldlabels">City Name </label> 
                     <input type="text" name="prev_donation_city" placeholder="City Name" value="<?php echo (!empty($form_data) && isset($form_data->has_prev_donation->ans_data->prev_donation_city))?$form_data->has_prev_donation->ans_data->prev_donation_city:'';?>"/> 
                  </div>
                  <div class="col-md-3">
                     <label class="fieldlabels">How many Times </label> 
                     <input type="number" min="0" name="prev_donation_times" value="<?php echo (!empty($form_data) && isset($form_data->has_prev_donation->ans_data->prev_donation_times))?$form_data->has_prev_donation->ans_data->prev_donation_times:'0';?>"/> 
                  </div>
                  <div class="col-md-12">
                     <label class="fieldlabels">Did You Have Any Discomfort During Or After Donation ?</label> 
                     <div class="pre-question">
                        <div class="buttons">
                           <ul>
                              <li>
                                 <label class="rad-label">
                                    <input type="radio" class="rad-input" name="has_discomfort_post_donation" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_discomfort_post_donation->ans) && ($form_data->has_discomfort_post_donation->ans=='yes'))?'checked="checked"':'';?>>
                                    <div class="rad-design"></div>
                                    <div class="rad-text">Yes</div>
                                 </label>
                              </li>
                              <li>
                                 <label class="rad-label">
                                    <input type="radio" class="rad-input" name="has_discomfort_post_donation" value="no" <?php echo (!empty($form_data) && isset($form_data->has_discomfort_post_donation->ans) && ($form_data->has_discomfort_post_donation->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
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
            <div class="col-md-12" style="display: none;">
               <label class="fieldlabels"><span class="number-span">2.</span> Have You Any Reason To Believe That Donation Shall Infect You ?</label> 
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input" name="has_infect_reason_believed" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_infect_reason_believed->ans) && ($form_data->has_infect_reason_believed->ans=='yes'))?'checked="checked"':'';?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Yes</div>
                           </label>
                        </li>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input" name="has_infect_reason_believed" value="no"  <?php echo (!empty($form_data) && isset($form_data->has_infect_reason_believed->ans) && ($form_data->has_infect_reason_believed->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
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
               <label class="fieldlabels"><span class="number-span">2.</span> Are You Suffering From :</label> 
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_general_differs" id="has_general_differs_yes" name="has_general_differs" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_general_differs->ans) && ($form_data->has_general_differs->ans=='yes'))?'checked="checked"':'';?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Yes</div>
                           </label>
                        </li>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_general_differs" name="has_general_differs" value="no"   <?php echo (!empty($form_data) && isset($form_data->has_general_differs->ans) && ($form_data->has_general_differs->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">No</div>
                           </label>
                        </li>
                     </ul>
                  </div>
                  <label id="general_differs[]-error" class="error" for="general_differs[]" style="display: none;"></label>
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
                     <input type="checkbox" name="general_differs[]" class="check_box" value="<?php echo $v->id;?>"  <?php echo (!empty($form_data) && isset($form_data->has_general_differs->ans) && ($form_data->has_general_differs->ans=='yes'))?'':'disabled="true"';?>  <?php echo (!empty($form_data) && (!empty($form_data->has_general_differs->ans_data) && in_array($v->id, $form_data->has_general_differs->ans_data) ))?'checked="checked"':'';?>>
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
               <label class="fieldlabels"><span class="number-span">3.</span> Have You Taking Or Have Taken Medicine In Last 72 Hours Any Of The Following:</label> 
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_taken_medicines" id="has_taken_medicines_yes" name="has_taken_medicines" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_taken_medicines->ans) && ($form_data->has_taken_medicines->ans=='yes'))?'checked="checked"':'';?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Yes</div>
                           </label>
                        </li>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_taken_medicines" name="has_taken_medicines" value="no" <?php echo (!empty($form_data) && isset($form_data->has_taken_medicines->ans) && ($form_data->has_taken_medicines->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">No</div>
                           </label>
                        </li>
                     </ul>
                  </div>
                  <label id="medicines_taken[]-error" class="error" for="medicines_taken[]" style="display: none;"></label>
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
                     <input type="checkbox" class="check_box" name="medicines_taken[]" value="<?php echo $v->id;?>" <?php echo (!empty($form_data) && isset($form_data->has_taken_medicines->ans) && ($form_data->has_taken_medicines->ans=='yes'))?'':'disabled="true"';?>  <?php echo (!empty($form_data) && (!empty($form_data->has_taken_medicines->ans_data) && in_array($v->id, $form_data->has_taken_medicines->ans_data) ))?'checked="checked"':'';?>>
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
               <label class="fieldlabels"><span class="number-span">4.</span> In The Last 2 Weeks Have You Been Vaccinated/Immunized For Any Of The Following</label> 
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_vaccinated" id="has_vaccinated_yes" name="has_vaccinated" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_vaccinated->ans) && ($form_data->has_vaccinated->ans=='yes'))?'checked="checked"':'';?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Yes</div>
                           </label>
                        </li>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_vaccinated" name="has_vaccinated" value="no" <?php echo (!empty($form_data) && isset($form_data->has_vaccinated->ans) && ($form_data->has_vaccinated->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">No</div>
                           </label>
                        </li>
                     </ul>
                  </div>
                  <label id="vaccinated_with[]-error" class="error" for="vaccinated_with[]" style="display: none;"></label>
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
                     <input type="checkbox" class="check_box" name="vaccinated_with[]" value="<?php echo $v->id;?>"  <?php echo (!empty($form_data) && isset($form_data->has_vaccinated->ans) && ($form_data->has_vaccinated->ans=='yes'))?'':'disabled="true"';?>  <?php echo (!empty($form_data) && (!empty($form_data->has_vaccinated->ans_data) && in_array($v->id, $form_data->has_vaccinated->ans_data) ))?'checked="checked"':'';?>>
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
               <label class="fieldlabels"><span class="number-span">5.</span> In The Last 2 Weeks Did You Suffer From Any Of The Following Diseases</label> 
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_last_2_week_differs" id="has_last_2_week_differs_yes" name="has_last_2_week_differs" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_last_2_week_differs->ans) && ($form_data->has_last_2_week_differs->ans=='yes'))?'checked="checked"':'';?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Yes</div>
                           </label>
                        </li>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_last_2_week_differs" name="has_last_2_week_differs" value="no"  <?php echo (!empty($form_data) && isset($form_data->has_last_2_week_differs->ans) && ($form_data->has_last_2_week_differs->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">No</div>
                           </label>
                        </li>
                     </ul>
                  </div>
                  <label id="last_2_week_differs_div[]-error" class="error" for="last_2_week_differs_div[]" style="display: none;"></label>
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
                     <input type="checkbox" class="check_box" name="weeked_differs[]" value="<?php echo $v->id;?>" <?php echo (!empty($form_data) && isset($form_data->has_last_2_week_differs->ans) && ($form_data->has_last_2_week_differs->ans=='yes'))?'':'disabled="true"';?>  <?php echo (!empty($form_data) && (!empty($form_data->has_last_2_week_differs->ans_data) && in_array($v->id, $form_data->has_last_2_week_differs->ans_data) ))?'checked="checked"':'';?>>
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
               <label class="fieldlabels"><span class="number-span">6.</span> In The Last 3 Months Have You Had Any Of The Following :</label> 
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_last_3_month_differs" id="has_last_3_month_differs_yes" name="has_last_3_month_differs" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_last_3_month_differs->ans) && ($form_data->has_last_3_month_differs->ans=='yes'))?'checked="checked"':'';?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Yes</div>
                           </label>
                        </li>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_last_3_month_differs" name="has_last_3_month_differs" value="no" <?php echo (!empty($form_data) && isset($form_data->has_last_3_month_differs->ans) && ($form_data->has_last_3_month_differs->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">No</div>
                           </label>
                        </li>
                     </ul>
                  </div>
                  <label id="three_months_differs[]-error" class="error" for="three_months_differs[]" style="display: none;"></label>
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
                     <input type="checkbox" class="check_box" name="three_months_differs[]" value="<?php echo $v->id;?>"  <?php echo (!empty($form_data)  && isset($form_data->has_last_3_month_differs->ans) && ($form_data->has_last_3_month_differs->ans=='yes'))?'':'disabled="true"';?>  <?php echo (!empty($form_data) && (!empty($form_data->has_last_3_month_differs->ans_data) && in_array($v->id, $form_data->has_last_3_month_differs->ans_data) ))?'checked="checked"':'';?>>
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
               <label class="fieldlabels"><span class="number-span">7.</span> In The Last 6 Months Have You Had Any Of The Following :</label> 
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_recent_difers" id="has_recent_difers_yes" name="has_recent_difers" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_recent_difers->ans) && ($form_data->has_recent_difers->ans=='yes'))?'checked="checked"':'';?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Yes</div>
                           </label>
                        </li>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_recent_difers" name="has_recent_difers" value="no" <?php echo (!empty($form_data) && isset($form_data->has_recent_difers->ans) && ($form_data->has_recent_difers->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">No</div>
                           </label>
                        </li>
                     </ul>
                  </div>
                  <label id="six_months_differs[]-error" class="error" for="six_months_differs[]" style="display: none;"></label>
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
                     <input type="checkbox" class="check_box" name="six_months_differs[]" value="<?php echo $v->id;?>" <?php echo (!empty($form_data) && isset($form_data->has_recent_difers->ans) && ($form_data->has_recent_difers->ans=='yes'))?'':'disabled="true"';?>  <?php echo (!empty($form_data) && (!empty($form_data->has_recent_difers->ans_data) && in_array($v->id, $form_data->has_recent_difers->ans_data) ))?'checked="checked"':'';?>>
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
               <label class="fieldlabels"><span class="number-span">8.</span> In The Last 12 Months Have You Had Any Of The Following :</label> 
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_last_12_month_differs" id="has_last_12_month_differs_yes" name="has_last_12_month_differs" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_last_12_month_differs->ans) && ($form_data->has_last_12_month_differs->ans=='yes'))?'checked="checked"':'';?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Yes</div>
                           </label>
                        </li>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_last_12_month_differs" name="has_last_12_month_differs" value="no"  <?php echo (!empty($form_data) && isset($form_data->has_last_12_month_differs->ans) && ($form_data->has_last_12_month_differs->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">No</div>
                           </label>
                        </li>
                     </ul>
                  </div>
                  <label id="twelve_months_diffres[]-error" class="error" for="twelve_months_diffres[]" style="display: none;"></label>
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
                     <input type="checkbox" class="check_box" name="twelve_months_diffres[]" value="<?php echo $v->id;?>"   <?php echo (!empty($form_data) && isset($form_data->has_last_12_month_differs->ans) && ($form_data->has_last_12_month_differs->ans=='yes'))?'':'disabled="true"';?>  <?php echo (!empty($form_data) && (!empty($form_data->has_last_12_month_differs->ans_data) && in_array($v->id, $form_data->has_last_12_month_differs->ans_data) ))?'checked="checked"':'';?>>
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
               <label class="fieldlabels"><span class="number-span">9.</span> Have You Ever Had Any Of The Following (Permanent Defer) :</label> 
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_perm_differ" id="has_perm_differ_yes" name="has_perm_differ" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_perm_differ->ans) && ($form_data->has_perm_differ->ans=='yes'))?'checked="checked"':'';?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">Yes</div>
                           </label>
                        </li>
                        <li>
                           <label class="rad-label">
                              <input type="radio" class="rad-input has_perm_differ" id="has_perm_differ_no" name="has_perm_differ" value="no" <?php echo (!empty($form_data) && isset($form_data->has_perm_differ->ans) && ($form_data->has_perm_differ->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                              <div class="rad-design"></div>
                              <div class="rad-text">No</div>
                           </label>
                        </li>
                     </ul>
                  </div>
                  <label id="permanent_differs[]-error" class="error" for="permanent_differs[]" style="display: none;"></label>
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
                     <input type="checkbox" class="check_box has_perm_differ_check" data-defer_name="<?php echo $v->defer_value;?>" name="permanent_differs[]" value="<?php echo $v->id;?>"  <?php echo (!empty($form_data) && isset($form_data->has_perm_differ->ans) && ($form_data->has_perm_differ->ans=='yes'))?'':'disabled="true"';?>  <?php echo (!empty($form_data) && (!empty($form_data->has_perm_differ->ans_data) && in_array($v->id, $form_data->has_perm_differ->ans_data) ))?'checked="checked"':'';?>>
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
      <input type="submit" class="next action-button" id="next_form" data-form_type="step_2" value="Next"/>
   </fieldset>
   <!--1st step tab end-->
</form>
<script type="text/javascript">
   $(document).ready(function(){
    $('#last_blood_donation').datepicker({
         format: 'dd-mm-yyyy'
      });
   
   
        $('#form_step_1').validate({
           ignore: [],
           rules:{
              well_feeling:{
                 required:'#donation_time_today:checked'
              },
              fed_in_last_4_hrs:{
                 required:'#donation_time_today:checked'
              },
              well_slept_last_night:{
                 required:'#donation_time_today:checked'
              },
              prev_donation_date:{
                 required:'#has_prev_donation:checked'
              },
              prev_donation_bloodbank:{
                 required:'#has_prev_donation:checked'
              },
              prev_donation_city:{
                 required:'#has_prev_donation:checked'
              },
              prev_donation_times:{
                 required:'#has_prev_donation:checked'
              },
              'general_differs[]':{
                 required:'#has_general_differs_yes:checked',
                 minlength: 1
              },
              'medicines_taken[]':{
                 required:'#has_taken_medicines_yes:checked',
                 minlength: 1
              },
              'vaccinated_with[]':{
                 required:'#has_vaccinated_yes:checked',
                 minlength: 1
              },
              'weeked_differs[]':{
                 required:'#has_last_2_week_differs_yes:checked',
                 minlength: 1
              },
              'three_months_differs[]':{
                 required:'#has_last_2_week_differs_yes:checked',
                 minlength: 1
              },
              'six_months_differs[]':{
                 required:'#has_recent_difers_yes:checked',
                 minlength: 1
              },
              'twelve_months_diffres[]':{
                 required:'#has_last_12_month_differs_yes:checked',
                 minlength: 1
              },
              'permanent_differs[]':{
                 required:'#has_perm_differ_yes:checked',
                 minlength: 1
              }
           },
           messages:{
              well_feeling:{
                 required:'Select option'
              },
              fed_in_last_4_hrs:{
                 required:'Select option'
              },
              well_slept_last_night:{
                 required:'Select option'
              },
              prev_donation_date:{
                 required:'Enter date'
              },
              prev_donation_bloodbank:{
                 required:'Enter blood bank name'
              },
              prev_donation_city:{
                 required:'Enter city'
              },
              prev_donation_times:{
                 required:'Enter number of times blood donated'
              },
              'general_differs[]':{
                 required:'Select at least one option'
              },
              'medicines_taken[]':{
                 required:'Select at least one option',
              },
              'vaccinated_with[]':{
                 required:'Select at least one option'
              },
              'weeked_differs[]':{
                 required:'Select at least one option'
              },
              'three_months_differs[]':{
                 required:'Select at least one option'
              },
              'six_months_differs[]':{
                 required:'Select at least one option'
              },
              'twelve_months_diffres[]':{
                 required:'Select at least one option'
              },
              'permanent_differs[]':{
                 required:'Select at least one option'
              }
           },
           submitHandler:function(){
              var formData=new FormData($('#form_step_1')[0]);
              formData.append([csrf_name],csrf_hash);
              formData.append('step_data','step_1');
              $.ajax({
                 type:'POST',
                 url:'<?php echo base_url('donation_request_submit');?>',
                 data:formData,
                 cache: false,
                 contentType: false,
                 processData: false,
                 timeout: 60000000,
                 success:function(d){
                    if(d.step){
                       load_forms(d.step);
                    }else{
                       alert(d.error);
                    }
                 }
              });
           }
        });
   
     $('body').on('click','#submit_data',function(){
           var formData=new FormData($('#form_step_1')[0]);
           formData.append([csrf_name],csrf_hash);
           formData.append('step_data','step_1');
           $.ajax({
              type:'POST',
              url:'<?php echo base_url('donation_request_submit');?>',
              data:formData,
              cache: false,
              contentType: false,
              processData: false,
              timeout: 60000000,
              success:function(d){
                var demsg='<div class="alert alert-success"><i class="fa fa-check"></i> Sorry you are not eligible to donate blood for but data has been collected.<br>You can refer someone else to donate blood.</div>';
   
                 $('#modifyModal').find('#modify_modal_msg').html(demsg);
   
   
                 setTimeout(function(){
   
                    $('#modifyModal').modal('hide');
                    window.location.href="<?php echo base_url();?>";
                 },2500);
   
                 
              }
           });
     });
   
   
   });
   
   $(document).ready(function() {
      $("input[name=donation_time_selection]").on( "change", function() {
          $(".desc").hide();
           var test = $(this).val();
           $(".desc").hide();
          // $("#"+test).show();
      } );
   });
</script>
