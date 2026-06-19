<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="image-contactus-banner">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1 class="lg-text text-dark">Before you register as a blood donor</h1>
         </div>
      </div>
   </div>
</div>
<div class="bread-bar">
   <div class="container">
      <div class="row">
         <div class="col-md-8 col-sm-6 col-xs-8">
            <ol class="breadcrumb">
               <li><a href="<?php echo base_url();?>;?>">Home</a></li>
               <li class="active">PreRegister</li>
            </ol>
         </div>
      </div>
   </div>
</div>
<div class="contactus-secktion py-5 ">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1>Before you register as a blood donor</h1>
             <hr/>
             
             <p>Most people can give blood but sometimes it is not possible to be a blood donor. </p>
             <p>Please answer all of the following five questions so that we can advise if blood donation is appropriate for you.Your responses are not recorded in any way. </p>
             <p>These questions only apply if you want to register as a new blood donor. If you are already a registered blood donor please create an online account</p>
             <hr/>
         </div>



         <div class="col-md-12">
            <div class="questionnaire-content">
               <div class="quest-contarea-border question-area">
                  <div class="pre-question">
                     <ol>
                        <?php
                        if(!empty($questions)){
                           foreach ($questions as $key => $value) {
                              ?>
                              <li class="question">
                                 <fieldset>
                                  <legend><?php echo $value->ques_value;?></legend>
                                   <!-- <p class="light">Find out more about <a rel="" href="https://my.blood.co.uk/KnowledgeBase/Index/age" target="_blank">why your age is important</a>.</p> -->
                                    <div class="pre-question">
                                       <div class="buttons">
                                          <ul>
                                             <li>
                                                <label class="rad-label">
                                                 <input type="radio" class="rad-input" name="prereg_<?php echo $key;?>" value="yes">
                                                 <div class="rad-design"></div>
                                                 <div class="rad-text">Yes</div>
                                                </label>   
                                             </li>
                                             <li>
                                                <label class="rad-label">
                                                 <input type="radio" class="rad-input" name="prereg_<?php echo $key;?>" value="no">
                                                 <div class="rad-design"></div>
                                                 <div class="rad-text">No</div>
                                                </label> 
                                             </li>
                                          </ul>
                                      </div>
                                    </div>
                                 </fieldset>
                              </li>
                              <?php
                           }
                        }

                        ?>
                        
                        
                     </ol>
                  </div>
                  <div class="quest-question-area">

                       <div class="quest-btn continueRegisterationBtnContainer">
                           <button type="button" class="button-yes continueRegisterationBtn disabledContinue" role="button" disabled>Continue</button>
                       </div>                 

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<div class="modal" id="continueToRegModal" tabindex="-1" role="dialog" aria-labelledby="continueToRegModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">     
      <div class="modal-body">
        <p><strong>Thanks for answering. You should be eligible to donate so please continue to register and book an appointment.</strong></p>
      </div>
      <div class="modal-footer">
        <a href="<?php echo base_url('register');?>" class="btn btn-danger">Continue to Register</a>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="notcontinueToRegModal" tabindex="-1" role="dialog" aria-labelledby="notcontinueToRegModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">      
      <div class="modal-body">
        <p><strong>Thank you. Based on the answers you provided, we advise that you do not register to be a blood donor.</strong></p>
      </div>
      <div class="modal-footer">
        <a href="<?php echo base_url();?>" class="btn btn-danger">Back to Homepage</a>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
   var ans='<?php echo $ans;?>';
   var total_ans=<?php echo (!empty($questions))?count($questions):0;?>;
</script>


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
       margin-top: 30px;
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
     padding: 14px 16px;
     margin: 10px 0;

     cursor: pointer;
     transition: .3s;
   }

   .rad-label:hover,
   .rad-label:focus-within {
     background: hsla(0, 0%, 80%, .14);
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
     font-size: 18px;
     font-weight: 900;

     transition: .3s;
   }

   .rad-input:checked~.rad-text {
     color: #000000
   }

</style>