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

<style>

   #maynot{
display:inline-block;
width:30px;
margin-left:0px !important;
}

#maybe{display:inline-block;
   width:30px;
   margin-left:25px !important;

}
.maybe-1{
   display:inline-block;
}
.maybe-2{
   display:inline-block;
}
.list-head-5{
   list-style-type:disc;
}
.check-ayu{
   display: block !important;
    margin-left: 12% !important;
    /* margin-top: 8px !important; */
    margin-bottom: -15px !important ;
        /* margin-bottom: 25px; */
        margin-top: 2px !important;
        width:214%!important;
    /* width: 100%; */
}
#javas{
   display:none;
}
.here-jam1{
   display:flex;
   flex-direction:row;
   gap:20px;
}
.here-jam3{
   display:flex;
}
input{
  background-color: #ad1e1d !important;
    border-color: #ad1e1d !important;
}
label{
   padding-right:69px;
}
 input[type=checkbox] {
          accent-color: red;
        }
</style>

<form id="form_step_4" class="msform">
   <fieldset>
      <!--4th step -->
      <div class="form-card">
         <div class="row">
            <div class="col-7">
               <h2 class="fs-title">Informed Consent:</h2>
            </div>
            <div class="col-5">
               <h2 class="steps">Step <?php echo $step_no;?></h2>
            </div>
         </div>
         <hr>
         <div class="row p-4">
           
            <div class="col-md-12">
                  <h2>INFORMED CONSENT:</h2>
                  <ol>
                    <li>I have read and understood the intormation in the donor form and education material.</li>
                    <li>I confirm, that to my knowledge. I have answered all the questions accurately and truth fully and do not consider myself to be a person involved in any of the described activities that could please me at the risk of spreading HIV or Hepatitis.</li>
                    <li>I understand that any willful misrepresentation of the facts could endanger the patients receiving my blood.</li>
                    <li>I am aware that my blood will be screened for HIV. Hepatitis B. Hepatitis C. Malaria & Syphilis in addition to any other screening tests required to ensure blood safety</li>
                    <li>I understand that screening test are not diagnostics and may yield false positive results.I also understand further confirmatory test would be required in case of positive results and that for any positive results <br>
                    <div class='row'>
                      <div class='col-sm-5'>
                        <div >
  <label >I may be contacted</label>
</div>
</div>
  <div class='col-sm-7'>
    <div>
  <input type="checkbox"  name="contacted" value="yes" >
</div>
</div>
</div>


            <div class='row'>
                      <div class='col-sm-5'>
                        <div >
  <label >I may not be contacted</label>
</div>
</div>
  <div class='col-sm-7'>
    <div>
  <input type="checkbox"  name="contacted" value="no" checked>
</div>
</div>
</div>
  
 
                     <!-- <label for="maybe"> I may be contacted</label>
                     <input type="checkbox" value="yes" id="maybe">
                     <label for="maynot"> I may not be contacted </label>
                     <input type="checkbox" value="no" id="maynot"> -->
                    </li>
                    <li>I understand that my blood will be utilized in accordance with regulatory guidelines including NBTC and drug and cosmetic act and regulations pertaining to it or its future replacements</li>
                    <li>I understand the blood donation procedure and possible risk (vaso-vagal reaction, hematoma etc.) involved as explained.</li>
                    <li>I confirm that I am over the age of 18 years</li>
                    <li>I understand that blood donation is totally voluntary act and no inducement or remuneration in cash or kind has been offered to me.</li>
                    <li>I prohibit any personal details (except demographic details) provided by me or about my donation to be disclosed to any individual or agency except asked by government.</li>
                    <li>I hereby declare that I am donating blood voluntarily without any pressure/force/cohesion/threat/false misconception from the Blood Bank.</li>
                    <li> I hereby volunteer to donate my Blood/Blood components which may be used for patient/scientific research/fractionation (surplus plasma).</li>
                    <li> My donated blood / components may be utilized beyond this Blood Bank</li>
                    <li> <b>You would liked to be informed about any abnormal test results (HIV, HBsAg, HCV, Syphilis, Malaria parasite) at the address furnished by you. </b></li>
                  </ol>
                  <ul>



<!-- 3feb -->


                                                   <!-- <ul class="list-head-5">

                                                   <li>
                                                  <span> I Have Been Give In The Opportunity To Ask Question And They Have Been Answered In The Language Understand. By Me</span>
                                                  <input type="checkbox" name="here2" value="yes" id="main2">
                                                  <input type="checkbox" name="here2" value="no" id="main3">

                                                </li>
                                                   <li>
                                                   I Have Given The Opportunity To Refuse The Blood Donation
                                                   </li>
                                                   <li>
                                                   I Would Like To Be Regular Voluntary Donor :
                                                   </li>


                                                   

                                                   </ul>  -->
                                                   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<ul class="list-head-5">
<!-- <div> -->
  <!-- <h3>Fruits</h3> -->
  <div class="here-jam">
  <li> I Have Been Give In The Opportunity To Ask Question And They Have Been Answered In The Language Understand. By Me</li>
  <div class="here-jam1">
  <div>
  <label>
    <input type="checkbox" class="radio check-ayu" value="yes" name="opportunity" checked />Yes</label></div>
  <div><label>
    <input type="checkbox" class="radio check-ayu" value="no" name="opportunity" />No</label></div>
    </div>
  <!-- <label>
    <input type="checkbox" class="radio" value="1" name="fooby[1][]" />Mango</label> -->
    
    </div>
<!-- </div> -->
<!-- <div> -->
  <!-- <h3>Animals</h3> -->
  <div class="here-jam">
  <li> I Have Given The Opportunity To Refuse The Blood Donation   </li>
  <div class="here-jam1">
   <div>
  <label>
    <input type="checkbox" class="radio check-ayu" value="yes" name="refuse" checked="" />Yes</label></div>
  <div><label>
    <input type="checkbox" class="radio check-ayu" value="no" name="refuse" />No</label></div>
    </div>
    </div>
  <!-- <label>
    <input type="checkbox" class="radio" value="1" name="fooby[2][]" />Cheetah</label> -->
 
<!-- </div> -->

<div class="here-jam">
<li>I Would Like To Be Regular Voluntary Donor : </li>
<div class="here-jam1">
   <div>
  <label onclick="jamming()">
    <input type="checkbox" class="radio check-ayu" value="yes" name="regular"  />Yes</label></div>
    
  <div><label>
    <input type="checkbox" class="radio check-ayu" value="no" name="regular" checked="" />No</label></div>



    </div>

  <!-- <label>
    <input type="checkbox" class="radio" value="1" name="fooby[2][]" />Cheetah</label> -->
   
    </div>
    <!--  -->
<div id="javas">
   <div class="here-jam3">
    <label>
    <input type="checkbox" class="radio check-ayu" value="Birthday" name="donor"  />Birthday</label>
  <label>
    <input type="checkbox" class="radio check-ayu" value="Marriage" name="donor" />Marriage Anniversary</label>
    <label>
    <input type="checkbox" class="radio check-ayu" value="After" name="donor" />After 6 month</label>
    <label>
    <input type="checkbox" class="radio check-ayu" value="Once" name="donor" />Once Year</label>
    <label>
    <input type="checkbox" class="radio check-ayu" value="Emergency" name="donor" />Emergency Requirement</label>
    </div>
    </div>
    
    <!--  -->

</ul>




<!-- 3feb -->


               <!-- <table style="width:100%" cellspacing="20">
                    <tbody>
                     <tr>
                      <th>MEDICAL & SYSTEMIC EXAMINATIONON :</th>
                      <th> 
                        <label class="rad-label">
                            <input type="radio" class="rad-input has_accepted_defer" name="has_accepted_defer" value="accept">
                            <div class="rad-design"></div>
                            <div class="rad-text">Accept</div>
                        </label>   
                      </th>
                      <th> 
                        <label class="rad-label">
                            <input type="radio" class="rad-input has_accepted_defer" name="has_accepted_defer" value="defer">
                            <div class="rad-design"></div>
                            <div class="rad-text">Defer</div>
                        </label>
                     </th>
                    </tr>
                  </tbody>
               </table> -->
            </div>
            <!-- <div class="col-md-12" style="padding-top: 20px;">
               <table style="width:100%">
                  <tbody>
                     <tr>
                      <td>Signature or Thumb Impression</td>
                      <td><input type="file" name="donar_signature"></td>
                     </tr>
                  </tbody>
               </table>
            </div> -->
         </div>
      </div>
       <input type="submit" name="next" class="next action-button" id="next_form" data-form_type="step_<?php echo $step;?>" value="Next" />
     <input type="button" name="next" class="next action-button" id="prev_form" data-form_type="step_3" value="Back" />
   </fieldset>
   <!--4th step tab end-->
</form>



<script>
function jamming()
{
  document.getElementById("javas").style.display="block";
}

// function myFunction() {
//   document.getElementById("demo").innerHTML = "Hello World";
// }

</script>

<script type="text/javascript">
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
               url:'<?php echo base_url('donation_request_submit');?>',
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
</script>

<script>
  window.scrollTo(0, 0);
</script>
