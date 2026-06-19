<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

 <div class="image-contactus-banner">
    <div class="container">
        <div class="row">
           	<div class="col-md-12">
              <h1 class="lg-text text-dark">Request for Blood donation</h1>
           	</div>
        </div>
    </div>
</div>
<div class="bread-bar">
   	<div class="container">
        <div class="row">
           	<div class="col-md-8 col-sm-6 col-xs-8">
              	<ol class="breadcrumb">
                 	<!-- <li><a href="<?php echo base_url();?>">Home</a></li> -->
                 	<li class="active">Edit for Blood Donation Form</li>
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
                	<h2 id="heading">Edit for Blood Donation</h2>
                	<p>Fill all form field to go to next step</p>
                    
                        

                        <div id="step_forms">

                        </div>
              	</div>
           	</div>
        </div>
    </div>
</section>




<div class="modal fade" id="deferReasonModal" tabindex="-1" role="dialog" aria-labelledby="deferReasonModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deferReasonModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="alert alert-success">You are not eligible for blood donation</div>
                </div>
                <div class="form-group">
                    <table>
                        <th>
                            Reason
                        </th>
                        <tbody>
                            <tr>
                                <td>Vaccination and inoculation.</td>
                                <td>Diphtheria</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modifyModalLabel">Permanent Defer</h5>
      </div>
      <div class="modal-body" id="modify_modal_msg">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" id="modify_data">Modify</button>
        <button type="button" class="btn btn-danger" id="submit_data">Submit</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
   var form_load_url='<?php echo base_url('admin/donations/edit_blood_donation');?>';
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