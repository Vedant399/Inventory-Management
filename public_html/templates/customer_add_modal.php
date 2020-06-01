
<!-- Modal -->
<div class="modal fade" id="customer_add_modal" tabindex="-1" role="dialog" aria-labelledby="customer_add_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="customer_add_modalLabel">Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <h1>Shree Ganeshay Namah</h1> -->
        <form id="customer_add_form" method="POST" onsubmit="return false">
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="customer_name">Name&nbsp;<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="customer_name_1" name="customer_name">
              <small id="cust_name_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group col-md-6">
              <label for="gst_no">GST NO.&nbsp;<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="gst_no" name="gst_no">
              <small id="gst_error" class="form-text text-muted"></small>
            </div>
          </div>
          <div class="form-group">
            <label for="mobile_no">Mobile NO.&nbsp;<span class="text-danger">*</span></label>
            <input type="number" max="9999999999" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile">
            <small id="mob_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="email_cust">Email.&nbsp;<span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email_cust" name="email_cust" placeholder="Email">
            <small id="email_cust_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="address">Address&nbsp;<span class="text-danger">*</span></label>
            <textarea class="form-control" rows="5" cols="50" id="address"  name = "address" placeholder="1234 Main St"></textarea>
            <small id="add_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="city">City&nbsp;<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="city" name="city" placeholder="City">
            <small id="city_error" class="form-text text-muted"></small>
          </div>          
          <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;Add Customer</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

