
<!-- Modal -->
<div class="modal fade" id="invoice_edit_modal" tabindex="-1" role="dialog" aria-labelledby="invoice_edit_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="invoice_edit_modalLabel">Add Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_invoice_form" method="POST" onsubmit="return false">
          <div class="form-group">
            <label for="invoice_no_update">Invoice NO.</label>
            <input type="text" class="form-control" id="invoice_no_update" name="invoice_no_update" readonly>
          </div>
          <div class="form-group">
            <label for="payment_date">Date</label>
            <input type="text" class="form-control" id="payment_date" name="payment_date" value="<?php
            date_default_timezone_set("Asia/Calcutta");
            echo date("d-m-Y");
      ?>" >
          </div>
          
          <div class="form-group">
            <label for="paid_update">Paid</label>
            <input type="number" class="form-control paid_update" id="paid_update" name="paid_update" aria-describedby="paid_update_error" value="0">
            <small id="paid_update_error" class="form-text text-muted"></small>
          </div>
              <div class="form-group">
                <label for="due_update">Amount to pay</label>
                <input type="text" class="form-control" id="due_update" name="due_update" readonly >
              </div>
          <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i>&nbsp;Edit Invoice</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
