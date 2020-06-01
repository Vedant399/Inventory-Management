
<!-- Modal -->
<div class="modal fade" id="stock_add_modal" tabindex="-1" role="dialog" aria-labelledby="stock_add_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="stock_add_modalLabel">Add Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add_stock_form" method="POST" onsubmit="return false">
          <div class="form-group">
            <label for="purchase_date">Purchase Date</label>
            <input type="text" class="form-control purchase_date" id="purchase_date" name="purchase_date" value="<?php
                  date_default_timezone_set("Asia/Calcutta");
                echo date("d-m-Y");
                  ?>">
          </div>
          <div class="form-group">
            <label for="payment_date">Supplier</label>
            <select class="form-control" name="supplier_name_for_purchase" id="supplier_name_for_purchase">
              
            </select>
          </div>

          <div class="form-group">
            <label for="bill_no">Current Stock</label>
            <input type="text" class="form-control bill_no" id="bill_no" name="bill_no" placeholder="Bill / Reference NO.">
          </div>

          <div class="form-group">
            <label for="product_for_stock">Product</label>
            <select class="form-control product_for_stock" id="product_for_stock" name="product_for_stock">


            </select>
            <small id="product_for_stock_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label for="current_stock">Current Stock</label>
            <input type="number" class="form-control current_stock" id="current_stock" name="current_stock" readonly>
          </div>
          <div class="row">
           
            <div class="form-group col-md-6">
            <label for="add_stock">Enter Stock</label>
            <input type="number" class="form-control" id="add_stock" name="add_stock" >
            <small id="add_stock_error" class="form-text text-muted"></small>
          </div>

          <div class="form-group col-md-6">
            <label for="price_purchase">Enter Price</label>
            <input type="number" class="form-control" id="price_purchase" name="price_purchase" >
            <small id="price_purchase_error" class="form-text text-muted"></small>
          </div>

          </div>
          

          <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;Add Stock</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
