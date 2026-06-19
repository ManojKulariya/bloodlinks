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
<br -->
<!-- fieldsets -->

<form id="form_step_3" class="msform">
   <fieldset>
      <!--3rd step -->
      <div class="form-card">
         <div class="row">
            <div class="col-7">
               <h2 class="fs-title">Self Exclusion Quetionaire (Please answer all question honestly your answers will be confidential):</h2>
            </div>
            <div class="col-5">
               <h2 class="steps">Step <?php echo $step_no;?></h2>
            </div>
         </div>
         <hr>
         <div class="row">
            <!-------->
            <div class="col-md-12">
               <label class="fieldlabels"><span class="number-span">1.</span> Do you practice safe sex ?</label> 
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input has_safe_sex" data-id_name="has_safe_sexe_yes" id="has_safe_sexe_yes" data-defer_name="Practice safe sex" name="has_safe_sex" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_safe_sex->ans) && ($form_data->has_safe_sex->ans=='yes'))?'checked="checked"':'';?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">Yes</div>
                           </label>   
                        </li>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input has_safe_sex" data-id_name="has_safe_sexe_yes" id="has_safe_sexe_yes" data-defer_name="Practice safe sex" name="has_safe_sex" value="no" <?php echo (!empty($form_data) && isset($form_data->has_safe_sex->ans) && ($form_data->has_safe_sex->ans=='no'))?'checked="checked"':'';?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">No</div>
                           </label> 
                        </li>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input has_safe_sex" data-id_name="has_safe_sexe_yes" id="has_safe_sexe_na" data-defer_name="Practice safe sex" name="has_safe_sex" value="na" <?php echo (!empty($form_data) && isset($form_data->has_safe_sex->ans) && ($form_data->has_safe_sex->ans=='na'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">N/A</div>
                           </label> 
                        </li>
                     </ul>
                  </div>
               </div> 
            </div>
            <!-------->
            <div class="col-md-12">
               <label class="fieldlabels"><span class="number-span">2.</span> Are you HIV Positive or do you think you may be HIV Positive?</label> 
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input has_hiv_positive" data-id_name="has_hiv_positive_no" id="has_hiv_positive_yes" data-defer_name="HIV Positive" name="has_hiv_positive" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_hiv_positive->ans) && ($form_data->has_hiv_positive->ans=='yes'))?'checked="checked"':'';?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">Yes</div>
                           </label>   
                        </li>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input has_hiv_positive" data-id_name="has_hiv_positive_no" id="has_hiv_positive_no" data-defer_name="HIV Positive"  name="has_hiv_positive" value="no" <?php echo (!empty($form_data) && isset($form_data->has_hiv_positive->ans) && ($form_data->has_hiv_positive->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
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
               <label class="fieldlabels"><span class="number-span">3.</span> Is your reason for donating blood to undergo an HIV test ?</label> 
               <div class="pre-question">
                  <div class="buttons">
                     <ul>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input to_undergo_hiv_test" name="to_undergo_hiv_test" value="yes" <?php echo (!empty($form_data) && isset($form_data->to_undergo_hiv_test->ans) && ($form_data->to_undergo_hiv_test->ans=='yes'))?'checked="checked"':'';?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">Yes</div>
                           </label>   
                        </li>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input to_undergo_hiv_test" name="to_undergo_hiv_test" value="no" <?php echo (!empty($form_data) && isset($form_data->to_undergo_hiv_test->ans) && ($form_data->to_undergo_hiv_test->ans=='no'))?'checked="checked"':'';?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">No</div>
                           </label> 
                        </li>
                        <li>
                           <label class="rad-label">
                            <input type="radio" class="rad-input to_undergo_hiv_test" name="to_undergo_hiv_test" value="none"  <?php echo (!empty($form_data) && isset($form_data->to_undergo_hiv_test->ans) && ($form_data->to_undergo_hiv_test->ans=='none'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">No of these</div>
                           </label> 
                        </li>
                     </ul>
                  </div>
               </div> 
            </div>
            <!-------->
            <div class="col-md-12">
               <label class="fieldlabels"><span class="number-span">4.</span> In the past 6 months:</label> 
               <div class="pre-question">
                  <!-------->
                  <div class="col-md-12">
                     <label class="fieldlabels"><span class="number-span">a)</span> Have you had sexual activity by paying money or vise versa ?</label> 
                     <div class="pre-question">
                        <div class="buttons">
                           <ul>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_sex_with_money" data-id_name="has_sex_with_money_no" id="has_sex_with_money_yes" data-defer_name="Sexual activity by paying money or vise versa " name="has_sex_with_money" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_sex_with_money->ans) && ($form_data->has_sex_with_money->ans=='yes'))?'checked="checked"':'';?>>
                                  <div class="rad-design"></div>
                                  <div class="rad-text">Yes</div>
                                 </label>   
                              </li>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_sex_with_money" data-id_name="has_sex_with_money_no" id="has_sex_with_money_no" data-defer_name="Sexual activity by paying money or vise versa" name="has_sex_with_money" value="no" <?php echo (!empty($form_data) && isset($form_data->has_sex_with_money->ans) && ($form_data->has_sex_with_money->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
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
                     <label class="fieldlabels"><span class="number-span">b)</span> Have you had multiple sex partners ?</label> 
                     <div class="pre-question">
                        <div class="buttons">
                           <ul>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_multiple_sex_partner" data-id_name="has_multiple_sex_partner_no" id="has_multiple_sex_partner_yes" data-defer_name="Multiple sex partner" name="has_multiple_sex_partner" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_multiple_sex_partner->ans) && ($form_data->has_multiple_sex_partner->ans=='yes'))?'checked="checked"':'';?>>
                                  <div class="rad-design"></div>
                                  <div class="rad-text">Yes</div>
                                 </label>   
                              </li>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_multiple_sex_partner" data-id_name="has_multiple_sex_partner_no" id="has_multiple_sex_partner_no" data-defer_name="Multiple sex partner" name="has_multiple_sex_partner" value="no" <?php echo (!empty($form_data) && isset($form_data->has_multiple_sex_partner->ans) && ($form_data->has_multiple_sex_partner->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
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
                     <label class="fieldlabels"><span class="number-span">c)</span> Victim of sexual assault ?</label> 
                     <div class="pre-question">
                        <div class="buttons">
                           <ul>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_sexual_assualt" name="has_sexual_assualt" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_sexual_assualt->ans) && ($form_data->has_sexual_assualt->ans=='yes'))?'checked="checked"':'';?>>
                                  <div class="rad-design"></div>
                                  <div class="rad-text">Yes</div>
                                 </label>   
                              </li>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_sexual_assualt" name="has_sexual_assualt" value="no" <?php echo (!empty($form_data) && isset($form_data->has_sexual_assualt->ans) && ($form_data->has_sexual_assualt->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
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
                     <label class="fieldlabels"><span class="number-span">d)</span> Sex with someone whose background you do not know ?</label> 
                     <div class="pre-question">
                        <div class="buttons">
                           <ul>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_sex_with_stranger" data-id_name="has_sex_with_stranger_no" id="has_sex_with_stranger_yes" data-defer_name="Sex with stranger" name="has_sex_with_stranger" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_sex_with_stranger->ans) && ($form_data->has_sex_with_stranger->ans=='yes'))?'checked="checked"':'';?>>
                                  <div class="rad-design"></div>
                                  <div class="rad-text">Yes</div>
                                 </label>   
                              </li>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_sex_with_stranger" data-id_name="has_sex_with_stranger_no" id="has_sex_with_stranger_no" data-defer_name="Sex with stranger" name="has_sex_with_stranger" value="no" <?php echo (!empty($form_data) && isset($form_data->has_sex_with_stranger->ans) && ($form_data->has_sex_with_stranger->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                                  <div class="rad-design"></div>
                                  <div class="rad-text">No</div>
                                 </label> 
                              </li>
                           </ul>
                        </div>
                        <label id="has_sex_with_stranger-error" class="error" for="has_sex_with_stranger" style="display:none;"></label>
                     </div> 
                  </div>
               </div> 
            </div>
            <!-------->
            <div class="col-md-12">
               <label class="fieldlabels"><span class="number-span">5.</span> In the past 12 months:</label> 
               <div class="pre-question">
                  <!-------->
                  <div class="col-md-12">
                     <label class="fieldlabels"><span class="number-span">a)</span> Have you suffered from sexually Transmitted disease ?</label> 
                     <div class="pre-question">
                        <div class="buttons">
                           <ul>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_sexually_transmitted_disease" data-id_name="has_sexually_transmitted_disease_no" id="has_sexually_transmitted_disease_yes" data-defer_name="Suffered from sexually Transmitted disease" name="has_sexually_transmitted_disease" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_sexually_transmitted_disease->ans) && ($form_data->has_sexually_transmitted_disease->ans=='yes'))?'checked="checked"':'';?>>
                                  <div class="rad-design"></div>
                                  <div class="rad-text">Yes</div>
                                 </label>   
                              </li>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_sexually_transmitted_disease" data-id_name="has_sexually_transmitted_disease_no" id="has_sexually_transmitted_disease_no" data-defer_name="Suffered from sexually Transmitted disease" name="has_sexually_transmitted_disease" value="no" <?php echo (!empty($form_data) && isset($form_data->has_sexually_transmitted_disease->ans) && ($form_data->has_sexually_transmitted_disease->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
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
                     <label class="fieldlabels"><span class="number-span">b)</span> Have you ever injected yourself with drugs not prescribed by doctor ?</label> 
                     <div class="pre-question">
                        <div class="buttons">
                           <ul>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_injected_drugs" data-id_name="has_injected_drugs_no" id="has_injected_drugs_yes" data-defer_name="injected yourself with drugs not prescribed by doctor" name="has_injected_drugs" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_injected_drugs->ans) && ($form_data->has_injected_drugs->ans=='yes'))?'checked="checked"':'';?>>
                                  <div class="rad-design"></div>
                                  <div class="rad-text">Yes</div>
                                 </label>   
                              </li>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_injected_drugs" data-id_name="has_injected_drugs_no" id="has_injected_drugs_no" data-defer_name="injected yourself with drugs not prescribed by doctor" name="has_injected_drugs" value="no" checked="checked" <?php echo (!empty($form_data) && isset($form_data->has_injected_drugs->ans) && ($form_data->has_injected_drugs->ans=='yes'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
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
                     <label class="fieldlabels"><span class="number-span">c)</span> Do you think any of the above questions may be true for your sex partner ?</label> 
                     <div class="pre-question">
                        <div class="buttons">
                           <ul>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_thinking_above_questions_true" data-id_name="has_thinking_above_questions_true_no" id="has_thinking_above_questions_true_yes" data-defer_name="Thinks any of the above questions may be true for your sex partner" name="has_thinking_above_questions_true" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_thinking_above_questions_true->ans) && ($form_data->has_thinking_above_questions_true->ans=='yes'))?'checked="checked"':'';?>>
                                  <div class="rad-design"></div>
                                  <div class="rad-text">Yes</div>
                                 </label>   
                              </li>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_thinking_above_questions_true" data-id_name="has_thinking_above_questions_true_no" id="has_thinking_above_questions_true_no" data-defer_name="Thinks any of the above questions may be true for your sex partner" name="has_thinking_above_questions_true" value="no" <?php echo (!empty($form_data) && isset($form_data->has_thinking_above_questions_true->ans) && ($form_data->has_thinking_above_questions_true->ans=='no'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
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
                     <label class="fieldlabels"><span class="number-span">d)</span> Do you consider your blood safe for transfusion to a patient ?</label> 
                     <div class="pre-question">
                        <div class="buttons">
                           <ul>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_consider_self_safe_transfusion" data-id_name="has_consider_self_safe_transfusion_yes" id="has_consider_self_safe_transfusion_yes" data-defer_name="Considering blood is not safe for transfusion to patient" name="has_consider_self_safe_transfusion" value="yes" <?php echo (!empty($form_data) && isset($form_data->has_consider_self_safe_transfusion->ans) && ($form_data->has_consider_self_safe_transfusion->ans=='yes'))?'checked="checked"':(empty($form_data)?'checked="checked"':'');?>>
                                  <div class="rad-design"></div>
                                  <div class="rad-text">Yes</div>
                                 </label>   
                              </li>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input has_consider_self_safe_transfusion" data-id_name="has_consider_self_safe_transfusion_yes" id="has_consider_self_safe_transfusion_no" data-defer_name="Considering blood is not safe for transfusion to patient" name="has_consider_self_safe_transfusion" value="no" <?php echo (!empty($form_data) && isset($form_data->has_consider_self_safe_transfusion->ans) && ($form_data->has_consider_self_safe_transfusion->ans=='no'))?'checked="checked"':'';?>>
                                  <div class="rad-design"></div>
                                  <div class="rad-text">No</div>
                                 </label> 
                              </li>
                              <li>
                                 <label class="rad-label">
                                  <input type="radio" class="rad-input" name="has_consider_self_safe_transfusion" value="none" <?php echo (!empty($form_data) && isset($form_data->has_consider_self_safe_transfusion->ans) && ($form_data->has_consider_self_safe_transfusion->ans=='none'))?'checked="checked"':'';?>>
                                  <div class="rad-design"></div>
                                  <div class="rad-text">None of these</div>
                                 </label> 
                              </li>
                           </ul>
                        </div>
                     </div> 
                  </div>
                  <div class="col-md-12">
                     <div class="pre-question">
                        <div class="buttons">
                           <ol>
                              <li  style="font-size: 18px;">
                                 The test done on your donated Blood are follows :
                                 <ol>
                                    <li>HBsAg</li>
                                    <li>Anti HIV</li>
                                    <li>Anti HCV</li>
                                    <li>Syphilis</li>
                                    <li>Malaria Parasite</li>
                                 </ol>
                              </li>
                              <li style="font-size: 18px;">These tests are also done free of cost at ICTC Centre. If you are looking to get the test done, please contact Department of Microbiology,SMS Medical College. Jaipur.</li>
                              <li style="font-size: 18px;">All the test results are kept highly confidential.</li>
                              <li style="font-size: 18px;"><b>Danger: </b> The window period : It refers to the time from when a person is first infected till the person tests positive. During the window period, laboratory tests are negative but the person is still capable of infecting others. Help keep the blood supply as safe as possible by looking honestly at your lifestyle & answering the question truthfully.</li>
                           </ol>
                        </div>
                     </div>
                  </div>
               </div> 
            </div>
         </div>
      </div>
      <?php //print_r($step); 

// echo "dddd";
      ?>
      <?php //print_r($step_back); ?>
     <input type="submit" name="next" class="next action-button" id="next_form" data-form_type="step_<?php echo $step;?>" value="Next" />
      <input type="button" name="next" class="next action-button" id="prev_form" data-form_type="step_2" value="Back" />
   </fieldset>
   <!--3rd step tab end-->
</form>

<script type="text/javascript">
   $(document).ready(function(){
      $('#form_step_3').validate({
         rules:{
            has_safe_sex:{
               required:true
            },
            has_hiv_positive:{
               required:true
            },
            to_undergo_hiv_test:{
               required:true
            },
            has_sex_with_money:{
               required:true
            },
            has_multiple_sex_partner:{
               required:true
            },
            has_sexual_assualt:{
               required:true
            },
            has_sex_with_stranger:{
               required:true
            },
            has_sexually_transmitted_disease:{
               required:true
            },
            has_injected_drugs:{
               required:true
            },
            has_thinking_above_questions_true:{
               required:true
            },
            has_consider_self_safe_transfusion:{
               required:true
            }
         },
         messages:{
            has_safe_sex:{
               required:'Select option'
            },
            has_hiv_positive:{
               required:'Select option'
            },
            to_undergo_hiv_test:{
               required:'Select option'
            },
            has_sex_with_money:{
               required:'Select option'
            },
            has_multiple_sex_partner:{
               required:'Select option'
            },
            has_sexual_assualt:{
               required:'Select option'
            },
            has_sex_with_stranger:{
               required:'Select option'
            },
            has_sexually_transmitted_disease:{
               required:'Select option'
            },
            has_injected_drugs:{
               required:'Select option'
            },
            has_thinking_above_questions_true:{
               required:'Select option'
            },
            has_consider_self_safe_transfusion:{
               required:'Select option'
            }
         },
         submitHandler:function(){
            var formData=new FormData($('#form_step_3')[0]);
            formData.append([csrf_name],csrf_hash);
            formData.append('step_data','<?php echo $current_step;?>');
            $.ajax({
               type:'POST',
               url:'<?php echo base_url('donation_request_submit');?>',
               data:formData,
               cache: false,
               contentType: false,
               processData: false,
               timeout: 60000000,
               success:function(d){
                console.log('check page'+d.step);
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