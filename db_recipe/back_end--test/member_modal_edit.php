<!-- 編輯 Modal -->
<div class="modal fade" id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">編輯會員資料</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="memberEdit.php" method="post">
        <div class="modal-body">
          <p>(<span class="text-danger">*</span>)為必填資料</p>
          <!-- id -->
          <div class="form-group">
            <label for="id">id</label>
            <input class="form-control" type="text" name="id" id="id" readonly>
          </div>
          <!-- name -->
          <div class="form-group">
            <label for="name">Name <span class="text-danger">*</span></label>
            <input  class="form-control" type="text" name="name" id="name" placeholder="請輸入真實姓名" required maxlength="100">
          </div>
          <!-- 大頭貼 -->
          <div class="form-group">
            <label for="picture" class="form-label">大頭貼</label>
            <input class="form-control" type="file" id="picture">
          </div>
          <!-- 帳號 -->
          <div class="form-group">
            <label for="account">帳號 <span class="text-danger">*</span></label>
            <input  class="form-control" type="text" name="account" id="account" placeholder="帳號" required maxlength="100">
          </div>
          <!-- 密碼 -->
          <div class="form-group">
            <label for="password">密碼 <span class="text-danger">*</span></label>
            <input  class="form-control" type="text" name="password" id="password" placeholder="密碼" required maxlength="100">
          </div>
          <!-- 確認密碼 -->
          <!-- 暱稱 -->
          <div class="form-group">
            <label for="nickname">暱稱</label>
            <input  class="form-control" type="text" name="nickname" id="nickname" placeholder="nickname"  maxlength="100">
          </div>
          <!-- 性別 -->
          <div class="form-group">
            <label for="">性別<span class="text-danger">*</span></label>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="gender" value="男">
              <label class="form-check-label" for="inlineRadio1">男</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="gender" value="女">
              <label class="form-check-label" for="inlineRadio2">女</label>
            </div>
          </div>
          <!-- 生日 -->
          <div class="form-group">
            <label for="birthday">生日 <span class="text-danger">*</span></label>
            <input  class="form-control" type="text" name="birthday" id="birthday" placeholder="yyyy-MM-dd" required maxlength="10">
          </div>
          <!-- 電話 -->
          <div class="form-group">
            <label for="phone">電話</label>
            <input  class="form-control" type="text" name="phone" id="phone" placeholder="phone"  maxlength="100">
          </div>
          <!-- email -->
          <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input  class="form-control" type="text" name="email" id="email" placeholder="@gmail.com" required maxlength="100">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="btn_save">儲存</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
        </div>
      </form>
    </div>
  </div>
</div>  