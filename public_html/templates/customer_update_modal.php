
<!-- Modal -->
<div class="modal fade" id="customer_update_modal" tabindex="-1" role="dialog" aria-labelledby="customer_update_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customer_update_modalLabel">Edit Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <h1>Shree Ganeshay Namah</h1> -->
        <form id="customer_update_form" method="POST" onsubmit="return false">
          <div class="form-row">
          <div class="form-group col-md-4">
              <label for="company_id" style="margin-top:4%">Company ID</label>
          </div>
            <div class="form-group col-md-3">
              <input type="text" class="form-control" id="company_id" name="company_id" readonly>
            </div>
          </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="customer_name_update">Name&nbsp;<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="customer_name_update" name="customer_name_update">
              <small id="cust_name_error_update" class="form-text text-muted"></small>
            </div>
            <div class="form-group col-md-6">
              <label for="gst_no_update">GST NO.&nbsp;<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="gst_no_update" name="gst_no_update">
              <small id="gst_error_update" class="form-text text-muted"></small>
            </div>
          </div>
          <div>
          <label for="email_update">Email.&nbsp;<span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email_update" name="email_update" placeholder="Email">
            <small id="email_update_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="mobile_no_update">Mobile NO.&nbsp;<span class="text-danger">*</span></label>
            <input type="number" max="9999999999" class="form-control" id="mobile_no_update" name="mobile_no_update" placeholder="Mobile">
            <small id="mob_error_update" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="address_update">Address&nbsp;<span class="text-danger">*</span></label>
            <textarea class="form-control" rows="5" cols="50" id="address_update"  name = "address_update" placeholder="1234 Main St"></textarea>
            <small id="add_error_update" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="city_update">City&nbsp;<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="city_update" name="city_update" placeholder="city_update">
            <small id="city_update_error" class="form-text text-muted"></small>
          </div>   
          <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i>&nbsp;Edit Customer</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

