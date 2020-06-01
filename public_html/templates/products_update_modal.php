
<!-- Modal -->
<div class="modal fade" id="product_update_modal" tabindex="-1" role="dialog" aria-labelledby="product_update_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="product_update_modalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_product_form" method="POST" onsubmit="return false">
          <div class="form-group">
              <label for="product_id">Product ID</label>
              <input type="text" class="form-control" id="pid" name="pid" value="" readonly>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="product_name_update">Product Name</label>
                <input type="text" class="form-control" id="product_name_update" name="product_name_update" value="">
                <small id="name_error_update" class="form-text text-muted"></small>
              </div>
              
              <div class="form-group col-md-6">
                <label for="added_date_update">Date</label>
                <input type="text" class="form-control" id="added_date_update" name="added_date_update" readonly value="">
              </div>
            </div>
            <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="status_product" id="status1_product" value="1">
                      <label class="form-check-label" for="status1_product">Active</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="status_product" id="status2_product" value="0">
                      <label class="form-check-label" for="status2_product">De Activate</label>
                    </div>
                  </div>
                </div>
            </div>
            <div class="form-group">
              <label for="select_cat_update">Category</label>
              <select class="form-control" id="select_cat_update" name="select_cat_update" >
                
              </select>
              <small id="cat_error_update_product" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="select_brand_update">Brand</label>
              <select class="form-control" id="select_brand_update" name="select_brand_update" >
                
              </select>
              <small id="brand_error_update_product" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="product_price_update">Product Price</label>
              <input type="text" class="form-control" id="product_price_update" name="product_price_update" value="">
              <small id="price_error_update" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="product_qty_update">Product Quantity</label>
              <input type="text" class="form-control" id="product_qty_update" name="product_qty_update"  value="">
              <small id="qty_error_update" class="form-text text-muted"></small>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i>&nbsp;Edit Product</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
