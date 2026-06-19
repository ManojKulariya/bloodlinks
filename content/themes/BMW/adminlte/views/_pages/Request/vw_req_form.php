<style type="text/css">
    .form-control {
        height: 25px !important;
        padding: 0 14px !important;
        font-size: 14px !important;
    }
    input[type="checkbox"]{
   position: relative;
   display: inline-block;
   margin-left: 5px;
   margin-right: 5px;
   height: 16px;
   width: 16px;
   }

    label {
        margin-bottom: 0;
        font-size: 12px;
    }

    .card-body {
        padding: 10px 20px 0;
    }

    .content-header h1 {
        font-size: 18px;
        margin: 0 6px;
        font-weight: bold;
    }

    .page-item.active .page-link {
        background-color: #ad1e1d !important;
        border-color: #ad1e1d !important;
    }

    .content-wrapper {
        background: #fff;
        text-transform: capitalize;
    }

    .card-footer {
        padding: 18px 0 10px;
        background-color: #fff;
    }


    .btn-xs {
        padding: 2px;
        font-size: 10px;
    }

    .form-group {
        margin-bottom: 0;
    }

    .btn-group h6 {
        font-weight: 500;
        margin: 5px 10px 0;
    }


    .capitalize {
        text-transform: capitalize;
    }
</style>

<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container">
    <form action="<?php echo base_url('hospital/Blood_request_submit') ?>" method="POST">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <input type="hidden" name="bank_id" value="<?= $bank_id ?>">
        <div class="timeline">
            <div class="time-label">
                <span class="bg-red">Patient Information</span>
            </div>
            <div class="card">

                <div class="card-body">
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
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Patient Name *</label>
                                <input type="text" class="form-control" name="p_name" required>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Age *</label>
                                <input type="text" class="form-control" name="age" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Gender *</label>
                                 <select name="gender" class="form-control">
                                    <option value="Male" selected="selected">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                 </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Ward No.*</label>
                                <input type="text" class="form-control" name="ward" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Bed No.*</label>
                                <input type="text" class="form-control" name="bed" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Father's Name *</label>
                                <input type="text" class="form-control" name="f_name" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Name of Hospital *</label>
                                <input type="text" class="form-control" name="hospital" value="<?= $hp_name ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Hospital Registration No. *</label>
                                <input type="text" class="form-control" name="registration" value="<?= $hp_reg ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Phone No. *</label>
                                <input type="text" class="form-control" name="phone" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Name of Consultant. *</label>
                                <input type="text" class="form-control" name="consultant" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="time-label">
                <span class="bg-red">Clinical Information</span>
            </div>
            <div class="card">

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Clinical History *</label>
                                <input type="text" class="form-control" name="clinical_history" required>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Diagnosis *</label>
                                <input type="text" class="form-control" name="diagnosis" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Hb gm% *</label>
                                 <input type="text" class="form-control" name="hb" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Platelet Count</label>
                                <input type="text" class="form-control" name="platelet" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Reason for Transfusion *</label>
                                <input type="text" class="form-control" name="reasons" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">History of Previous Transfusion *</label>
                                <div class="row px-5">
                                    <input type="radio" name="history_previous" value="Yes" > Yes
                                    <input type="radio" name="history_previous" value="No" checked> No
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">Blood Group *</label>
                                <select name="blood_group" class="form-control" id="country">
                                    <option value="A+" selected="selected">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                 </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="description">In case of Female (History of Obstetric) *</label>
                                <input type="text" class="form-control" name="female" required>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="time-label">
                <span class="bg-red">Blood Component Requested</span>
            </div>
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <table class="table table-fluid">
                            <thead>
                                <tr>
                                    <th colspan="2">Components Name</th>
                                    <th>No.of Units Requested</th>
                                    <th>NAT Tested Product</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($component as $com){ ?>
                                    <tr>
                                        <td><label><?= $com->master_type_key_value ?></label></td>
                                        <td>
                                            <input type="checkbox" class="comp-check" name="chkbox">
                                        </td>
                                        <td class="units-field" style="display:none;">
                                            <div class="row col-12">
                                                <input type="number" name="<?= $com->master_type_key_value ?>_unit" class="form-control col-6"> &nbsp;Units
                                            </div>
                                        </td>
                                        <td class="nat-field" style="display:none;">
                                            <div class="row">
                                                <input type="radio" name="<?= $com->master_type_key_value ?>_test" value="Yes" checked> Yes
                                                <input type="radio" name="<?= $com->master_type_key_value ?>_test" value="No" class="mx-3"> No
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                            <!--<button type="submit" name="submit" class="btn btn-sm btn-danger">Submit</button>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="time-label">
                <span class="bg-red">Product Requirement</span>
            </div>
            <div class="card">

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Required Date *</label>
                                <input type="date" class="form-control" name="required_date" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Required Time *</label>
                                <input type="time" class="form-control" name="required_time">
                            </div>
                        </div>
                        <div class="row col-12 m-3">
                            <div class="form-group row col-3">
                                <label for="description">STAT (Within 15 mins)</label>
                                <input type="checkbox" class="form-control" name="stat">
                                    
                            </div>
                            <div class="form-group row col-3">
                                
                                <label for="description">Urgent (One Hour)</label>
                                <input type="checkbox" class="form-control" name="urgent">
                                    
                            </div>
                            <div class="form-group row col-3">
                                
                                <label for="description">Routine</label>
                                <input type="checkbox" class="form-control" name="routine">
                                    
                            </div>
                            <div class="form-group row col-3">
                                
                                <label for="description">Reserved</label>
                                <input type="checkbox" class="form-control" name="reserved">
                                    
                            </div>
                        </div>
                        
                        <h5 class="m-2"><b>To be Completed by Person Drawing Blood Specimen</b></h5>
                        <div class="row col-12 m-3">
                            <div class="form-group row col-6">
                                <input type="checkbox" class="form-control" name="patient" >
                                <label for="description">Patient (if concious) confirms to his and father's name</label>
                            </div>
                            <div class="form-group row col-6">
                                 <input type="checkbox" class="form-control" name="identity" >
                                <label for="description">If unconscious Relative(s)/Staff confirm the identity</label>
                            </div>
                            <div class="form-group row col-6">
                                <input type="checkbox" class="form-control" name="medical" >
                                <label for="description">The Identity, Reg. No. checks with the medical records and same is <br> written on the requisition form</label>
                                
                            </div>
                            <div class="form-group row col-6">
                                <input type="checkbox" class="form-control" name="completely" >
                                <label for="description"> Requisition form is properly and completely filled</label>
                                
                            </div>
                             <div class="form-group row col-6">
                                <input type="checkbox" class="form-control" name="sample" >
                                <label for="description">Sample tube carries the patient's name, reg. no., ward no.</label>
                            </div>
                            <div class="form-group row col-6">
                                <input type="checkbox" class="form-control" name="match" >
                                <label for="description"> These match with the medical records</label>
                            </div>
                            <div class="form-group row col-6">
                                <input type="checkbox" class="form-control" name="sample_tube" >
                                <label for="description">Phlebotomist has signed the sample tube</label>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-footer">
                        <div class="btn-group" style="float: right;">
                            <button type="submit" name="submit" class="btn btn-sm btn-danger">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>

<script>
document.querySelectorAll(".comp-check").forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
        const row = this.closest("tr");
        const unitsField = row.querySelector(".units-field");
        const natField = row.querySelector(".nat-field");

        if (this.checked) {
            unitsField.style.display = "";
            natField.style.display = "";
        } else {
            unitsField.style.display = "none";
            natField.style.display = "none";

            // Optional: clear values when unchecked
            row.querySelector('input[type="number"]').value = "";
            row.querySelectorAll('input[type="radio"]').forEach(r => r.checked = false);
        }
    });
});
</script>
   