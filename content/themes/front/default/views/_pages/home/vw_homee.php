<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
   <div class="carousel-inner">
      <div class="carousel-item active">
         <img src="<?php echo base_url('uploads/app/slider2.jpg');?>" class="d-block w-100" alt="..." style="filter: brightness(0.5);max-height: 600px;">
         <div class="slider-one">
            <h5>Donate Blood, Save Life !</h5>
            <h1>Donate Blood And <br>Inspires Others</h1>
            <a href="#" class="btn">Register Now</a>
         </div>
      </div>
      <div class="carousel-item">
         <img src="<?php echo base_url('uploads/app/slider3.jpg');?>" class="d-block w-100" alt="..." style="filter: brightness(0.5);max-height: 600px;">
         <div class="slider-one two">
            <h5>Donate To Blood Contribute</h5>
            <h1>Your Blood Can Bring Smile<br> In Any One Person Face</h1>
            <a href="#" class="btn">Explore Now</a>
            <a href="#" class="btn">Contact Now</a>
         </div>
      </div>
      <div class="carousel-item">
         <img src="<?php echo base_url('uploads/app/slider1.jpg');?>" class="d-block w-100" alt="..." style="filter: brightness(0.5);max-height: 600px;">
         <div class="slider-one two">
            <h5>We Give You The Best</h5>
            <h1>We Have Top Level Of Best <br>Doctors</h1>
            <a href="#" class="btn">Explore Now</a>
            <a href="#" class="btn">Contact Now</a>
         </div>
      </div>
   </div>
   <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
   <span class="sr-only">Previous</span>
   </a>
   <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
   <span class="carousel-control-next-icon" aria-hidden="true"></span>
   <span class="sr-only">Next</span>
   </a>
</div>
<!-- <section class="pt-30 pb-30">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 col-sm-6 p-0">
            <div class="banner-card">
               <a href="<?php echo (session_userdata('isUserLoggedin'))?base_url('blood-request'):base_url('register');?>">
                  <h3>Register Now</h3>
                  <p>Some quick example text to build on the card title and make up the bulk of the card's content.
                  <p>
               </a>
            </div>
         </div>
         <div class="col-lg-6 col-sm-6 p-0">
            <div class="banner-card" style="background: #ad1e1d;">
               <a href="<?php echo (session_userdata('isUserLoggedin'))?base_url('donation-request'):base_url('register');?>">
                  <h3>Donate Now</h3>
                  <p>Some quick example text to build on the card title and make up the bulk of the card's content.
                  <p>
               </a>
            </div>
         </div>
      </div>
   </div>
</section> -->

<!-- <section class="pt-30 pt-50 pb-50">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 d-flex">
            <div class="col-sm-6">
               <div class="scards">
                  <a href="#">
                     <div class="work-flow-image">
                        <img src="https://bloodlinks.in/uploads/app/blood-donation-1.png">
                     </div>
                     <h4>Blood <br>Donation</h4>
                  </a>
               </div>
               <div class="scards">
                  <a href="3">
                     <div class="work-flow-image">
                        <img src="<?php echo base_url('uploads/app/blood-need.png');?>">
                     </div>
                     <h4>Blood <br>Need</h4>
                  </a>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="one-box">
                  <div class="scards">
                     <a href="#">
                        <div class="work-flow-image">
                           <img src="<?php echo base_url('uploads/app/bulk-transfer.png');?>">
                        </div>
                        <h4>Bulk <br>Transfer</h4>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6  d-flex">
            <div class="col-sm-6">
               <div class="one-box">
                  <div class="scards">
                     <a href="#">
                        <div class="work-flow-image">
                           <img src="<?php echo base_url('uploads/app/transfer-blood.png');?>">
                        </div>
                        <h4>Exchange <br>Blood</h4>
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="scards">
                  <a href="#">
                     <div class="work-flow-image">
                        <img src="<?php echo base_url('uploads/app/feedback-.png');?>">
                     </div>
                     <h4>Application <br>Feedback</h4>
                  </a>
               </div>
               <div class="scards">
                  <a href="#">
                     <div class="work-flow-image">
                        <img src="<?php echo base_url('uploads/app/contact.png');?>">
                     </div>
                     <h4>Contact Us <br>Request</h4>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
</section> -->
<!--service -->
<!--  <section class="our-service  pt-30 pb-30">
   <div class="container">
   <div class="row">
      <div class="col-md-12 text-center pt-30 pb-30">
         <h2 class="section-heading text-white">Our Services</h2>
      </div>
      <div class="col-md-3">
         <ul class="tabs ">
            <li rel="tab2">Blood Centre <i class="fa fa-university"></i></li>
            <li rel="tab3">Hospital<i class="fa fa-hospital-o"></i></li>
            <li rel="tab4">Event Managements <i class="fa fa-calendar"></i></li>
            <li rel="tab5">Security & Privacy <i class="fa fa-user-secret"></i></li>
         </ul>
      </div>
      <div class="col-md-9">
         <div class="tab_container " > -->
<!-- #tab1 -->
<!-- <h3 class="tab_drawer_heading" rel="tab2">Blood center</h3>
   <div id="tab2" class="tab_content">
      <div class="row">
         <div class="col-md-3">
            <img src="<?php echo base_url('uploads/app/blood-bank.png');?>">
         </div>
         <div class="col-md-9">
            <div class="blood-details">
               <h2>Blood Center</h2>
               <p>BloodLinks provides end to end solution for Blood Center management, like blood stock management, effective utilization of stock, bulk transfer, reporting and analytics on usage etc. This helps to build effective functioning 
                  of Blood Centers and increase profitability.
               </p>
            </div>
         </div>
      </div>
   </div> -->
<!-- #tab2 -->
<!--  <h3 class="tab_drawer_heading" rel="tab3">Hospital</h3>
   <div id="tab3" class="tab_content">
      <div class="row">
         <div class="col-md-3">
            <img src="<?php echo base_url('uploads/app/hospital.png');?>">
         </div>
         <div class="col-md-9">
            <div class="blood-details">
               <h2>Hospital</h2>
               <p>BloodLinks provides end to end solution for Hospital management, like resource management, effective and automated workflow between Hospital and Blood Center, Blood availability information based upon different criteria like distance, rating, time etc., along with efficient reporting capabilities. 
                  This helps to build effective functioning of Hospital and increase profitability.
               </p>
            </div>
         </div>
      </div>
   </div> -->
<!-- #tab3 -->
<!--  <h3 class="tab_drawer_heading" rel="tab4">Event Managements</h3>
   <div id="tab4" class="tab_content">
      <div class="row">
         <div class="col-md-3">
            <img src="<?php echo base_url('uploads/app/event.png');?>">
         </div>
         <div class="col-md-9">
            <div class="blood-details">
               <h2>Event Managements</h2>
               <p>BloodLinks provides complete platform to facilitate Blood Donations camps in effective and automated manner. This includes end to end solution like organizing 
                  logistics, connecting with authentic Donors, Hospital and Blood Centers.
               </p>
            </div>
         </div>
      </div>
   </div> -->
<!-- #tab4 --> 
<!-- <h3 class="tab_drawer_heading" rel="tab5">Security & Privacy</h3>
   <div id="tab5" class="tab_content">
      <div class="row">
         <div class="col-md-3">
            <img src="<?php echo base_url('uploads/app/security.png');?>">
         </div>
         <div class="col-md-9">
            <div class="blood-details">
               <h2>Security & Privacy</h2>
               <p>Automated and computerized blood bank management systems are a major requirement, with the added benefit of database security. Bloodlink's security system and privacy policy follows the goverment security norms, 
                  which provide its protection and technical support by a special authorized technical cell.
               </p>
            </div>
         </div>
      </div>
   </div> -->
<!-- .tab_container -->
<!-- </div>
   </div>
   </div>
   </section> -->
<!-- End Heder Area -->
<!--service end-->
<!--why us-->
<!-- <section class="dc-haslayout pt-30 pb-30">
   <div class="dc-haslayout dc-bgcolor dc-main-section dc-workholder">
      <div class="container">
         <div class="row">
            <div class="col-md-12 text-center pt-30 pb-30">
               <h2 class="section-heading">Why Us</h2>
            </div>
         </div>
      </div>
   </div>
   <div class="dc-haslayout dc-main-section dc-workdetails-holder">
      <div class="container">
         <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
               <div class="dc-workdetails">
                  <div class="dc-workdetail">
                     <figure>
                        <img src="<?php echo base_url('uploads/app/img-03.png');?>" alt="img description">
                     </figure>
                  </div>
                  <div class="dc-title">
                     <h3><a href="#">Trust Certainty</a></h3>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
               <div class="dc-workdetails dc-workdetails-border">
                  <div class="dc-workdetail">
                     <figure>
                        <img src="<?php echo base_url('uploads/app/img-01.png');?>" alt="img description">
                     </figure>
                  </div>
                  <div class="dc-title">
                     <h3><a href="#">Privacy And Security</a></h3>
                  </div>
               </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
               <div class="dc-workdetails dc-workdetails-bordertwo">
                  <div class="dc-workdetail">
                     <figure>
                        <img src="<?php echo base_url('uploads/app/img-02.png');?>" alt="img description">
                     </figure>
                  </div>
                  <div class="dc-title">
                     <h3><a href="#">Comprehensive Solutions</a></h3>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section> -->
<!--why us end-->
<section class="pt-50 pb-50">
   <div class="container">
      <div class="row">
         <div class="col-md-3 p-0">
            <div class="list-btn">
               <a href="<?php echo base_url('find_hospital');?>" class="bht"><img src="<?php echo base_url('uploads/app/icon1.png');?>" alt="img description">Find Hospital</a>
            </div>
         </div>
         <div class="col-md-3 p-0">
            <div class="list-btn" style="background: #000;">
               <a href="<?php echo base_url('find_bloodbank');?>" class="bht"><img src="<?php echo base_url('uploads/app/icon2.png');?>" alt="img description">Find Blood Bank</a>
            </div>
         </div>
         <div class="col-md-3 p-0">
            <div class="list-btn">
               <a href="<?php echo base_url('find_lab');?>" class="bht"><img src="<?php echo base_url('uploads/app/icon3.png');?>" alt="img description">Find Lab</a>
            </div>
         </div>
         <div class="col-md-3 p-0">
            <div class="list-btn" style="background: #000;">
               <a href="<?php echo base_url('find_camp');?>" class="bht"><img src="<?php echo base_url('uploads/app/icon2.png');?>" alt="img description">Find Blood Camp</a>
            </div>
         </div>
      </div>
   </div>
</section>

<section>
   <div class="container-fluid container-3">
      
      <img src="<?php echo base_url('uploads/app/mobile-app copy.jpg');?>" class="d-block w-100" id="img-id" alt="..." style="max-height: 600px;">
      <div class="text-block">
      <h2>Donate Blood And Save Lives with</h2>
      <h1>Bloodlinks App!</h1>
      <p class=para-1>People often encounter difficulty finding the right blood from the right blood. The purpose of BloodLinks was to provide  details about the accessibility of blood banks, hospitals as and when needed.</p>

<div class="imgg" >
  <a href=""><img src="<?php echo base_url('uploads/app/googly.png');?>"></a>
</div>
      </div>
      
   </div>
</section>



<!-- ayushii -->


<div class="container-1">
   <div class="row-1">
<h1>Join the Cause</h1>
<p>Join our cause and help us save more lives. Everyone should have the right to get a blood transfusion.
 </p></div>
<div class="row-2">
<a href="#" id="first-link">REQUEST BLOOD </a>
<a href="#" id="second-link">DONATE BLOOD </a>

</div>

</div>

<!-------------------our aim---------------------->

<!-- <section class="main_heading my-5">
   <div class="text-center sec">
      <h2 class="display-4">Our <span class="span-1">Aim</span></h2>
   </div>

<div class="container-4">
<div class="gallery">
  
    <img src="<?php echo base_url('uploads/app/New Project.png');?>" alt="Cinque Terre" width="600" height="400">
  <div class="desc">Digitalizing of current <br> Blood Donation Process
</div>
</div>

<div class="gallery">
  
    <img src="<?php echo base_url('uploads/app/New Project (1).png');?>" alt="Forest" width="600" height="400">
  <div class="desc">Promote ease of donating <br> blood
</div>
</div>

<div class="gallery">
  
    <img src="<?php echo base_url('uploads/app/New Project (3).png');?>" alt="Northern Lights" width="600" height="400">
  <div class="desc">Spread Blood Donation <br> Awareness
</div>
</div>

<div class="gallery">
    <img src="<?php echo base_url('uploads/app/New Project (2).png');?>" alt="Mountains" width="600" height="400">
  <div class="desc">Build a sustainable Blood <br> ecosystem</div>
</div>

</div>







</section> -->



















<!-- <section>
   <div class="container">
    
         <h2 style="text-color:black;">Join the Cause</h2>
         <p>Join our cause and help us save more lives. Everyone should have the right to get a blood transfusion</p>
       
         <div class="row">
            <div class="col-ms-6">
            <div class="new" style="background:black;">
               <a href="<?php echo (session_userdata('isUserLoggedin'))?base_url('donation-request'):base_url('register');?>">
                  <h3>REQUEST BLOOD </h3>
               </a>
            </div>
            </div>
            <div class="col-md-6">
            <div class="new" style="background: #ad1e1d;">
               <a href="<?php echo (session_userdata('isUserLoggedin'))?base_url('donation-request'):base_url('register');?>">
                  <h3>DONATE BLOOD </h3>
               </a>
            </div>
         </div>
      </div>
   </div>
</section> -->


<section class="pt-0 pb-50 filter main_heading my-5">


   <div class="text-center sec">
      <h2 class="display-4">Our <span class="span-1">Aim</span></h2>
   </div>
   <div class="container ">
      <div class="row">
         <div class="col-lg-3 col-sm-10 mb-3">
            <div class="new-card">
               <div class="card">
                  <img src="<?php echo base_url('uploads/app/New Project.png');?>" alt="img description" style="
                     height: 233px;">
               </div>
               <div class="card-body text-center card-here">
                 
                  <p class="card-text">Digitalizing of current Blood Donation Process
</p>
               </div>
               <div> <a href="#" class="btn new-card-btn">Read More</a></div>
            </div>
         </div>

         <div class="col-lg-3 col-sm-10 mb-3">
            <div class="new-card">
               <div class="card">
                  <img src="<?php echo base_url('uploads/app/New Project (1).png');?>" alt="img description" style="
                     height: 233px;">
               </div>
               <div class="card-body text-center card-here">
                  
                  <p class="card-text">Promote ease of donating blood</p>
               </div>
               <div> <a href="#" class="btn new-card-btn">Read More</a></div>
            </div>
         </div>

         <div class="col-lg-3 col-sm-10 mb-3">
            <div class="new-card">
               <div class="card">
                  <img src="<?php echo base_url('uploads/app/New Project (3).png');?>" alt="img description">
               </div>
               <div class="card-body text-center card-here">
                  
                  <p class="card-text">Spread Blood Donation Awareness
</p>
               </div>
               <div> <a href="#" class="btn new-card-btn" style="background: black;">Read More</a></div>
            </div>
         </div>
         <div class="col-lg-3 col-sm-10 mb-3">
            <div class="new-card">
               <div class="card">
                  <img src="<?php echo base_url('uploads/app/New Project (2).png');?>" alt="img description" style="
                     height: 233px;">
               </div>
               <div class="card-body text-center card-here">
                  
                  <p class="card-text">Build a sustainable Blood ecosystem.</p>
               </div>
               <div> <a href="#" class="btn new-card-btn">Read More</a></div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="pt-50 pb-50">
<div class="container">
<div class="row">
   <div class="col-lg-6 col-sm-6 mb-5">
      <div class="help">
         <div class="help-left-img">
            <img src="<?php echo base_url('uploads/app/img4.jpg');?>" alt="image">
         </div>
         <div class="help-right-img">
            <img src="<?php echo base_url('uploads/app/img5.jpg');?>" alt="image">
         </div>
      </div>
   </div>
   <div class="col-lg-6 col-sm-6 mb-5">
      <div class="help-text">
         <h6> Benefits of Blood Donation</h6>
         <h4> Save Lives, Be a Real Hero
</h4>
         <p>Donating blood is a noble act that not everyone can do. With advancements in medicine, the need for blood has increased threefold since the industrial revolution. Every year, India has a deficit of between 30% and 35%. It is absurd to say that the country cannot meet this requirement with 1.2 billion people. The real challenge is not the lack of blood donors, but finding someone willing to donate when needed. Therefore, the aim should be to create a system of people who can help each other in emergencies.
</p>
         <div class="row">
            <div class="col-sm-6">
               <ul>
                  <li><i class="fa fa-angle-double-right" aria-hidden="true"></i>Reduces Risk of Cancer</li>
                  <li><i class="fa fa-angle-double-right" aria-hidden="true"></i>Helps in Weight Loss</li>
                  <li><i class="fa fa-angle-double-right" aria-hidden="true"></i>Replenishes Blood</li>
                  <li><i class="fa fa-angle-double-right" aria-hidden="true"></i>Lower Cholestrol Level</li>
               </ul>
            </div>
            <div class="col-sm-6">
               <ul>
                 
                  <li><i class="fa fa-angle-double-right" aria-hidden="true"></i>Boosts the Production of RBC(Red Blood Cells)</li>
                  <li><i class="fa fa-angle-double-right" aria-hidden="true"></i>Makes the Donor Psychologically Rejuvenated</li>


               </ul>
            </div>
         </div>
         <a href="#" class="btn">Explore New</a>
      </div>
   </div>
</div>
</section>
<section class="section-appointment pt-30 pb-30">
   <div class="container">
      <div class="row">
         <div class="col-md-12 text-center pt-30 pb-30">
            <div class="appointment-area">
               <h6>Start Donating</h6>
               <h1>CALL NOW: 333 555 9090</h1>
               <div class="appo-text">
                  <a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>New York - 1075 Firs Avenue</a>
                  <a href="" class="ml-5"><i class="fa fa-envelope" aria-hidden="true"></i>donate@gmail.com</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>








<!-- services -->
<section class="service-area">
   <div class="container">
      <div class="row">
         <div class="col-md-12 text-center pt-30 pb-30">
            <h6>What We do</h6>
            <h2 class="section-heading">Our Best Services </h2>
            <p class="mt-5">
               It is always a pleasure to work with BloodLinks for blood donation camp.Would like to hold more such camp.Team is quite professional and handles the events themselves.Nice Work.
            </p>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-6 col-sm-6">
            <div class="iconcoin-mask-bg-wrap iconcoin-mask-bg-wrap-1 mb-4 mb-lg-0">
               <div class="thumb">
                  <img src="<?php echo base_url('uploads/app/img6.jpg');?>" alt="image">
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-sm-6 align-self-center">
            <div class="services-content">
               <h1>01</h1>
               <h4>Blood Centre</h4>
               <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
               <a href="#" class="btn">Read More</a>
            </div>
         </div>
         <div class="col-lg-6 col-sm-6 align-self-center">
            <div class="services-content text-right">
               <h1>02</h1>
               <h4>Hospital</h4>
               <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
               <a href="#" class="btn">Read More</a>
            </div>
         </div>
         <div class="col-lg-6 col-sm-6">
            <div class="iconcoin-mask-bg-wrap iconcoin-mask-bg-wrap-1 mb-4 mb-lg-0">
               <div class="thumb">
                  <img src="<?php echo base_url('uploads/app/img7.webp');?>" alt="image">
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-sm-6">
            <div class="iconcoin-mask-bg-wrap iconcoin-mask-bg-wrap-1 mb-4 mb-lg-0">
               <div class="thumb">
                  <img src="<?php echo base_url('uploads/app/img8.jpg');?>" alt="image">
               </div>
            </div>
         </div>
         <div class="col-lg-6 col-sm-6 align-self-center">
            <div class="services-content">
               <h1>03</h1>
               <h4>Event Managemrnts</h4>
               <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
               <a href="#" class="btn">Read More</a>
            </div>
         </div>
         <div class="col-lg-6 col-sm-6 align-self-center">
            <div class="services-content text-right">
               <h1>04</h1>
               <h4>Security & Privacy</h4>
               <p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
               <a href="#" class="btn">Read More</a>
            </div>
         </div>
         <div class="col-lg-6 col-sm-6">
            <div class="iconcoin-mask-bg-wrap iconcoin-mask-bg-wrap-1 mb-4 mb-lg-0">
               <div class="thumb">
                  <img src="<?php echo base_url('uploads/app/img7.webp');?>" alt="image">
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--clint-->
<section class="clint-testimonial pt-50 pb-50">
   <div class="container">
      <!--  <div class="shape1" data-speed="0.06" data-revert="true">
         <img src="<?php echo base_url('uploads/app/shape1.png');?>" alt="image">
         </div> -->
      <div class="row">
         <div class="col-md-12 text-center pt-30 pb-30">
            <h2 class="section-heading">Client testimonials </h2>
         </div>
         <div class="col-md-12">
            <div id="testimonial-slider" class="owl-carousel">
               <div class="testimonial">
                  <div class="pic">
                     <img src="<?php echo base_url('uploads/app/img-2.jpg');?>">
                  </div>
                  <p class="description">
                     It is always a pleasure to work with BloodLinks for blood donation camp.Would like to hold more such camp.Team is quite professional and handles the events themselves.Nice Work.
                  </p>
                  <h3 class="title">Imran Rahat Saikh (Udaipur)</h3>
                  <small class="post">- blood</small>
               </div>
               <div class="testimonial">
                  <div class="pic">
                     <img src="<?php echo base_url('uploads/app/img-2.jpg');?>">
                  </div>
                  <p class="description">
                     It is always a pleasure to work with BloodLinks for blood donation camp.Would like to hold more such camp.Team is quite professional and handles the events themselves.Nice Work.
                  </p>
                  <h3 class="title">Ratan Jain</h3>
                  <small class="post">- Blood</small>
               </div>
               <div class="testimonial">
                  <div class="pic">
                     <img src="<?php echo base_url('uploads/app/img-2.jpg');?>">
                  </div>
                  <p class="description">
                     It is always a pleasure to work with BloodLinks for blood donation camp.Would like to hold more such camp.Team is quite professional and handles the events themselves.Nice Work.
                  </p>
                  <h3 class="title">Ratan Jain</h3>
                  <small class="post">- Bloodr</small>
               </div>
               <div class="testimonial">
                  <div class="pic">
                     <img src="<?php echo base_url('uploads/app/img-2.jpg');?>">
                  </div>
                  <p class="description">
                     It is always a pleasure to work with BloodLinks for blood donation camp.Would like to hold more such camp.Team is quite professional and handles the events themselves.Nice Work.
                  </p>
                  <h3 class="title">Ratan Jain</h3>
                  <small class="post">- Blood</small>
               </div>
               <div class="testimonial">
                  <div class="pic">
                     <img src="<?php echo base_url('uploads/app/img-2.jpg');?>">
                  </div>
                  <p class="description">
                     It is always a pleasure to work with BloodLinks for blood donation camp.Would like to hold more such camp.Team is quite professional and handles the events themselves.Nice Work.
                  </p>
                  <h3 class="title">Ratan Jain</h3>
                  <small class="post">- Blood</small>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--clint-end-->
<!--contact-->
<section class="feature-section">
   <div class="container">
      <div class="row text-center">
         <div class="col-md-12 text-center pt-30 pb-30">
            <h2 class="section-heading text-white">Let's Talk</h2>
         </div>
         <div class="col-12 col-sm-6 col-md-4 col-lg-4">
            <div class="single-item">
               <div class="box-shado">
                  <div class="icon">
                  </div>
                  <div class="icon-box">
                     <i class="fa fa-phone"></i>
                  </div>
               </div>
               <div class="single-content">
                  <h4><a href="tel:+91 637 579 8641">+91 637 579 8641</a></h4>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-4 col-lg-4">
            <div class="single-item">
               <div class="box-shado">
                  <div class="icon">
                  </div>
                  <div class="icon-box">
                     <i class="fa fa-envelope-open"></i>
                  </div>
               </div>
               <div class="single-content">
                  <h4><a href="mailto:thebloodlinks@gmail.com">thebloodlinks@gmail.com</a></h4>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-4 col-lg-4">
            <div class="single-item">
               <div class="box-shado">
                  <div class="icon">
                  </div>
                  <div class="icon-box">
                     <i class="fa fa-map-marker"></i>
                  </div>
               </div>
               <div class="single-content text-white">
                  <h4>Jagatpura, Jaipur</h4>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!--contact-end-->
<!-- <section class="pt-50 pb-50">
   <div class="container">
   <div class="row">
      <div class="col-md-12 text-center pt-30 pb-30">
         <h6>Team Members</h6>
         <h2 class="section-heading">Meet Volunteers </h2>
      </div>
   </div>
   <div class="row">
      <div class="col-lg-4 col-sm-4">
         <div class="team-card">
            <img src="<?php echo base_url('uploads/app/img30.jpg');?>" alt="image">
            <h2>Sumit Rai</h2>
            <p>Co-Founder</p>
         </div>
      </div>
      <div class="col-lg-4 col-sm-4">
         <div class="team-card">
            <img src="<?php echo base_url('uploads/app/img10.jpg');?>" alt="image">
            <h2>Khushi Tiwali</h2>
            <p>Senior</p>
         </div>
      </div>
      <div class="col-lg-4 col-sm-4">
         <div class="team-card">
            <img src="<?php echo base_url('uploads/app/img9.jpg');?>" alt="image">
            <h2>Supriya Sharma</h2>
            <p>Jonior</p>
         </div>
      </div>
   </div>
</section> -->