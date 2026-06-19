<?php defined('BASEPATH') OR exit('No direct script access allowed');?>



<style>

.heading-whether{
  font-size: 22px;
    font-weight: normal;
    margin: 17px 0px;

}
</style>

 <section class="sign-in-page my-5">
    <div class="container">
      <h6 class="heading-whether">Please select whether you want to donate or request blood?</h6>

      <div class="row">

        <div class="col-md-6 mb-4">
          <div class="contact-wrapper">
            <a href="<?php echo base_url('donation-request');?>" style="text-align: center;color: red;">
              <div class="work-flow-image">
                <img src="<?php echo base_url('uploads/app/blood-donation-1.png');?>">
              </div>
              <h4>Blood <br>Donation</h4>
            </a>
          </div>
        </div>

        <div class="col-md-6">
          <div class="contact-wrapper">
            <a href="<?php echo base_url('blood-request');?>" style="text-align: center;color: red;">
              <div class="work-flow-image">
                <img src="<?php echo base_url('uploads/app/blood-need.png');?>">
              </div>
              <h4>Blood <br>Requests</h4>
            </a>
          </div>
        </div>

      </div>

    </div>
  </section>

 