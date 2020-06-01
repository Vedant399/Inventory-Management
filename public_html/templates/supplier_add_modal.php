
<!-- Modal -->
<div class="modal fade" id="supplier_add_modal" tabindex="-1" role="dialog" aria-labelledby="supplier_add_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="supplier_add_modalLabel">Add Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <h1>Shree Ganeshay Namah</h1> -->
        <form id="supplier_add_form" method="POST" onsubmit="return false">
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="supplier_name">Name&nbsp;<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="supplier_name_1" name="supplier_name" placeholder="Name">
              <small id="supplier_name_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group col-md-6">
              <label for="supplier_gst">GST NO.&nbsp;<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="supplier_gst" name="supplier_gst" placeholder="GST">
              <small id="supplier_gst_error" class="form-text text-muted"></small>
            </div>
          </div>
          <div class="form-group">
            <label for="supplier_mobile">Mobile NO.&nbsp;<span class="text-danger">*</span></label>
            <input type="number" max="9999999999" class="form-control" id="supplier_mobile" name="supplier_mobile" placeholder="Mobile">
            <small id="supplier_mobile_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="supplier_email">Email.&nbsp;<span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="supplier_email" name="supplier_email" placeholder="Email">
            <small id="supplier_email_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="supplier_address">Address&nbsp;<span class="text-danger">*</span></label>
            <textarea class="form-control" rows="5" cols="50" id="supplier_address"  name = "supplier_address" placeholder="1234 Main St"></textarea>
            <small id="supplier_address_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="supplier_city">City&nbsp;<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="supplier_city" name="supplier_city" placeholder="City">
            <small id="supplier_city_error" class="form-text text-muted"></small>
          </div>          
          <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;Add Supplier</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

