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
        <div style="overflow-x:auto;box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);padding: 12px;border-radius: 4px;margin-left: -6px;">
            <table class="table table-fluid" id="myTable">
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>BloodBank</th>
                        <th>Unit No</th>
                        <th>Blood Volume</th>
                        <th>Date</th>
                        <th>Issue No</th>
                        <th>Request No</th>
                        <th>Components</th>
                        <th>Blood Group</th>
                        <th>Tube No</th>
                        <th>Patient Name</th>
                        <th>Slip No.</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $no=>$row) { ?>

                    <tr>
                        <th scope="row"><?= ++$no ?></th>
                        <td class="capitalize"><?= $row->bb_name ?></td>
                        <td class="capitalize"><?= $row->unit_no ?></td>
                        <td class="capitalize"><?= $row->balance_vol ?></td>
                        <td class="capitalize"><?= date('d-m-Y', strtotime($row->issue_date)) ?></td>
                        <td class="capitalize"><?= $row->issue_no ?></td>
                        <td class="capitalize"><?= $row->request ?></td>
                        <td class="capitalize">
                          <?php
            
                          if ($row->component == "wholeblood") {
                            echo $row->component;
                          } else {
            
                            echo $row->master_type_key_short_value;
                          }
                          ?>
                        </td>
                        <td class="capitalize"><?= $row->blood_group ?></td>
                        <td class="capitalize"><?= $row->tube_no ?></td>
                        <td class="capitalize"><?= $row->p_name ?></td>
                        
                        <td><?= $row->slip_no ?></td>
                        <td>
                            <?php if($row->is_rec == 'Yes'){ ?>
                                
                                <label class="fw-bold mb-0"><?= $row->inq_status ?></label>
                                <?php if($row->inq_status == 'Pending'){ ?>
                                
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <button type="button" class="btn btn-primary btn-sm" 
                                                onclick="updateStatus2('<?php echo $row->id; ?>', 'Transfuse to Patient')">
                                            Transfuse to Patient
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" 
                                                onclick="openDiscardModal('<?php echo $row->id; ?>')">
                                            Discard
                                        </button>
                                    </div>
                                <?php } ?>
                                <?php if($row->inq_status == 'Discard'){ ?>
                                    <label class="fw-bold mb-0"><?= $row->dis_res ?></label>
                                <?php } ?>
                                
                            <?php }else{ ?>
                                <label class="fw-bold mb-0">Received : <?= $row->is_rec  ?></label>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    
                                    <button type="button" class="btn btn-success btn-sm" 
                                        onclick="updateStatus('<?php echo $row->id; ?>', 'Yes')">
                                        Yes
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" 
                                        onclick="updateStatus('<?php echo $row->id; ?>', 'No')">
                                        No
                                    </button>
                                </div>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                   
            </table>
        </div>
 </div>
 <!-- Discard Modal -->
<div class="modal fade" id="discardModal" tabindex="-1" aria-labelledby="discardModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title fw-bold" id="discardModalLabel">Discard Blood Unit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="discardId">
        <div class="mb-3">
          <label class="form-label">Discard No.</label>
          <input type="text" class="form-control" value="" id="discardno" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Discard Date</label>
          <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" id="discardDate" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Reason</label>
          <select id="discardReason"  required class="form-control">
                <!--<option value=''>Choose...</option>-->
                <option value='Expiry'>Expiry</option>
                <option value='TTI Reactive'>TTI Reactive</option>
                <option value='Any other Reason'>Any other Reason</option>
            </select>
          <!--<textarea class="form-control" id="discardReason" placeholder="Enter reason" required></textarea>-->
        </div>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>-->
        <button type="button" class="btn btn-warning" onclick="submitDiscard()">Submit</button>
      </div>
    </div>
  </div>
</div>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
  $('#myTable').DataTable();
});
function openDiscardModal(id) {
    $('#discardId').val(id);
    
    // $('#discardReason').val('');
    var modal = new bootstrap.Modal(document.getElementById('discardModal'));
    modal.show();
}

function updateStatus(id, value) {
    if(confirm("Are you sure you want to mark as " + value + "?")) {
        var url = "<?php echo base_url('hospital/Blood_request_issued_rec'); ?>";
       
        $.ajax({
            url: url,
            type: "POST",
            data: {id: id, is_rec: value},
            success: function(response) {
                location.reload(); // Refresh table after update
            },
            error: function() {
                alert("Error updating status.");
            }
        });
    }
}

function updateStatus2(id, value) {
    if(confirm("Are you sure you want to mark as " + value + "?")) {
        $.ajax({
            url: "<?php echo base_url('hospital/Blood_request_update_status'); ?>",
            type: "POST",
            data: {id: id, status: value},
            success: function(response) {
                location.reload();
            },
            error: function() {
                alert("Error updating status.");
            }
        });
    }
}

// Open Discard Modal
function openDiscardModal(id) {
    $('#discardId').val(id);
    $('#discardReason').val('');
    var modal = new bootstrap.Modal(document.getElementById('discardModal'));
    modal.show();
}

// Submit Discard Info
function submitDiscard() {
    var id = $('#discardId').val();
    var date = $('#discardDate').val();
    var dis_no = $('#discardno').val();
    var reason = $('#discardReason').val();

    if(!date || !reason){
        alert("Please enter both date and reason!");
        return;
    }

    $.ajax({
        url: "<?php echo base_url('hospital/Blood_request_discard_blood'); ?>",
        type: "POST",
        data: {id: id, discard_date: date, reason: reason,dis_no:dis_no},
        success: function(response) {
            location.reload();
        },
        error: function() {
            alert("Error discarding blood unit.");
        }
    });
}
</script>
