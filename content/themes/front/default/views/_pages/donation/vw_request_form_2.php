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
</div>
<br>  -->
<!-- fieldsets -->

<form id="form_step_2" class="msform">
   <fieldset>
      <!--2nd step -->
      <div class="form-card">
         <div class="row">
            <div class="col-7">
               <h2 class="fs-title">Physiological Status for Women:</h2>
            </div>
            <div class="col-5">
               <h2 class="steps">Step <?php echo $step_no;?></h2>
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
                            <input type="radio" class="rad-input has_pregnant" name="has_pregnant" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_pregnant->ans) && ($form_data->has_pregnant->ans=='yes'))?'checked="checked"':'';?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">Yes</div>
                           </label>   
                        </li>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input has_pregnant" name="has_pregnant" value="no" <?php echo (!empty($form_data) && isset($form_data->has_pregnant->ans) && ($form_data->has_pregnant->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">No</div>
                           </label> 
                        </li>
                     </ul>
                  </div>
                  <label id="has_pregnant-error" class="error" for="has_pregnant" style="display:none;"></label>
               </div> 
            </div>
            <div class="col-md-12">
               <label class="fieldlabels"><span class="number-span">2.</span> Abortion (6 Months)?:</label>
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input has_abortion" name="has_abortion" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_abortion->ans) && ($form_data->has_abortion->ans=='yes'))?'checked="checked"':'';?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">Yes</div>
                           </label>   
                        </li>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input has_abortion" name="has_abortion" value="no" <?php echo (!empty($form_data) && isset($form_data->has_abortion->ans) && ($form_data->has_abortion->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">No</div>
                           </label> 
                        </li>
                     </ul>
                  </div>
                  <label id="has_abortion-error" class="error" for="has_abortion" style="display:none;"></label>
               </div> 
            </div>
            <div class="col-md-5">
               <label class="fieldlabels"><span class="number-span">3.</span> When Did You Have Last Menstrual Period</label>
               <input type="text" name="last_menstrual_period" placeholder="mm-dd-yyyy" id="last_menstrual_period" value="<?php echo (!empty($form_data) && isset($form_data->last_menstrual_period->ans_data))?$form_data->last_menstrual_period->ans_data:'';?>" />
            </div>
            <div class="col-md-12">
               <label class="fieldlabels"><span class="number-span">4.</span> Are You Breast Feeding (12 Months)?:</label>
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input has_breast_feeden_last_12_month" name="has_breast_feeden_last_12_month" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_breast_feeden_last_12_month->ans) && ($form_data->has_breast_feeden_last_12_month->ans=='yes'))?'checked="checked"':'';?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">Yes</div>
                           </label>   
                        </li>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input has_breast_feeden_last_12_month" name="has_breast_feeden_last_12_month" value="no" <?php echo (!empty($form_data) && isset($form_data->has_breast_feeden_last_12_month->ans) && ($form_data->has_breast_feeden_last_12_month->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">No</div>
                           </label> 
                        </li>
                     </ul>
                  </div>
                  <label id="has_breast_feeden_last_12_month-error" class="error" for="has_breast_feeden_last_12_month" style="display:none;"></label>
               </div> 
            </div>
            <div class="col-md-12">
               <label class="fieldlabels"><span class="number-span">5.</span> Do You Have Child Less Than 1 Year Old?:</label>
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input has_child_less_one_year" name="has_child_less_one_year" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_child_less_one_year->ans) && ($form_data->has_child_less_one_year->ans=='yes'))?'checked="checked"':'';?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">Yes</div>
                           </label>   
                        </li>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input has_child_less_one_year" name="has_child_less_one_year" value="no" <?php echo (!empty($form_data) && isset($form_data->has_child_less_one_year->ans) && ($form_data->has_child_less_one_year->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">No</div>
                           </label> 
                        </li>
                     </ul>
                  </div>
                  <label id="has_child_less_one_year-error" class="error" for="has_child_less_one_year" style="display:none;"></label>
               </div> 
            </div>
         </div>
      </div>

      <input type="submit" name="next" class="next action-button" id="next_form" data-form_type="<?php echo $step;?>" value="Next" />
      <input type="button" name="next" class="next action-button" id="prev_form" data-form_type="step_1" value="Back" />
      <!-- <input type="button"  class="back action-button" id="next_form" data-form_type="step_<?php echo $step_back;?>" value="Back"/> -->
   </fieldset>
   <!--2nd step tab end-->
</form>

<script type="text/javascript">
	$(document).ready(function(){
		$('#last_menstrual_period').datepicker({
	      format: 'dd-mm-yyyy'
	  	});

      $('#form_step_2').validate({
         rules:{
            has_pregnant:{
               required:true
            },
            has_abortion:{
               required:true
            },
            last_menstrual_period:{
               required:true
            },
            has_breast_feeden_last_12_month:{
               required:true
            },
            has_child_less_one_year:{
               required:true
            }
         },
         messages:{
            has_pregnant:{
               required:'Select option'
            },
            has_abortion:{
               required:'Select option'
            },
            last_menstrual_period:{
               required:'Enter the date'
            },
            has_breast_feeden_last_12_month:{
               required:'Select option'
            },
            has_child_less_one_year:{
               required:'Select option'
            }
         },
         submitHandler:function(){
            var formData=new FormData($('#form_step_2')[0]);
            formData.append([csrf_name],csrf_hash);
            formData.append('step_data','step_2');
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

            console.log(formData);
         }
      });
	});
</script>

<script>
  window.scrollTo(0, 0);
</script>