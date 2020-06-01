
<!-- Modal -->
<div class="modal fade" id="category_add_modal" tabindex="-1" role="dialog" aria-labelledby="category_add_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="category_add_modalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_category_form" method="POST" onsubmit="return false">
          <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" aria-describedby="cat_error" placeholder="Category Name">
            <small id="cat_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="parent_cat">Select Parent Category</label>
            <select id="parent_cat" name="parent_cat" class="form-control">
            
            </select>
          </div>
          <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;Add Category</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
