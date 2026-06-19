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


<h1 class="text-center" id="what-hap"><?php echo $detail_data[0]['blood_bank_name'] ?></h1>
<hr class="happens-hr">


<div class="box-my-my">
<h5>Category  </h5>
<P><?php echo $detail_data[0]['category'] ?></P>

<!--<h5>Phone  </h5>-->
<!--<P><?php echo $detail_data[0]['mobile'] ?>, <?php echo $detail_data[0]['contact_no'] ?></P>-->

<h5>Email  </h5>
<P><?php echo $detail_data[0]['email'] ?> </P>


<h5>Address  </h5>
<P><?php echo $detail_data[0]['address'] ?> ,<?php echo $detail_data[0]['city'] ?> ,<?php echo $detail_data[0]['district'] ?> , <?php echo $detail_data[0]['state'] ?> , <?php echo $detail_data[0]['pincode'] ?></P>

<h5>Helpline  </h5>
<P><?php echo $detail_data[0]['helpline'] ?></P>

<h5>Fax  </h5>
<P><?php echo $detail_data[0]['fax'] ?></P>

<h5>Nodal Officer  </h5>
<P><?php echo $detail_data[0]['nodal_officer'] ?> , <?php echo $detail_data[0]['contact_nodal_officer'] ?>, <?php echo $detail_data[0]['mobile_nodal_officer'] ?>
<?php echo $detail_data[0]['email_nodal_officer'] ?> ,<?php echo $detail_data[0]['qualification_nodal_officer'] ?></P>


<h5>Blood component available  </h5>
<P><?php echo $detail_data[0]['blood_component_available'] ?></P>



</div>

</section>