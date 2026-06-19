<style type="text/css">
    .content-wrapper {
        background: #fff;
        text-transform: capitalize;
    }

    .content-header h1 {
        font-size: 1.2rem !important;
        /* margin: 0 20px; */
        font-weight: 700 !important;
    }

    .card-footer {
        padding: 10px 20px;
        background-color: #fff;
    }

   
    label {
        font-size: 12px;
    }

    .form-group {
        margin-bottom: 0;
    }


    table thead th,
    table tbody td {
        padding: 6px !important;
        font-size: 12px;
    }

    .btn-xs {
        padding: 2px;
        font-size: 10px;
    }

  }

    .page-item.active .page-link {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .page-link {
        color: #000;
    }

    .capitalize {
        text-transform: capitalize;
    }


    .card-body {
        padding: 0 10px;
    }
</style>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

  <div class="container">
      <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success mx-5">
                            <?= $this->session->flashdata('success'); ?>
                            <?php $this->session->unset_userdata('success'); ?>
                        </div>
                     <?php endif; ?>
                     <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger mx-5">
                            <?= $this->session->flashdata('error'); ?>
                            <?php $this->session->unset_userdata('error'); ?>
                        </div>
                     <?php endif; ?>
        <div style="overflow-x:auto;box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);padding: 12px;border-radius: 4px;margin-left: -6px;">
            <table class="table table-fluid" id="myTable">
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Appointment Id</th>
                      
                        <th>Blood Bank Name</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Mobile No</th>
                        <th>Application no</th>
                        <th>Blood Group</th>
                       
                        <th>Components Required</th>
                   
                    
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $no=>$row) { ?>

                      <tr>
                        <th scope="row"><?= ++$no ?></th>
                        <td class="capitalize"><?=$row->id ?></td>
                        <td style="text-transform: capitalize;"><?=$row->bb_name ?></td>
                        <td style="text-transform: capitalize;"><?=$row->p_name ?></td>
                        <td style="text-transform: capitalize;"><?=$row->required_date ?></td>
                        <td class="capitalize"><?=$row->request ?></td>
                        <td class="capitalize"><?=$row->phone ?></td>
                        <td class="capitalize"><?=$row->application_no ?></td>
                        <td class="capitalize"><?=$row->blood_group ?></td>
                        
                        <td class="capitalize">
                             <?php
                            $units = json_decode($row->components_unit, true); // Decode JSON to array
                            if (!empty($units)) {
                                foreach ($units as $key => $value) {
                                    if (!empty($value)) { // Only show if there is a value
                                        echo "<b>" . str_replace("_unit", "", str_replace("_", " ", $key)) . "</b>: " . $value . "<br>";
                                    }
                                }
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </td>
                        
                        <td></td>
         
                           
                       </tr>
                    <?php } ?>
                </tbody>
                   
            </table>
        </div>
 </div>
 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    });
</script>