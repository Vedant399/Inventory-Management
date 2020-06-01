
<!-- Modal -->
<div class="modal fade" id="product_add_modal" tabindex="-1" role="dialog" aria-labelledby="product_add_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="product_add_modalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_product_form" method="POST" onsubmit="return false">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Please Enter Product Name">
                <small id="name_error" class="form-text text-muted"></small>
              </div>
              <div class="form-group col-md-6">
                <label for="added_date">Date</label>
                <input type="text" class="form-control" id="added_date" name="added_date" readonly >
              </div>
            </div>
            <div class="form-group">
              <label for="select_cat">Category</label>
              <select class="form-control" id="select_cat" name="select_cat" >
                
              </select>
              <small id="cat_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="select_brand">Brand</label>
              <select class="form-control" id="select_brand" name="select_brand" >
                
              </select>
              <small id="brand_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="product_price">Product Price</label>
              <input type="text" class="form-control" id="product_price" name="product_price"  placeholder="Please Enter Product Price">
              <small id="price_error" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label for="product_qty">Product Quantity</label>
              <input type="text" class="form-control" id="product_qty" name="product_qty"  placeholder="Please Enter Product Quantity">
              <small id="qty_error" class="form-text text-muted"></small>
            </div>
            <button type="submit" class="btn btn-success" id="add_product"><i class="fas fa-plus"></i>&nbsp;Add Product</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
