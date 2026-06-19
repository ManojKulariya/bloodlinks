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
            <div id="questionnaire-container">
               <div class="pre-questionnaire-container">

                  <div class="questionnaire-content">
                     <div class="quest-contarea-border question-area">
                        <div class="pre-question">
                           <ol id="questionContainer">
                              <li class="question" id="li_1">
                                 <fieldset>
                                    <legend>Are you 16 – 65 years old?</legend>
                                    <p class="light">Find out more about <a rel="" href="https://my.blood.co.uk/KnowledgeBase/Index/age" target="_blank">why your age is important</a>.</p>
                                    <div class="buttons age">
                                       <div class="button-container firstOption">
                                          <div class="govuk-radios__item">
                                             <input class="govuk-radios__input" id="li-1-radio-yes" name="li-1-radio" type="radio" value="yes">
                                             <label class="govuk-label govuk-radios__label" for="li-1-radio-yes" style="">Yes</label>
                                          </div>
                                       </div>
                                       <div class="button-container secondOption">
                                          <div class="govuk-radios__item">
                                             <input class="govuk-radios__input" id="li-1-radio-no" name="li-1-radio" type="radio" value="no">
                                             <label class="govuk-label govuk-radios__label" for="li-1-radio-no" style="">No</label>
                                          </div>
                                       </div>
                                    </div>
                                 </fieldset>
                              </li>
                              <input class="hdnQuestionEligibleValue1 focused activetxtBox" id="hdnQuestionEligibleValue" name="hdnQuestionEligibleValue" type="hidden" value="Yes">
                              <li class="question" id="li_2">
                                 <fieldset>
                                    <legend>Do you currently weigh less than 50kg (7 stone 12 pounds)?</legend>
                                    <p class="light">Find out more about <a rel="" href="https://my.blood.co.uk/KnowledgeBase/Index/Weight" target="_blank">why your weight is important</a>.</p>
                                    <div class="buttons weight">
                                       <div class="button-container firstOption">
                                          <div class="govuk-radios__item">
                                             <input class="govuk-radios__input" id="li-2-radio-yes" name="li-2-radio" type="radio" value="yes">
                                             <label class="govuk-label govuk-radios__label" for="li-2-radio-yes" style="">Yes</label>
                                          </div>
                                       </div>
                                       <div class="button-container secondOption">
                                          <div class="govuk-radios__item">
                                             <input class="govuk-radios__input" id="li-2-radio-no" name="li-2-radio" type="radio" value="no">
                                             <label class="govuk-label govuk-radios__label" for="li-2-radio-no" style="">No</label>
                                          </div>
                                       </div>
                                    </div>
                                 </fieldset>
                              </li>
                              <input class="hdnQuestionEligibleValue2 focused activetxtBox" id="hdnQuestionEligibleValue" name="hdnQuestionEligibleValue" type="hidden" value="No">
                              <li class="question" id="li_3">
                                 <fieldset>
                                    <legend>Have you had a blood or blood product <a rel="" href="https://my.blood.co.uk/KnowledgeBase/Index/Transfusion" target="_blank">transfusion</a> since 1st January 1980?</legend>
                                    <div class="buttons blood">
                                       <div class="button-container firstOption">
                                          <div class="govuk-radios__item">
                                             <input class="govuk-radios__input" id="li-3-radio-yes" name="li-3-radio" type="radio" value="yes">
                                             <label class="govuk-label govuk-radios__label" for="li-3-radio-yes" style="">Yes</label>
                                          </div>
                                       </div>
                                       <div class="button-container secondOption">
                                          <div class="govuk-radios__item">
                                             <input class="govuk-radios__input" id="li-3-radio-no" name="li-3-radio" type="radio" value="no">
                                             <label class="govuk-label govuk-radios__label" for="li-3-radio-no" style="">No</label>
                                          </div>
                                       </div>
                                    </div>
                                 </fieldset>
                              </li>
                              <input class="hdnQuestionEligibleValue3 focused activetxtBox" id="hdnQuestionEligibleValue" name="hdnQuestionEligibleValue" type="hidden" value="No">
                              <li class="question" id="li_4" style="display:none;">
                                 <fieldset>
                                    <legend>Have you received <a rel="" href="https://my.blood.co.uk/KnowledgeBase/Index/Infertility" target="_blank">donated eggs or embryos</a> since 1st January 1980?</legend>
                                    <div class="buttons eggs">
                                       <div class="button-container firstOption">
                                          <div class="govuk-radios__item">
                                             <input class="govuk-radios__input" id="li-4-radio-yes" name="li-4-radio" type="radio" value="yes">
                                             <label class="govuk-label govuk-radios__label" for="li-4-radio-yes" style="">Yes</label>
                                          </div>
                                       </div>
                                       <div class="button-container secondOption">
                                          <div class="govuk-radios__item">
                                             <input class="govuk-radios__input" id="li-4-radio-no" name="li-4-radio" type="radio" value="no" checked="">
                                             <label class="govuk-label govuk-radios__label" for="li-4-radio-no" style="">No</label>
                                          </div>
                                       </div>
                                    </div>
                                 </fieldset>
                              </li>
                              <input class="hdnQuestionEligibleValue5 focused activetxtBox" id="hdnQuestionEligibleValue" name="hdnQuestionEligibleValue" type="hidden" value="No">
                              <li class="question" id="li_5">
                                 <fieldset>
                                    <legend>Have you ever had a <a rel="" href="https://my.blood.co.uk/KnowledgeBase/Index/cancer" target="_blank">cancer</a> other than basal cell carcinoma or cervical carcinoma insitu (CIN)?</legend>
                                    <div class="buttons cancer">
                                       <div class="button-container firstOption">
                                          <div class="govuk-radios__item">
                                             <input class="govuk-radios__input" id="li-5-radio-yes" name="li-5-radio" type="radio" value="yes">
                                             <label class="govuk-label govuk-radios__label" for="li-5-radio-yes" style="">Yes</label>
                                          </div>
                                       </div>
                                       <div class="button-container secondOption">
                                          <div class="govuk-radios__item">
                                             <input class="govuk-radios__input" id="li-5-radio-no" name="li-5-radio" type="radio" value="no">
                                             <label class="govuk-label govuk-radios__label" for="li-5-radio-no" style="">No</label>
                                          </div>
                                       </div>
                                    </div>
                                 </fieldset>
                              </li>
                              <input class="hdnQuestionEligibleValue4 focused activetxtBox" id="hdnQuestionEligibleValue" name="hdnQuestionEligibleValue" type="hidden" value="No">
                           </ol>
                        </div>
                        <div class="quest-question-area">
                           <div class="quest-btn continueRegisterationBtnContainer">
                              <a class="button-yes continueRegisterationBtn disabledContinue" role="button" href="javascript:void(0)">Continue</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>




<style type="text/css">
   .questionnaire-content, .questionnaire-header {
    float: left;
    width: 100%;
    padding-left: 20px;
    padding-right: 20px;
    box-sizing: border-box;
   }
   #questionnaire-container {
    width: 1140px;
    margin: 0 auto;
    height: 500px;
    font-family: Arial,Helvetica,sans-serif;
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
   .pre-question li.question {
       margin-bottom: 45px;
       font-weight: 800;
       font-size: 100%;
   }
   .pre-question li.question fieldset {
       display: inline;
       vertical-align: top;
   }
   fieldset {
       margin: 0;
       padding: 0;
       border: 0;
   }
   .pre-question fieldset>legend {
       display: block;
   }
   fieldset>legend {
       display: none;
   }
   label, legend {
       display: block;
       font-size: .9em;
   }
   .pre-question li.question p.light {
       font-weight: 400;
   }
   .pre-question li.question p.light {
       font-weight: 100;
       margin-top: 10px;
   }
   .pre-question li.question p {
       margin-bottom: 0;
       margin-top: 40px;
       font-size: 100%;
       line-height: 120%;
   }
   p.light {
       font-size: 16px;
   }
   p {
       margin: 0 0 20px 0;
   }
   .pre-question .buttons {
       display: inline-block;
       margin-top: 30px;
   }
   .pre-question .button-container {
       display: inline-block;
       position: relative;
       padding-left: 35px;
       margin-bottom: 12px;
       cursor: pointer;
       width: 90px;
       font-size: 100%;
       line-height: 150%;
   }
   .govuk-radios__input {
       cursor: pointer;
       position: absolute;
       z-index: 1;
       top: -2px;
       left: -2px;
       width: 44px;
       height: 44px;
       margin: 0;
       opacity: 0;
   }
   .govuk-radios__label {
       display: inline-block;
       margin-bottom: 0;
       padding: 8px 15px 5px;
       cursor: pointer;
       -ms-touch-action: manipulation;
       touch-action: manipulation;
   }
   input[type="radio" i] {
       background-color: initial;
       cursor: default;
       appearance: auto;
       box-sizing: border-box;
       margin: 3px 3px 0px 5px;
       padding: initial;
       border: initial;
   }
   .continueRegisterationBtnContainer {
       text-align: center;
       line-height: 100%;
       padding: 0 50px;
       margin: 0;
       font-size: inherit;
   }

   .quest-btn {
       margin-top: 25px;
       text-align: center;
       line-height: 100%;
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

   .no:before,
   .yes:before {
       content: "";
       position: absolute;
       top: 0;
       left: 0;
       width: 25px;
       height: 25px;
       border-radius: 50%;
       background: #fff;
       border: 2px solid #848484;
   }
   .no:after,
   .yes:after {
       content: "";
       position: absolute;
       top: 6px;
       left: 6px;
       width: 17px;
       height: 17px;
       border-radius: 50%;
       background: #fff;
   }
   .firstOption .on:after {
       background-color: #000;
   }
   .secondOption .on:after {
       background-color: #000;
   }

   .govuk-radios__input {
       cursor: pointer;
       position: absolute;
       z-index: 1;
       top: -2px;
       left: -2px;
       width: 44px;
       height: 44px;
       margin: 0;
       opacity: 0;
   }
   .govuk-radios__label {
       display: inline-block;
       margin-bottom: 0;
       padding: 8px 15px 5px;
       cursor: pointer;
       -ms-touch-action: manipulation;
       touch-action: manipulation;
   }
   .govuk-radios__label::before {
       content: "";
       -webkit-box-sizing: border-box;
       box-sizing: border-box;
       position: absolute;
       top: 0;
       left: 0;
       width: 40px;
       height: 40px;
       border: 2px solid currentColor;
       border-radius: 50%;
       background: 0 0;
   }
   .govuk-radios__label::after {
       content: "";
       position: absolute;
       top: 10px;
       left: 10px;
       width: 0;
       height: 0;
       border: 10px solid currentColor;
       border-radius: 50%;
       opacity: 0;
       background: currentColor;
   }
   .govuk-radios__hint {
       display: block;
       padding-right: 15px;
       padding-left: 15px;
   }
   .govuk-radios__input:focus + .govuk-radios__label::before {
       border-width: 4px;
       -webkit-box-shadow: 0 0 0 4px #fd0;
       box-shadow: 0 0 0 4px #fd0;
   }
   .govuk-radios__input:checked + .govuk-radios__label::after {
       opacity: 1;
   }
   .govuk-radios__input:disabled,
   .govuk-radios__input:disabled + .govuk-radios__label {
       cursor: default;
   }
   .govuk-radios__input:disabled + .govuk-radios__label {
       opacity: 0.5;
   }

   .disabledContinue {
       background: #595959!important;
       opacity: .5;
   }
   /*.quest-contarea-border {
       border: 2px solid #d81e05;
       border-radius: 10px;
       width: 100%;
       float: left;
       box-sizing: border-box;
       background-color: #f5f5f5;
       padding-bottom: 140px;
       position: relative;
       margin-bottom: 40px;
   }*/
</style>