<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$bank_id = $_SESSION['bank_id'];
function get_com($comp){
            if ($comp == 18) {
            $component = "wholeblood";
            } elseif ($comp == 19) {
            $component = "CRYO";
            } elseif ($comp == 20) {
            $component = "FFP";
            } elseif ($comp == 21) {
            $component = "RDP";
            } elseif ($comp == 22) {
            $component = "PRBC";
            }  elseif ($comp == 886) {
            $component = "SDP";
            }  elseif ($comp == 885) {
            $component = "CPP";
            } else {
            $component = $comp;
            } 
            
            return $component;
    }
$query1 = $this->db->query("SELECT * FROM bl_blood_banks WHERE blood_bank_id = '$bank_id'");
foreach ($query1->result() as $bloodbank) {
    $city_id = $bloodbank->city_id;
    // print_r($city_id);
    // die();
}
$query2 = $this->db->query("SELECT * FROM bl_cities WHERE id = '$city_id'");
foreach ($query2->result() as $city) {
}

?>
<style>
    .container1 {
        padding: 17px;
    }

    .container h1,
    h2,
    h3 {
        text-align: center;
        font-size: 21px;
    }

    /* table,
    td,
    th {
        font-family: 'Mulish', sans-serif;
        font-size: 12px;

        border: 1px solid black;
        height: 40px;
        padding: 9px;
        width: 57px;
        text-align: center;
    } */

    .row-1 {
        font-weight: 900 !important;
    }

    /* table {
        border-collapse: collapse;
        width: 100%;
    } */

    @media print {
        #printPageButton {
            display: none;
        }

        .content-wrapper {
            background: #fff;
            text-transform: capitalize;
        }
    }

    .capitalize {
        text-transform: capitalize;
    }

    .content-wrapper {
        background: white;
    }

    .content-header h1 {
        font-size: 1.2rem;
        margin: 0;
        font-weight: 700;
    }
</style>

<button id="printPageButton" onClick="window.print();" style="background-color:  #ad1e1d;color: white;border-radius: 5px;border-color: white;padding: 5px 10px;">Print</button>
<br>
<div class="container" style="margin-left:unset !important;">
    <h1 style="font-weight:bold;"><?php echo ($bloodbank->name) ?></h1>
    <h1 style="font-size:0.9rem;">A UNIT OF VITA HEE CARE TRUST</h1>
    <h2 style="font-size:0.9rem;"><?php echo ($bloodbank->address_1) ?></h2>
    <h3 style="font-weight:bold;">Cross Match Register</h3>


    <!-- new design -->
    <table id="printtable" style="border: 1px solid black;font-family: arial, sans-serif;border-collapse: collapse;width: 100%;font-size: 10px;">
        <tr>
            <th style="width: 8%;border: 1px solid black; text-align: center;">Cross Match<br>No.</th>
            <th style="width: 7%;border: 1px solid black; text-align: center;">Date</th>
            <th style="width: 9%;border: 1px solid black; text-align: center;">Request<br>No.</th>
            <th style="width: 10%;border: 1px solid black; text-align: center;">Patient Name</th>
            <th style="width: 8%;border: 1px solid black; text-align: center;">Hospital Name</th>
            <th style="width: 8%;border: 1px solid black; text-align: center;">Reg No.</th>
            <th style="width: 5%;border: 1px solid black; text-align: center;">Group<br>Patient</th>
            <th style="width: 6%;border: 1px solid black; text-align: center;">Unit No</th>
            <th style="width: 6%;border: 1px solid black; text-align: center;">Tube No</th>
            <th style="width: 5%;border: 1px solid black; text-align: center;">Blood<br>Group</th>
            <th style="width: 5%;border: 1px solid black; text-align: center;">Component</th>
            <th style="width: 7%;border: 1px solid black; text-align: center;">Cross Match Major</th>
            <th style="width: 8%;border: 1px solid black; text-align: center;">Minor CM<br>Component</th>
            <th style="width: 6%;border: 1px solid black; text-align: center;">Cross Match<br>By</th>
            <th style="width: 8%;border: 1px solid black; text-align: center;">Remark</th>
        </tr>
        <?php
       foreach ($record as $row) {
            $component = get_com($row->component);
            $unit_no = $row->unit_no;
            $parts = explode('-', $unit_no)[0];

        ?>
            <tr>
                <td style="border: 1px solid black; text-align: center;"><?= $row->cross_match ?></td>
                <td style="border: 1px solid black; text-align: center;"><?= date('d-m-Y', strtotime($row->crossmatch_date))  ?></td>
                <td style="border: 1px solid black; text-align: center;"><?= $row->request ?></td>
                <td style="border: 1px solid black; text-align: center;"><?= $row->p_name ?></td>
                <td style="border: 1px solid black; text-align: center;"><?= $row->hospital ?></td>
                <td style="border: 1px solid black; text-align: center;"><?= $row->registration ?></td>
                <td style="border: 1px solid black; text-align: center;"><?= $row->blood_group?></td>
                <td style="border: 1px solid black; text-align: center;"><?= $parts  ?></td>
                <td style="border: 1px solid black; text-align: center;"><?= $row->tube_no ?></td>
                <td style="border: 1px solid black; text-align: center;"><?= $row->groups ?></td>
                <td style="border: 1px solid black; text-align: center;"><?= $component ?></td>
                <td style="border: 1px solid black; text-align: center;"><?= $row->major_comb ?></td>
                <td style="border: 1px solid black; text-align: center;"><?= $row->minnor_cross ?></td>
                <td style="border: 1px solid black; text-align: center;"><?= $row->crossmatch_by ?></td>
                <td style="border: 1px solid black; text-align: center;"></td>
            </tr>
        <?php } ?>
    </table><br>
    <!-- end -->
    
</div>