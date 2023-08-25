<!-- Add Tag Modal -->
<div class="modal" id="addTagModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="addTag">
          @csrf
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add Tag</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
              <div class="form-group">
                <label for="tagName">Name</label>
                <input type="text" class="form-control" name="tag_name" id="tag_name" placeholder="Add Tag">
                <small id="tag_name_help" class="text-danger"></small>
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

<!-- Update Tag Modal -->
<div class="modal" id="editTagModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="editTag">
          @csrf
          <input type="hidden" id="tag_id" name="tag_id">
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Edit Tag</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
              <div class="form-group">
                <label for="tagName">Name</label>
                <input type="text" class="form-control" name="edittag_name" id="edittag_name" >
                <small id="edittag_name_help" class="text-danger"></small>
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