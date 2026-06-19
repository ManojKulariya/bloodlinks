  <style>
        /* h3,h4{
            height: 0px;
        } */
        .container {
            /* border: 2px solid black; */
            /* margin: 40px; */
            font-size: 12px;
       
        }
        h3{
font-size: 20px!important;
padding-top: 12px !important;
        }

        .div1 {
            display: inline-block;
            /* margin-left: 70px; */

            line-height: 1px;
            width: 1000px;
        }

        .div2 {
            display: inline-block;
            position: absolute;
            right: 50px;
            top: 50px;
        }

        .left {
            display: inline-block;
            width: 670px;
            padding: 2px;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid black;
            text-align: left;
            
    font-weight: 100;
            padding: 2px;
        }

        * {
            box-sizing: border-box;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 60%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        #class td,

        tr {
            border: none;
        }
        .center th
        {
            text-align:center;
        }
        .center tr 
        {
            height: 30px;
        }
        p{
            margin-bottom: 6px!important;
        }
        @media print {
         #printPageButton {
         display: none;
         }
        }
         @font-face {
            font-family: 'fontawesome3';
            src: url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/fonts/fontawesome-webfont.ttf?v=4.7.0') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        .fa3 {
            display: inline-block;
            font: normal normal normal 14px/1 fontawesome3;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
<?php 
$id= $this->uri->segment(3);
$userid = $this->uri->segment(4);
// $query = $this->db->get('bl_customers');
 
 $query1 = $this->db->query("SELECT * FROM bl_blood_request WHERE id = '$id' AND user_id = '$userid'");

 // echo 'hiii';

 foreach ($query1->result() as $request_form)
{
    
    $form_data1 = json_decode($request_form->components_unit);
    $form_data2 = json_decode($request_form->components_test);
    $bank_id = $request_form->org_id;
    // print_r($form_data2);
} 
 
   
 $query3 = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id = '$bank_id'");
 foreach ($query3->result() as $bloodbank)
{

// print_r($bloodbank);
// die();
   } 
?>

    <div class="container">
        <button id="printPageButton" onClick="window.print();" style="background-color: blue;color: white;border-radius: 5px;border-color: white;padding: 10px 20px;">Print</button>
<!-- <button onclick="window.print()" class="btn">Click Me</button> -->
<script type="text/javascript">
    window.print();
</script>

        <div class="div1" style="padding-top: 100px;">
            <h3 style="text-align: center;padding-bottom: 5px;padding-bottom: 0px!important;margin-bottom: 0px;padding-top: 0px!important;">Blood Bank</h3>
            <h3 style="text-align: center;padding-bottom: 5px;padding-bottom: 0px!important;margin-bottom: 0px;padding-top: 0px!important;">(Regional Blood Center)</h3>
            <p style="text-align: center;padding-bottom: 5px;">
                <?php echo ucwords($bloodbank->name);?>
            </p>
            <p style="text-align: center;padding-bottom: 5px;"><?php echo ucwords($bloodbank->address_1 . "-". $bloodbank->pincode);?></p>
            <p style="text-align: center;padding-bottom: 5px;">
                Phone- <?=$bloodbank->contact_ph_no ?>, <?=$bloodbank->fax_no ?>, Email- <?=$bloodbank->contact_email ?>    
            </p>
              <p style="text-align: center;padding-bottom: 5px;font-weight: bold;">
               Request for issues/Reservation of Blood/Blood components   
            </p>
        </div>
      <div class="div2" style="float: right;">
           <!--  <img src="https://cdn.vectorstock.com/i/1000x1000/11/41/hospital-cross-sign-wave-logo-vector-20061141.webp"
                alt="" height="80" width="100" /> -->
                 <img src="https://www.bloodlinks.in//uploads/img/"<?php echo($bloodbank->logo) ?> width="100" height="80"></br>
        </div>
        <h3 style="width: 600px;" >Patient information</h3>
        <div class="row">
            <div class="column" style="margin-top: 10px" >
                <table>
                    <tr>
                        <th>Patient Name: <?=$request_form->p_name ?></th>
                        <th>Age: <?=$request_form->age ?></th>
                        <th>Sex: <?=$request_form->gender ?></th>
                    </tr>
                    <tr>
                        <td>Registration no: <?=$request_form->registration ?></td>
                        <td>Ward: <?=$request_form->ward ?></td>
                        <td>Bed: <?=$request_form->bed ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">Fathers Name: <?=$request_form->f_name ?></td>
                    </tr>
                    <tr>
                        <td>Name of the hoshpital: <?=$request_form->hospital ?></td>
                        <td colspan="3">Phone: <?=$request_form->phone ?></td>
                    </tr>
                </table>
            </div>
            <div class="column" style="margin: 10px; width: 30%">
                <table>
                    <tr>
                        <td colspan="3">Name of consultant :<?=$request_form->consultant ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">Phone :<?=$request_form->consultant_phone ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- 2nd section -->
        <h3 style="width: 600px;">
            cllinical information (Fill By clinician/Resident ?Docter/Nurse)
        </h3>
        <div class="row">
            <div class="column" style="margin-top: 10px; width: 100%">
                <table>
                    <tr>
                        <th colspan="3">cllinical History :<?=$request_form->clinical_history ?></th>
                    </tr>
                    <tr>
                        <td>Diagnosis :<?=$request_form->diagnosis ?></td>
                        <td>Hb Gm% :<?=$request_form->hb ?></td>
                        <td>Platelets Count :<?=$request_form->platelet ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">Resons for transation :<?=$request_form->reasons ?></td>
                    </tr>
                    <tr>
                        <td>
                            History of Previous Transfusion : <?php if( $request_form->history_previous == "Yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i> Yes <i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i> No<?php }else{?><i class="fa fa-check-square" aria-hidden="true" ></i> No <i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i> Yes<?php } ?>&nbsp;&nbsp;
                          
                        </td>
                        <td colspan="3">
                            <span >Blood Group If known: <?=$request_form->blood_group ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            In Case of Female (history of obstetric) : <?=$request_form->female ?>

                        </td>

                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- 3rd section start -->
        <div class="row">
            <h3 style="width: 450px;">
                Blood component Requested
            </h3>
            <div class="column" style="margin-top: 10px; width: 100%">
                <table>
                    <tr>
                        <th style="border: 1px solid black;"></th>
                        <th style="border: 1px solid black;">
                            component Name</th>
                     
                        <th>No of Units Requested</th>
                        <th>NAT Tested Product</th>
                       <!--  <th>S.no</th>
                        <th>
                            component Name</th>
                        <th>--
                        </th>
                        <th>No of Units Requested</th>
                        <th>NAT Tested Product</th> -->
                    </tr>
              
                    <tr>
                        <td style="text-align: center;"> ■ </td>
                        <td>Whole Blood
                         </td>
                       <!--  <td>   <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;"></td> -->

                        <td> <?=$form_data1->whole_blood_unit; ?>.unit</td>

                        <td> <i class="fa"><?php if( $form_data2->whole_blood_test == "Yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> Yes</span> 
                    <i class="fa"><?php if($form_data2->whole_blood_test == "No"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> No</span>
                        </td>

                    </tr>
                        <tr>
                        <td style="text-align: center;"> ■ </td>
                        <td>Cryo Poor Plasma
                         </td>
                       <!--  <td>   <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;"></td> -->

                        <td> <?=$form_data1->Cryo_Poor_Plasma_unit; ?>.unit</td>

                        <td> <i class="fa"><?php if( $form_data2->Cryo_Poor_Plasma_test == "Yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> Yes</span> 
                    <i class="fa"><?php if($form_data2->Cryo_Poor_Plasma_test == "No"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> No</span>
                        </td>

                    </tr>
                        <tr>
                        <td style="text-align: center;"> ■ </td>
                        <td>Cryoprecipitate
                         </td>
                       <!--  <td>   <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;"></td> -->

                        <td> <?=$form_data1->Cryoprecipitate_unit; ?>.unit</td>

                        <td> <i class="fa"><?php if( $form_data2->Cryoprecipitate_test == "Yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> Yes</span> 
                    <i class="fa"><?php if($form_data2->Cryoprecipitate_test == "No"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> No</span>
                        </td>

                    </tr>
                        <tr>
                        <td style="text-align: center;"> ■ </td>
                        <td>Fresh Frozen Plasma
                         </td>
                       <!--  <td>   <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;"></td> -->

                        <td> <?=$form_data1->Fresh_Frozen_Plasma_unit; ?>.unit</td>

                        <td> <i class="fa"><?php if( $form_data2->Fresh_Frozen_Plasma_test == "Yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> Yes</span> 
                    <i class="fa"><?php if($form_data2->Fresh_Frozen_Plasma_test == "No"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> No</span>
                        </td>

                    </tr>
                        <tr>
                        <td style="text-align: center;"> ■ </td>
                        <td>Red blood cell
                         </td>
                       <!--  <td>   <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;"></td> -->

                        <td> <?=$form_data1->Red_blood_cell_unit; ?>.unit</td>

                        <td> <i class="fa"><?php if( $form_data2->Red_blood_cell_test == "Yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> Yes</span> 
                    <i class="fa"><?php if($form_data2->Red_blood_cell_test == "No"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> No</span>
                        </td>

                    </tr>
                        <tr>
                        <td style="text-align: center;"> ■ </td>
                        <td>Platelet rich concentrate
                         </td>
                       <!--  <td>   <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;"></td> -->

                        <td> <?=$form_data1->Platelet_rich_concentrate_unit; ?>.unit</td>

                        <td> <i class="fa"><?php if( $form_data2->Platelet_rich_concentrate_test == "Yes"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> Yes</span> 
                    <i class="fa"><?php if($form_data2->Platelet_rich_concentrate_test == "No"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?></i> No</span>
                        </td>

                    </tr>
                        
                   <!--  <tr>
                        <td>2</td>
                        <td>
                            Abc conc/packed</td>
                        <td>   <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;"></td>

                        <td>............unit</td>

                        <td>       <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;">
  <label for="vehicle1"> YES</label>
  <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
  <label for="vehicle2"> No</label>
                        </td>

                        


                    </tr>
                    <tr>
                        <td>3</td>
                        <td>
                            Abc conc/packed</td>
                        <td>   <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;"></td>

                        <td>............unit</td>

                        <td>       <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;">
  <label for="vehicle1"> YES</label>
  <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
  <label for="vehicle2"> No</label>
                        </td>
                       
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>
                            Abc conc/packed</td>
                        <td>   <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;"></td>

                        <td>............unit</td>

                        <td>       <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;">
  <label for="vehicle1"> YES</label>
  <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
  <label for="vehicle2"> No</label>
                        </td>

                       


                    </tr>

                    <tr>
                        <td>5</td>
                        <td>
                            Abc conc/packed</td>
                        <td>   <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;"></td>

                        <td>............unit</td>

                        <td>       <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;">
  <label for="vehicle1"> YES</label>
  <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
  <label for="vehicle2"> No</label>
                        </td>

                   


                    </tr>
                    <tr>
                        <td>6</td>
                        <td>
                            Abc conc/packed</td>
                        <td>   <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;"></td>

                        <td>............unit</td>

                        <td>       <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="margin-left: 10px;">
  <label for="vehicle1"> YES</label>
  <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
  <label for="vehicle2"> No</label>
                        </td>

                       



                    </tr> -->


                </table>
            </div>
        </div>
        <h3 style="width: 400px;">Product Requirement</h3>

        <div class="row">
            <div class="column" style="margin-top: 10px; width: 100%; ">
                <table>
                    <tr>
                        <th colspan="2">Required Date : <?=$request_form->required_date ?></th>
                        <th colspan="2">
                            Required Time : <?=$request_form->required_time ?></th>

                    </tr>
                    <tr>
                        <td style="width:290px;">




                            <label class="form-check-label" for="flexCheckDefault">
                                STAT    <?php if( $request_form->stat == "on"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;<br>(Within 15 mins)
                            </label>


                        </td>
                        <td style="width:290px;">

                            <label class="form-check-label" for="flexCheckDefault">
                                Urgent    <?php if( $request_form->urgent == "on"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;<br>(one hours)
                            </label>
                        </td>
                        <td style="width:290px;">
                            <label class="form-check-label" for="flexCheckDefault">
                                Routine   <?php if( $request_form->routine == "on"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;
                            </label>
                        </td>
                        <td>
                            <label class="form-check-label" for="flexCheckDefault">
                                Reserved   <?php if( $request_form->reserved == "on"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="border-bottom:none;">If Urgently Stat Required Please Specily Person
                            <span
                                style="font-weight: 400;">.................................................................................................................................................................................................
                            </span>
                        </td>

                    </tr>
                    <tr>
                        <td colspan="2" style="border-top: none; border-right: none;">(Non cross matched group specific)
                        </td>
                        <td style="border-right: none;
              border-top: none;
              border-left: none;">
                            Date...........................</td>
                        <td style="
              border-top: none;
              border-left: none;">Name and signature of medcial officer (with stamp)</td>

                    </tr>
                </table>
            </div>

        </div>
        <!-- 4th section  -->
        <h3 style="width: 600px;">To be Completed by Person Drawing Blood Specimen</h3>
        <div class="row">
            <div class="column" style="margin-top: 10px; width: 100%;margin-left:20px;">
                <table id="class">
                 
                    <tr>
                        <td colspan="2" style="border: none;">

                            <label class="form-check-label" for="flexCheckDefault">
                              <?php if( $request_form->patient == "on"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;  Patient (if concious) confirms to his and father's name
                            </label>

                        </td>
                        <td colspan="2">

                            <label class="form-check-label" for="flexCheckDefault">
                              <?php if( $request_form->sample == "on"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;  Sample tube cames the patient's name, reg No ward
                            </label>


                        </td>

                    </tr>
                    <tr>
                        <td colspan="2">

                            <label class="form-check-label" for="flexCheckDefault">
                              <?php if( $request_form->identity == "on"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp; If unconscious Relative(s)/Staff confirm the identity
                            </label>

                        </td>
                        <td colspan="2">

                            <label class="form-check-label" for="flexCheckDefault">
                             <?php if( $request_form->matchs == "on"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;  That Match with the medical records
                            </label>


                        </td>

                    </tr>
                    <tr>
                        <td colspan="2">

                            <label class="form-check-label" for="flexCheckDefault">
                             <?php if( $request_form->medical == "on"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;  The identity,Reg No. check with the medical records and <br> same is written on the requisition form 
                            </label>

                        </td>
                        <td colspan="2">

                            <label class="form-check-label" for="flexCheckDefault">
                              <?php if( $request_form->sample_tube == "on"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;  Phlebatomist has signed the sample tube
                            </label>

                        </td>

                    </tr>
                    <tr>
                        <td colspan="4">

                            <label class="form-check-label" for="flexCheckDefault">
                              <?php if( $request_form->completely == "on"){?><i class="fa fa-check-square" aria-hidden="true" ></i><?php }else{?><i class="fa fa-square" aria-hidden="true" style="font-weight: normal;"></i><?php } ?>&nbsp;&nbsp;  Patient (if concious) confirms to his and father's name
                            </label>

                        </td>

                    </tr>
                    <tr>
                        <td style="border-right: none;
                        border-top: none;
                        border-left: none;">
                            Date...........................</td>
                        <td colspan="2" style="border-top: none; border-right: none;">Employe No...................................................
                        </td>

                        <td style="
              border-top: none;
              border-left: none;">Name and signature of medcial officer (with stamp)</td>

                    </tr>
                </table>
                <hr>
            </div>

        </div>
        <h3 >Replacement 
            Details
        </h3>
        <!-- 5th section  -->
        <div class="row">
            <div class="column" style="margin-top: 10px; width: 100%;">
                <table >
                    <!-- <tr>
                        <th colspan="2">Required Date</th>
                        <th colspan="2">
                            Required Time</th>

                    </tr> -->
                    <tr>
                        <td style="height: 50px; width: 290px;">



                            Replacement Unit No


                        </td>
                        <td style="height: 50px; width: 290px;">
                            Voluntry id
                        </td>
                        <td style="height: 50px; width: 290px;">
                            Without Replacement (Recomended by)
                        </td>
                        <td>
                           
                        </td>
                    </tr>
                   
                   
                    <tr>
                        <td  style="border-top: none; border-right: none;font-weight: bolder;border: none;">For Blood Bank Use Only:-
                        </td>
                        <td colspan="2" style="border-right: none; text-align: center;
              border-top: none;
              border-left: none;border: none;">
                            Date...........................</td>
                        <td style="
              border-top: none;
              border-left: none;border: none;">Time...........................</td>

                    </tr>
                </table>
            </div>

        </div>
      <!-- 6th section  -->
      <div class="column" style="margin-top: 10px; width: 100%">
        <table class="center">
            <tbody><tr>
                <th>Anti-A</th>
                <th >
                    Anti-A1</th>
                <th>Anti-B
                </th>
                <th>Anti-AB</th>
                <th>Anti-O(RHO)</th>
                <th>Blood Group</th>
                <th>A-cells</th>
                <th>
                    B-cells</th>
                <th>C-cells
                </th>
                <th>Auto Control</th>
                <th>Final Blood Group</th>
                <th>Signature</th>
            </tr>

            <tr>
                
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
                




            </tr>



        </tbody></table>
    </div>
    <!-- 7th section  -->
    <!-- <div class="row">  
     -->
      <div class="column" style="margin-top: 10px; width: 100%">
        <table class="center">
            <tbody><tr>
                <th rowspan="2">
                    component</th>
                <th rowspan="2">
                    Date of Bleeding</th>
                <th rowspan="2">Unit No
                </th>
                <th rowspan="2">Bag Tube No</th>
                <th rowspan="2">Blood group Rh</th>
                <th colspan="2">Major Cross Match</th>
                <th colspan="1">Major Cross Match</th>
                <th rowspan="2">Cross Match By</th>
                <th rowspan="2">	Varified By</th>
            
            </tr>
            <tr>
                <th>Saline Rt</th>
                
                <th>Comb 37°C</th>
             <th>Saline Rt</th>
            </tr>

            <tr>
                
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>


                




            </tr>



        </tbody></table>
    </div>
   
    <!-- </div> -->
           <br><br><br><br><br><br><br><br><br><br>
        <div class="col1">
            <h3 style="text-align:center ;">Consent form for the Transfusion of Blood/ Blood Component</h3>
        </div>
        <div class="col2">
            <p>Patient
                Name......................................................................................CR
                Number......................................................................................................Ward/Bed
                No.......................................................,</p>
            <p>Blood transfusion is a life saving medical procedure. Blood can be given as "whole blood" or as
                components such as Red cells, Platelets, Plasma and Cryoprecipitate.</p>
        </div>
        <div class="col3">
            <ol>
                <li> UMy patient have been informed of the transfusion options available and expected benefits of
                    transfusion of blood and/or components.</li>
                <li> I/My patient agree to the administration of blood and/ or components in the interest of proper medical care </li>
                <li> I/My patient understand that blood/ blood components to be administered have been prepared and tested in accordance with rule established by National Regulation. However, there is still a very small chance that an adverse reaction can occur such as: fever with or without chills and rigor, itching and hives, which are treatable. Rarely an unpredictable life threatening event can also occur.</li>
                <li>I/My patient have been informed that despite mandatory screening for blood borne infections such as HIV, Hepatitis B, Hepatitis C, Syphilis and Malaria, the risk of acquiring these infection is not totally eliminated,</li>
                <li>I/My patient have had the opportunity to ask questions about transfusions, alternatives to transfusion, risk of not transfusing, the procedures to
                    be used and the relative risks and hazards involved.</li>
                    <li>I/My patient believe that I have been sufficiently informed to make a decision to give a consent for transfusion of blood blood components</li>
                    <li>I/My patient have been informed and explained the above in a language that my patient understand.</li>
            </ol>
        </div>
        <div class="col4" style="display: block">
            <h3>Authorization by Patient</h3>
            <div class="col5" style="display: inline-block;">
                <p>Signature/ Thumb impression..............................</p>
                <p>Name of the Patient..............................</p>
                <p>Date......................................</p>            </div>
            <div class="col6" style="float:right">
                <p>Signature/ Thumb impression..............................</p>
                <p>Name of Witness........................................</p>
                <p>Doctor.............................................</p>
                <p>Designation........................................</p>
            </div>
        </div>
        <div class="col7">
            <h3>Patient's Attendant/ Next of Kin</h3>
            <p>The patient is unable to give consent because............................................................................................................................................and I <br> <br>..................................................................................................................................................................................(name/relationship to patient), therefore consent for the patient. I acknowledge that I have been an opportunity to discuss this procedure, as stated above, with my physician, physician designee and hereby consent to this procedure.</p>
            <div class="col8" style="display: inline-block;">
                <p>Signature/ Thumb impression..............................</p>
                <p>Name of the Patient attendant/ Next of kin,..............................</p>
                <p>Date......................................</p>            </div>
            <div class="col9" style="float:right">
                <p>Signature/ Thumb impression..............................</p>
                <p>Name of Witness........................................</p>
                <p>Doctor.............................................</p>
                <p>Designation........................................</p>
            </div>
          
        </div>
        <div class="col10">
            <br>
            <br>
            <h3 style="text-align: center;">Declaration Form Attending Doctor</h3>
            <p>I shall personally supervise the transfusion and shall check the blood bag for haemolysis, identification of the patient etc. before transfusion. Blood Bank shall not be responsible for any untoward transfusion reaction, Management of transfusion and transfusion reactions shall be the
                responsibility of the undersigned.</p>
                <p>Instructions given on the reverse has been noted by me. </p>
                <div class="col11" style="display: inline-block;">
                    <p> The Consent for Transfusion has been taken in ward.</p>
                               </div>
                <div class="col12" style="float:right">
                    <p>Signature of doctor &amp; Hospital Seal</p>
                    
                </div>
        </div>
        <div class="col13">
            <h3 style="text-align:center ;">रक्त और रक्तअवयव ट्रासफ्यूजन के लिए सहमति फार्म
            </h3>
        </div>
        <div class="col14">
            <p>
                मरीज का नाम...............................................................................................सी.आर. नं.
                .......................................................वार्ड नं.................................बैड नं..................... रक्त ट्रासफ्यूजन एक जीवन
             </p>
            <p>रक्षक चिकित्ता प्रकिया है। रक्त पूर्ण रक्त के रूप में या रक्त के अवयव जैसे प्लेटलेट्स, रक्त कोशिकाओं, प्लाजमा या कायप्रेसिपिटेट के रूप में दिया जाता है।.</p>
        </div>
        <div class="col15">
            <ol>
                <li> मुझे मेरे मरीज को रक्त ट्रान्सफ्यूजन के उपलब्ध विकल्पो और रक्त / रक्त अवयवो से होने वाले अपेक्षित लाभ के बारे में विस्तार से सूचित कर दिया है। </li>
                <li> मैं / मेरे मरीज को उचित चिकित्सा के लिए रक्त / रक्त अवयव चढाने के लिए सहमत हूँ। </li>
                <li>मैं / मेरा मरीज समझते है कि रक्त / रक्त अवयव "राष्ट्रीय विनिमय" स्थापित नियम के अनुसार जांचा व तैयार किया गया है पर तब भी प्रतिकूल प्रतिक्रिया की संभावना हो सकती है। यह सम्भावना बहुत कम होती है।</li>
                <li> अधिकांश प्रतिकूल प्रतिक्रिया रक्त या रक्त के अवयव चढाते समय या उसके कुछ देर बाद होती है। प्रतिकिया के लक्षण निम्न है बुखार सर्दी लगने के साथ या सिर्फ
                    बुखार, खुजली होना, चक्कर आना, और कंपकपी होना जिनका उपचार संभव है। कभी-कभी जीवन घाती प्रतिक्रिया भी हो सकती है जो कि एक अप्रत्याशित घटना है।</li>
                <li> मुझे / मेरे मरीज को बता दिया है कि रक्त संक्रमण जैसे एच.आई.वी. हेपेटाइटिस बी, हेपेटाइटिस सी, सिफलिस और मलेरिया आदि के लिए अनिर्वाय सकीनिग जाय
                    के बावजूद इनके संक्रमण का जोखिम पूरी तरह से खत्म नही होता है।</li>
                    <li>मुझे / मेरे मरीज को रक्त ट्रासफ्यूजन के विकल्प, ट्रासफ्यूजन न करने से खतरा, प्रक्रिया का उपयोग, उससे होने वाले फायदे और नुकसान के बारे में सवाल पूछने का पूरा-पूरा मौका दिया गया है।</li>
                    <li> मुझे मेरे मरीज को पूर्ण विश्वास है कि हमे संपूर्ण जानकारी दे दी गई है और हम रक्त / रक्त अवयव चढाने का निर्णय लेने और अनुमति देने में सक्षम है। 8. मुझे मेरे मरीज को उपरोक्त भाषा में ऊपर लिखी सभी जानकारी दे दी गई है जिसको मैंने / मेरे मरीज ने समझ लिया है।
                    </li>
            </ol>
        </div>
        <div class="col16" style="display: block">
            <h3>मरीज द्वारा अनुमति</h3>
            <div class="col17" style="display: inline-block;">
                <p>हस्ताक्षर / अंगूठे का निशान..............................</p>
                <p>मरीज का नाम..............................</p>
                <p>दिनांक......................................</p>            </div>
            <div class="col18" style="float:right">
                <p>हस्ताक्षर</p>
                <p>गवाह का नाम..............................</p>
                <p>डाक्टर का नाम........................................</p>
                <p>हस्ताक्षर व पद.............................................</p>
               
            </div>
        </div>
        <div class="col19">
            <h3 style="text-align:center ;">मरीज के रिश्तेदार / परिचायक
            </h3>
        </div>
        <br>
            <div class="col20">
            <p>मरीज सहमति देने में असमर्थ है क्योंकि...............................................................एवं मैं...............................................................................................................................................(नाम व मरीज से संबंध) इसलिए मैं....</p>
       <p>मरीज के लिए सहमति दे रहा हूँ। मुझे मेरे डाक्टर / रेजिडेन्ट डाक्टर से उपरोक्त प्रक्रिया को समझने व जानकारी लेने का पूरा अवसर दिया गया है इसलिए मैं रक्त / रक्त
        (नाम व मरीज से सबंध) इसलिए मैं
        अवयव ट्रासफ्यूजन की सहमति दे रहा हूँ।</p>
        </div>
        <div class="col21" style="display: inline-block;">
            <p>हस्ताक्षर / अंगूठे का निशान..............................</p>
            <p>मरीज के परिचायक का नाम / रिश्तेदारी..............................</p>
            <p>दिनांक......................................</p>            </div>
        <div class="col22" style="float:right">
      
            <p>हस्ताक्षर / अंगूठे का निशान...............................</p>
            <p>साक्षी के हस्ताक्षर........................................</p>
            <p>डाक्टर का नाम.............................................</p>
            <p>पद...............................</p>
            <p>Contact Detail of Patient/Attendant...............................</p>
           
        </div>
        <br>
        <br><br>
        <br>
        <br>
        <div class="col23">
            <p style="text-align: center;">Contact Detail of Patient/Attendant...............................................................................................................</p>
          </div>
       
    </div>