<!-- add Modal -->
<div class="modal fade" id="delModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="delModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delModalLabel">刪除警告</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
        <div class="modal-body">
          <input type="hidden" name="delete_id" id="delete_id">
          <h5>確定要刪除此會員?</h5>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger" name="delete_data">刪除</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
        </div>
      </form>
    </div>
  </div>
</div>