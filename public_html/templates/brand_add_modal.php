
<!-- Modal -->
<div class="modal fade" id="brand_add_modal" tabindex="-1" role="dialog" aria-labelledby="brand_add_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="brand_add_modalLabel">Add New Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_brand_form" method="POST" onsubmit="return false">
          <div class="form-group">
            <label for="brand_name">Brand Name</label>
            <input type="text" class="form-control" id="brand_name" name="brand_name" aria-describedby="brand_error" placeholder="Enter Brand Name">
            <small id="brand_error" class="form-text text-muted"></small>
          </div>
          <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;Add Brand</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
