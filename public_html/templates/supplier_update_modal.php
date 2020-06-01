
<!-- Modal -->
<div class="modal fade" id="supplier_update_modal" tabindex="-1" role="dialog" aria-labelledby="supplier_update_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="supplier_update_modalLabel">Edit Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <h1>Shree Ganeshay Namah</h1> -->
        <form id="supplier_update_form" method="POST" onsubmit="return false">
          <div class="form-row">
          <div class="form-group col-md-4">
              <label for="supplier_id" style="margin-top:4%">Supplier ID</label>
          </div>
            <div class="form-group col-md-3">
              <input type="text" class="form-control" id="supplier_id" name="supplier_id" readonly>
            </div>
          </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="supplier_name_update">Name&nbsp;<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="supplier_name_update" name="supplier_name_update" placeholder="Name">
              <small id="supplier_name_error_update" class="form-text text-muted"></small>
            </div>
            <div class="form-group col-md-6">
              <label for="supplier_gst_no_update">GST NO.&nbsp;<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="supplier_gst_no_update" name="supplier_gst_no_update" placeholder="GST">
              <small id="supplier_gst_error_update" class="form-text text-muted"></small>
            </div>
          </div>
          <div>
          <label for="supplier_email_update">Email.&nbsp;<span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="supplier_email_update" name="supplier_email_update" placeholder="Email">
            <small id="supplier_email_update_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="supplier_mobile_no_update">Mobile NO.&nbsp;<span class="text-danger">*</span></label>
            <input type="number" max="9999999999" class="form-control" id="supplier_mobile_no_update" name="supplier_mobile_no_update" placeholder="Mobile">
            <small id="supplier_mob_error_update" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="supplier_address_update">Address&nbsp;<span class="text-danger">*</span></label>
            <textarea class="form-control" rows="5" cols="50" id="supplier_address_update"  name = "supplier_address_update" placeholder="1234 Main St"></textarea>
            <small id="supplier_add_error_update" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="supplier_city_update">City&nbsp;<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="supplier_city_update" name="supplier_city_update" placeholder="City">
            <small id="supplier_city_update_error" class="form-text text-muted"></small>
          </div>   
          <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i>&nbsp;Edit Supllier</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

