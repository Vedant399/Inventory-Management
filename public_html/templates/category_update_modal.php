
<!-- Modal -->
<div class="modal fade" id="category_update_modal" tabindex="-1" role="dialog" aria-labelledby="category_update_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="category_update_modalLabel">Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_category_form" method="POST" onsubmit="return false">
          <div class="form-group">
            <label for="cid">Category ID</label>
            <input type="text" class="form-control" id="cid" name="cid" value="" readonly >
          </div>
          <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" class="form-control" id="category_name_update" name="category_name_update" aria-describedby="cat_error"value="">
            <small id="cat_error_update" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="status" id="status1" value="1">
                  <label class="form-check-label" for="exampleRadios2">Active</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="status" id="status2" value="0">
                  <label class="form-check-label" for="exampleRadios2">De Activate</label>
                </div>
              </div>
            </div>
        </div>
          <div class="form-group">
            <label for="parent_cat">Select Parent Category</label>
            <select id="parent_cat_update" name="parent_cat_update" class="form-control">
            
            </select>
          </div>
          <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i>&nbsp;Edit
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
