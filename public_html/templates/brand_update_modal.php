
<!-- Modal -->
<div class="modal fade" id="brand_update_modal" tabindex="-1" role="dialog" aria-labelledby="brand_update_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="brand_update_modalLabel">Edit Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_brand_form" method="POST" onsubmit="return false">
          <div class="form-group">
            <label for="bid">Brand ID</label>
            <input type="text" class="form-control" id="bid" name="bid" readonly>
          </div>
          <div class="form-group">
            <label for="brand_name_update">Brand Name</label>
            <input type="text" class="form-control" id="brand_name_update" name="brand_name_update" aria-describedby="brand_error_update" >
            <small id="brand_error_update" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="status_brand" id="status1_brand" value="1">
                      <label class="form-check-label" for="status1_brand">Active</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="status_brand" id="status2_brand" value="0">
                      <label class="form-check-label" for="status2_brand">De Activate</label>
                    </div>
                  </div>
                </div>
            </div>
          <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i>&nbsp;Edit Brand</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
