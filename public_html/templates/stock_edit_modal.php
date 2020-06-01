
<!-- Modal -->
<div class="modal fade" id="stock_edit_modal" tabindex="-1" role="dialog" aria-labelledby="stock_edit_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="stock_edit_modalLabel">Edit Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit_stock_form" method="POST" onsubmit="return false">
          <div class="row">
            <div class="form-group col-md-6">
            <label for="purchase_id">ID:</label>
            <input type="text" class="form-control" id="purchase_id" name="purchase_id" readonly>
          </div>
          <div class="form-group col-md-6">
            <label for="purchase_date_edit">Purchase Date</label>
            <input type="text" class="form-control purchase_date" id="purchase_date_edit" name="purchase_date_edit">
          </div>
          </div>
          <div class="form-group">
            <label for="supplier_name_for_purchase_edit">Supplier</label>
            <select class="form-control" name="supplier_name_for_purchase_edit" id="supplier_name_for_purchase_edit">
              
            </select>
          </div>

          <div class="form-group">
            <label for="bill_no_edit">Bill NO.</label>
            <input type="text" class="form-control bill_no" id="bill_no_edit" name="bill_no_edit" placeholder="Bill / Reference NO.">
          </div>

          <div class="form-group">
            <label for="product_for_stock_edit">Product</label>
            <select class="form-control product_for_stock" id="product_for_stock_edit" name="product_for_stock_edit">


            </select>
            <small id="product_for_stock_edit_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="current_stock_edit">Current Stock</label>
            <input type="number" class="form-control current_stock" id="current_stock_edit" name="current_stock_edit" readonly>
          </div>
          <div class="row">
           
            <div class="form-group col-md-6">
            <label for="add_stock_edit">Enter Stock</label>
            <input type="number" class="form-control" id="add_stock_edit" name="add_stock_edit" >
            <small id="add_stock_edit_error" class="form-text text-muted"></small>
          </div>

          <div class="form-group col-md-6">
            <label for="price_purchase_edit">Enter Price</label>
            <input type="number" class="form-control" id="price_purchase_edit" name="price_purchase_edit" >
            <small id="price_purchase_edit_error" class="form-text text-muted"></small>
          </div>

          </div>
          

          <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i>&nbsp;Edit Stock</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
