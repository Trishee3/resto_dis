<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add product</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="../actions/product-action.php">
                    <div class="form-group">
                        <input type="text" name="productName" class="form-control form-control-user" placeholder="Enter Product Name ..." required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="price" class="form-control form-control-user" placeholder="Enter Price ..." required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="available" class="form-control form-control-user" placeholder="Enter Availability ..." required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit" name="add">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>