<!-- Add Category Modal -->
<div class="modal" id="addCategoryModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="addCategory">
          @csrf
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add Category</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
              <div class="form-group">
                <label for="categoryName">Name</label>
                <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Add Category">
                <small id="category_name_help" class="text-danger"></small>
              </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
</div>

<!-- Update Category Modal -->
<div class="modal" id="editCategoryModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="editCategory">
          @csrf
          <input type="hidden" id="category_id" name="category_id">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Edit Category</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
              <div class="form-group">
                <label for="categoryName">Name</label>
                <input type="text" class="form-control" name="editcategory_name" id="editcategory_name" >
                <small id="editcategory_name_help" class="text-danger"></small>
              </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
</div>