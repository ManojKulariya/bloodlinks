<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
 <style>


@media  (max-width:768px){
    
    .happens-sec h1{
        font-size:1.8rem;
    }
    .happy-img{
        width: 350px;
    height: 214px;
    margin-top: 20px;
    }
}
 </style>

<section class="happens-sec">


<h1 class="text-center" id="what-hap"><?php echo $detail_data[0]['company_name'] ?></h1>
<hr class="happens-hr">


<div class="box-my-my">
<h2>Category  </h2>
<P><?php echo $detail_data[0]['category'] ?></P>

<h2>Phone  </h2>
<P><?php echo $detail_data[0]['phone'] ?></P>

<h2>Email  </h2>
<P><?php echo $detail_data[0]['email_1'] ?> <?php echo $detail_data[0]['email_2'] ?> <?php echo $detail_data[0]['email_3'] ?></P>


<h2>Address  </h2>
<P><?php echo $detail_data[0]['address'] ?></P>

<h2>City  </h2>
<P><?php echo $detail_data[0]['city'] ?></P>

<h2>State  </h2>
<P><?php echo $detail_data[0]['state'] ?></P>

<h2>Pincode  </h2>
<P><?php echo $detail_data[0]['pincode'] ?></P>


<h2>Review  </h2>
<P><?php echo $detail_data[0]['review'] ?></P>



</div>

</section>