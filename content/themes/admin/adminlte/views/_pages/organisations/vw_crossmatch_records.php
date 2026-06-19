<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style>
    .container {
        padding: 34px;
    }
    .container1 {
        padding: 17spx;
    }
    .container h1,
    h2,
    h3 {
        text-align: center;
        font-size: 21px;
    }
    table,
    td,
    th {
        font-family: 'Mulish', sans-serif;
        font-size: 12px;
        border: 1px solid black;
        height: 40px;
        padding: 9px;
        width: 57px;
        text-align: center;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
            @media print {
  #printPageButton {
    display: none;
  }
  .content-wrapper {
    background: #fff;
        text-transform: capitalize;
}
            }
            .capitalize{
  text-transform: capitalize;
}
.content-wrapper
{
    background:white !important;
}
</style>
<button id="printPageButton" onClick="window.print();" style="background-color: blue;color: white;border-radius: 5px;border-color: white;padding: 5px 10px;">Print</button>
<br>
    <div class="container">
        <h1><b>Super Admin</b> </h1>
        <h1 style="font-size:1rem;">A UNIT OF VITA HEE CARE TRUST</h1>
        <!-- <h2><?php echo($bloodbank->address_1) ?></h2> -->
        <h3>Cross Match Register</h3>
        <div class="container1">
            <table>
                <tr>
                    <th><b>S No.</b></th>
                    <th style="width: 73px;"><b> Cross Match
                        No.</b></th>
                    <th style="width: 61px;"><b> Date</b></th>
                    <th style="width: 60px;"><b> Request
                        No.</b></th>
                    <th style="width: 150px;"><b> Patient Name</b></th>
                    <th style="width: 150px;"><b>Hospital Name</b> </th>
                    <th style="width:47px;"><b>Reg No.</b></th>
                    <th style="width: 63px;"><b>Group Patient</b>
                        Patient</th>
                    <th style="width: 46px;"><b>Unit No </b> </th>
                    <th style="width:52px;"><b>Tube No</b></th>
                    <th style="width: 47px;"><b>Blood
                        Group</b></th>
                    <th><b>Component</b></th>
                    <th><b>Cross Match
                        major</b></th>
                    <th><b>Minor CM
                        Component</b></th>
                    <th><b>cross match by</b></th>
                    <!-- <th>Remark</th> -->
                </tr>
                       <?php
                $no = "0";
$query = $this->db->query("SELECT * FROM bl_crossmatch WHERE bl_crossmatch.status = 'crossmatch' ORDER BY ID DESC"); 
        foreach ($query->result() as $row) {
    $bank_id = $row->bloodbank_id;
$query1 = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id = '$bank_id' ORDER BY blood_bank_id DESC");
 foreach ($query1->result() as $bloodbank)
{

   } 
                $no++;
             
         ?>    


                <tr>
                    <td class="capitalize"><?=$no ?></td>
                    <td class="capitalize"><?=$row->cross_match ?></td>
                    <td class="capitalize"><?=$row->crossmatch_date ?></td>
                    <td class="capitalize"><?=$row->request ?></td>
                    <td class="capitalize"><?=$row->p_name ?></td>
                    <td class="capitalize"><?=$row->hospital ?></td>
                    <td class="capitalize"><?=$row->registration ?></td>
                    <td class="capitalize"></td>
                    <td class="capitalize"><?=$row->unit_no ?></td>
                    <td class="capitalize"><?=$row->tube_no ?></td>
                    <td class="capitalize"><?=$row->blood_group ?></td>
                    <td class="capitalize"><?=$row->component ?></td>
                    <td class="capitalize"><?=$row->major_comb ?></td>
                    <td class="capitalize"><?=$row->minnor_cross ?></td>
                    <td class="capitalize"><?=$row->crossmatch_by ?></td>
                    <!-- <td class="capitalize"></td> -->
                </tr>
            <?php } ?>
            </table>
        </div>
    </div>