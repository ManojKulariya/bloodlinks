+<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
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
<?php 
$id= $this->uri->segment(4);
$userid= $this->uri->segment(5);

 $query6 = $this->db->query("SELECT * FROM bl_donar_form_info WHERE form_step = 'step_4' AND form_id = '$id'");
 // echo $this->db->last_query();die;
   // print_r($query6->result());

 foreach ($query6->result() as $row3)
{

      // print_r($row3);die;

    // $details=json_encode($data_to_store);
   $form_data3 = json_decode($row3->detail);
    // print_r($form_data3);die();
      // print_obj($form_data3);die();
}

 ?>
<form  action = "<?php $_PHP_SELF ?>" method = "POST" enctype="multipart/form-data" class="msform">
   <fieldset>
      <!--4th step -->
      <div class="form-card">
         <div class="row">
            <div class="col-7">
               <h2 class="fs-title">Informed Consent:</h2>
            </div>
            <div class="col-5">
               <h2 class="steps">Step. 4</h2>
            </div>
         </div>
         <hr>
         <div class="row">
            <?php //print_obj($form_data);?>
            <!-------->
            <div class="col-md-12">
            <h2>INFORMED CONSENT:</h2>
                  <ol>
                    <li>I have read and understood the intormati on in the donor form and education material.</li>
                    <li>.I confirm, that to my knowledge. I have answered all the questions accurately and truth fully and do not consider myself to be a person involved in any of thedescribed activities that could please me at the risk of spreading HIV or Hepatitis.</li>
                    <li>I understand that any willful misrepresentation of the facts could endanger the patients receiving my blood.</li>
                    <li>I am aware that my blood will be screened for HIV. Hepatitis B. Hepatitis C. Malaria & Syphilis in addition to any other screening tests required to ensureblood safety</li>
                    <li>I understand that screening test are not diagnostics and may yield false pas :live resoults.klt,awlsNooulnderstand further confirmatory test would be required incase of oostve results and that for any positive results❑ I MaY❑ be contacted
                    </li>
                    <li>I understand that my blood will be utlized in accordance with regulatory guide'mesinclud,ng NBTC and drug and cosmetic act and regulations pertaining toit or its future replacements</li>
                    <li>I understand the blood donation procedure and possible risk (vaso-vagal re act on. hematoma. etc.) involved as explained.</li>
                    <li>I confirm that I am over the age of 18 years</li>
                    <li>.I understand that blood donation is totally voluntary act and no inducement or remunerat on in cash or hind has been offered to me.</li>
                    <li>I prohibit any personal details (except demographic details) provided by me or about my donation to be disclosed to any individual or agency except askedby government.</li>
                    <li>I hereby declare that I am donating blood voluntarily without any pressure lone cchesionthreatlalse misconception from the Blood Bank.</li>
                    <li> I hereby volume-et to donate my Blood Blood components which may be used for pat,ent'scientific researchlfractionation (surplus plasma).</li>
                    <li> My donatea blood/ components may be utilized beyond this Blood Bank</li>
                    <li> You would liked to be informed about any abnormal test results (HIV, HBsAg, HCV, Syphilis, Malaria parasite) at the address furnished by you</li>
                  </ol>
                  <ul>
               <ul>
<!--                     <li> I have been give in the opportunity to ask question and they have been answered in the language understand. by me.
                      <div class="doneted_out">
                        <span>
                          <input type="radio" id="" name="AIUL" value="yes" checked>
                          <label class="fieldlabels">Yes</label>
                        </span>
                        <span>
                          <input type="radio" id="" name="AIUL" value="no">
                          <label class="fieldlabels">No</label> 
                        </span>
                      </div>
                    </li>
  
                    <li>
                      I have given the opportunity to refuse the blood donation
                      <div class="doneted_out">
                        <span>
                          <input type="radio" id="gender" name="OTR-blood-donation" value="yes">
                          <label class="fieldlabels">Yes</label>
                        </span>
                        <span>
                          <input type="radio" id="gender" name="OTR-blood-donation" value="no" checked>
                          <label class="fieldlabels">No</label>
                        </span>
                    </li>
                    <li>
                      I would like to be regular voluntary donor :
                      <br>
                      <div class="doneted_out">
                        <span>
                          <input type="radio" id="regularvoluntary_yes" name="voluntary-donor" value="yes" onclick="$('#reg_voluntary').show()">
                          <label class="fieldlabels">Yes</label>
                        </span>
                        <span>
                          <input type="radio" id="regularvoluntary_no" name="voluntary-donor" value="no" checked onclick="$('#reg_voluntary').hide()">
                          <label class="fieldlabels">No</label>
                        </span>
                      </div>
                    </li>
                  </ul>
                  <div class="doneted_out">
                    
                    <div id="reg_voluntary" class='regularvoluntary' style="display: none;">
                      <span>
                        <input type="checkbox" class='regularvoluntary' id="Birthday" name="volunteer-type" value="yes">
                        <label class="fieldlabels">Birthday</label>
                      </span>
                      </span>
                        <input type="checkbox" class='regularvoluntary' id="Marriage Anniversary" name="volunteer-type" value="yes">
                        <label class="fieldlabels">Marriage Anniversary</label>
                      </span>
                      <span>
                        <input type="checkbox" class='regularvoluntary' id="month" name="volunteer-type" value="yes">
                        <label class="fieldlabels">After 6 month</label></span>
                      <sapn>
                        <input type="checkbox" class='regularvoluntary' id="Onceayear" name="volunteer-type" value="yes">
                        <label class="fieldlabels">Onceayear</label>
                      </span>
                      <span>
                        <input type="checkbox" class='regularvoluntary' id="Emergency" name="volunteer-type" value="yes">
                        <label class="fieldlabels">In Emergency Requirement</label>
                      </span>
                    </div>
                    <div id="regularvoluntary_err"></div>
                  </div> -->
                  <h3>GENERAL PHYSICAL EXAMINATION</h3>
                    <div class="row">
                      <div class="col-md-4">
                        weight :<input type="text" id="d_weight" value="<?= !empty($form_data3->weight); ?>" name="weight">
                      </div>
                      <div class="col-md-4">
                        Hemoglobin :<input type="text" id="d_hemoglobin" value="<?= !empty($form_data3->hemoglobin); ?>" name="hemoglobin">
                      </div>
                      <div class="col-md-4">
                        BP :<input type="text" id="d_bp" value="<?= !empty($form_data3->BP); ?>" name="BP">
                      </div>
                    </div>
                  <div class="row">
                    <div class="col-md-4" id="d_weight_err"></div>
                    <div class="col-md-4" id="d_hemoglobin_err"></div>
                    <div class="col-md-4" id="d_bp_err"></div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 Temperature_cls form-group">
                      <label class="fieldlabels">* Temperature :</label>
                      <div class="doneted_out">
                        <span>
                          <input type="radio" id="pre_donated_yes" name="temperature" value="normal"<?php echo (!empty($form_data3) && isset($form_data3->temperature) && ($form_data3->temperature=='normal'))?'checked="checked"':'';?>>
                          <label class="fieldlabels">Normal</label>
                        </span>
                        <span>
                          <input type="radio" id="pre_donated_no" name="temperature" value="no" <?php echo (!empty($form_data3) && isset($form_data3->temperature) && ($form_data3->temperature=='no'))?'checked="checked"':(empty($form_data3)?'checked="checked"':'');?>>
                          <label class="fieldlabels">Abnormal</label> 
                        </span>
                      </div>
                    </div>
                    <div class="col-md-12 pulse_cls form-group">
                      <label class="fieldlabels"> * Pulse :</label>
                      <div class="doneted_out">
                        <span>
                          <input type="radio" id="pre_donated_yes" name="pulse" value="normal" <?php echo (!empty($form_data3) && isset($form_data3->pulse) && ($form_data3->pulse=='normal'))?'checked="checked"':'';?>>
                          <label class="fieldlabels">Normal</label>
                        </span>
                        <span>
                          <input type="radio" id="pre_donated_no" name="pulse" value="no" <?php echo (!empty($form_data3) && isset($form_data3->pulse) && ($form_data3->pulse=='no'))?'checked="checked"':(empty($form_data3)?'checked="checked"':'');?>> 
                          <label class="fieldlabels">Abnormal</label> 
                        </span>
                      </div>
                    </div>
                  </div>
               <table style="width:100%" cellspacing="20">
                    <tbody>
                     <tr>
                      <th>MEDICAL & SYSTEMIC EXAMINATIONON :</th>
                      <th> 
                        <label class="rad-label">
                            <input type="radio" class="rad-input has_accepted_defer" name="has_accepted_defer" value="accept" <?php echo (!empty($form_data3) && isset($form_data3->has_accepted_defer) && ($form_data3->has_accepted_defer=='accept'))?'checked="checked"':'';?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">Accept</div>
                        </label>   
                      </th>
                      <th> 
                        <label class="rad-label">
                            <input type="radio" class="rad-input has_accepted_defer" name="has_accepted_defer" value="defer" <?php echo (!empty($form_data3) && isset($form_data3->has_accepted_defer) && ($form_data3->has_accepted_defer=='defer'))?'checked="checked"':(empty($form_data3)?'checked="checked"':'');?>>
                            <div class="rad-design"></div>
                            <div class="rad-text">Defer</div>
                        </label>
                     </th>
                    </tr>
                  </tbody>
               </table>
            </div>
            <div class="col-md-12" style="padding-top: 20px;">
               <table style="width:100%">
                  <tbody>
                     <tr>
                      <td>Signature or Thumb Impression</td>
                      <td><input type="file" name="file"></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
     <a href="<?php echo base_url('admin/donations/donation_form5/'.$id.'/'.$userid.'');?>"  class="btn btn-success btn-md pull-right" type="button"/>Next</a>
     <!-- <button type="submit" class="btn btn-success btn-md pull-right">Next</button> -->
   </fieldset>
   <!--4th step tab end-->
</form>
<?php  
// $medical = $_POST['has_accepted_defer'];
// $targetfolder = base_url('uploads/app/');
// $uploadfile = $targetfolder . basename( $_FILES['file']['name']) ;
// if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile))

//  {

  // print_r($_FILES['file']['name']);die;
  // $config = array(
  //               'upload_path' => "./uploads/",
  //               'allowed_types' => "gif|jpg|png|jpeg|pdf",
  //               'overwrite' => TRUE,
  //               'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
  //               'max_height' => "768",
  //               'max_width' => "1024"
  //           );

  // $this->load->library('upload', $config);

  // $details=json_encode($_POST);
                    // print_r($details);
                    // die();
 // $insert = $this->db->query("INSERT INTO bl_donar_form_info (form_id, user_id, form_step, detail) VALUES ('$id', '$userid', 'step_4', '$details')");
// echo $this->db->insert_id();die;
  // if($insert==true){
   // redirect('admin/donations/donation_form5/'.$id.'/'.$userid.'');
  // } else{
  // echo "fail";
  // } 
//}
// } ?>
<!-- <?php

 
// print_r($targetfolder);
  
 ?> -->
<!-- <script type="text/javascript">
   $(document).ready(function(){

      $('#form_step_4').validate({
         rules:{
      
         },
         messages:{
         },
         submitHandler:function(){
            var formData=new FormData($('#form_step_4')[0]);
            formData.append([csrf_name],csrf_hash);
            formData.append('step_data','<?php echo $current_step;?>');
            $.ajax({
               type:'POST',
               url:'<?php echo base_url('donation_request_update');?>',
               data:formData,
               cache: false,
               contentType: false,
               processData: false,
               timeout: 60000000,
               success:function(d){

                  if(d.procced=='yes'){
                     load_forms(d.step);
                  }else if(d.procced=='no'){
                     alert(d.reason);
                     $('#deferReasonModal').modal('show');
                  }
                  else{
                     alert(d.error);
                  }
               }
            });

            console.log(formData);
         }
      });
   });
</script> -->
