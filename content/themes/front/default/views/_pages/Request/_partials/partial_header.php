<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Start Heder Area --> 
<header class="header-area ">
   <!-- Start Navbar Area -->
   <div class="nav-area">
   <div class="navbar-area">
      <!-- Menu For Mobile Device -->
      <div class="mobile-nav">
         <a href="<?php echo base_url();?>" class="logo">
         <img src="<?php echo $logo_image;?>" alt="<?php echo $system_title;?>" style="width:200px;height:50px;">
         </a>
      </div>
      <!-- Menu For Desktop Device -->
      <div class="top-nav-area">
      <div class="container">
         <div class="row">
            <div class="col-lg-3 col-sm-3 col-6">
               <div class="top-nav">
                  <a href=""><i class="fa fa-phone" aria-hidden="true"></i> | +91-6375798641</a>
               </div>
            </div>

            <div class="col-lg-3 col-sm-3 col-6">
               <div class="top-nav">
                  <a href=""><i class="fa fa-envelope" aria-hidden="true"></i> | thebloodlinks@gmail.com</a>
               </div>
            </div>

            <div class="col-lg-3 col-sm-3 col-6">
               <div class="top-nav">
                  <a href=""><i class="fa fa-map-marker" aria-hidden="true"></i> | A-303, Southend Jaipur</a>
               </div>
            </div>

            <div class="col-lg-3 col-sm-3 col-6">
               <div class="top-nav">        
                      <a href="#" class="fb"><i class="fa fa-facebook-square"></i></a>
                      <a href="#" class="twit"><i class="fa fa-twitter"></i></a>
                      <a href="#" class="linkin"><i class="fa fa-linkedin"></i></a>
                      <a href="#" class="linkin"><i class="fa fa-pinterest"></i></a>
               </div>
            </div>
         </div>
      </div>
   </div>
      <div class="main-nav">
         <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
               <a class="navbar-brand" href="<?php echo base_url();?>">
               <img src="<?php echo $logo_image;?>" alt="<?php echo $system_title;?>" style="width:200px;height:50px;">
               </a>
               <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto ">
                     <li class="nav-item active">
                        <a href="<?php echo base_url();?>" class="nav-link dropdown-toggle active">
                        Home
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?php echo base_url('about');?>" class="nav-link">About</a>
                     </li>
                     <li class="nav-item">
                        <a href="#" class="nav-link dropdown-toggle">
                        Services
                        <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                           <li class="nav-item">
                              <a href="<?php echo base_url('add_bloodbank');?>" class="nav-link">Add Blood Bank</a>
                              <a href="<?php echo base_url('add_hospital');?>" class="nav-link">Add Hospital</a>
                              <a href="<?php echo base_url('add_lab');?>" class="nav-link">Add Lab</a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item">
                        <a href="<?php echo base_url('contact');?>" class="nav-link">Contact : +91-6375798641</a>
                     </li>
                     <?php
                     if(session_userdata('isUserLoggedin')){
                        ?>
                        <li class="nav-item">
                           <a href="#" class="nav-link dropdown-toggle">
                           Account
                           <i class="fa fa-caret-down"></i>
                           </a>
                           <ul class="dropdown-menu">
                              <li class="nav-item">
                                 <a href="<?php echo base_url('myaccount');?>" >My Profile</a>
                                 <a href="<?php echo base_url('my-appointment');?>" >My Appointment</a>
                                 <a href="<?php echo base_url('my-request');?>" >My Request</a>
                                 <a href="<?php echo base_url('account_logout');?>" class="nav-link">Logout</a>
                              </li>
                           </ul>
                        </li>
                        <?php
                     }else{
                        ?>
                           <li class="nav-item">
                        <a href="<?php echo base_url('register');?>" class="nav-link">Register</a>
                     </li>   
 <li class="nav-item">
                        <a href="<?php echo base_url('signin');?>" class="nav-link">Signin</a>
                     </li>   

                        <?php
                     }
                     ?>
                  </ul>
               </div>
         </nav>
         </div>
      </div>
   </div>
   <!-- End Navbar Area -->
</header>