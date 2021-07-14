<!doctype html>
<html lang="en">

<head>
    <!-- Head metas, css, and title -->
    <?php require_once '../includes/head.php'; ?>
</head>

<body>
    <!-- Header banner -->
    <?php require_once '../includes/header.php'; ?>
    <!--contect-->
    <div class="container-fluid position-absolute px-0">
        <div class="row w-100 mx-0" style="width: 100wh;">
            <!-- Sidebar menu -->
            <?php require_once '../includes/sidebar.php'; ?>
            <!-- </nav> -->
            <main class="col w-100 bg-light">
                <h1 class="h2" style="margin-top: 16px">新增精選食譜</h1>
                <p>(<span class="text-danger">*</span>)為必填資料</p>
                <form method="post" enctype="multipart/form-data" action="featuredAdd.php">
                    <!-- id -->
                    <div class="form-group">
                        <label for="id">id</label>
                        <input class="form-control" type="text" name="id" id="id" readonly>
                    </div>
                    <!-- type -->
                    <div class="form-group">
                        <label for="type">食譜分類 <span class="text-danger">*</span></label>
                        <select class="form-control" name="type" id="type">
                            <option>健康長肉肉</option>
                            <option>健康不吃肉</option>
                            <option>家常好手藝</option>
                            <option>一週不煩惱</option>
                        </select>
                        <select class="form-control" name="type" id="type2222" disabled>
                            <option>示範1</option>
                            <option>示範2</option>
                            <option>示範3</option>
                            <option>示範4</option>
                        </select>
                    </div>
                    <!-- name -->
                    <div class="form-group">
                        <label for="name">食譜名稱 <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="請輸入食材名稱" required maxlength="100">
                    </div>
                    <!-- 社群連結 -->
                    <div class="form-group">
                        <label for="link" class="form-label">社群連結</label>
                        <input class="form-control" type="text" id="link" name="link" placeholder="請輸入社群連結網址">
                    </div>
                    <!-- 食譜份量 -->
                    <div class="form-group">
                        <label for="qty">食譜份量 </label>
                        <input class="form-control" type="text" name="qty" id="qty" placeholder="食譜份量" maxlength="100">
                    </div>
                    <!-- 食材 -->
                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="prep">食材</label>
                        </div>
                        <div class="col-md-3">
                            <label for="unit">單位</label>
                        </div>
                        <div class="col-md-6">
                            </div>
                    </div>
                    <div id="dynamic_field">                            
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <input type="text" name="prep" id="prep" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text"  name="unit" id="unit" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <td><button type="button" name="add_f" id="add_f" class="btn btn-warning">新增</button></td>
                            </div>
                        </div>
                    </div>
                    <!-- 料理流程 -->
                    <div class="form-group">
                        <label for="step">料理流程 <span class="text-danger">*</span></label>
                        <textarea name="step" id="step" cols="30" rows="5" class="form-control" required></textarea>
                    </div>

                    <!-- 瀏覽次數 -->
                    <div class="form-group">
                        <label for="view_qty">瀏覽次數</label>
                        <input class="form-control" type="text" id="view_qty" name="view_qty" placeholder="請輸入瀏覽次數">
                    </div>
                    <!-- 按讚次數 -->
                    <div class="form-group">
                        <label for="like_qty">按讚次數 </label>
                        <input class="form-control" type="text" name="like_qty" id="like_qty" placeholder="按讚次數" maxlength="100">
                    </div>
                    <!-- 收藏次數 -->
                    <div class="form-group">
                        <label for="save_qty">收藏次數 </label>
                        <input class="form-control" type="text" name="save_qty" id="save_qty" placeholder="收藏次數" maxlength="100">
                    </div>

                    <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Save">
                </form>
            </main>
        </div>
    </div>
    <!-- Footer scripts, and functions -->
    <?php require_once '../includes/footer.php'; ?>
    <script>
        $(document).ready(function(){
            var i = 1;
            $('#add_f').click(function(){
                i++;
                $('#dynamic_field').append('<div class="form-row" id="row'+i+'"><div class="form-group col-md-3"><input type="text" name="prep" id="prep" class="form-control"></div><div class="form-group col-md-3"><input type="text" name="unit" id="unit" class="form-control"></div><div class="form-group col-md-6"><td><button type="button" name="remove_f" id="'+i+'" class="btn btn-danger btn_remove">刪除</button></td></div></div>');
            });
            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr('id');
                $('#row' + button_id + '').remove();
            });


            // 快來看我
            // .change()可以偵測 下拉式選單的變動

            // .prop()  
            //  它跟.attr()蠻像的。
            // .attr()用來抓或設定 HTML 標籤內 attribute 的值
            // .prop()用來抓或設定像 checked 或 disabled 這種只有true 跟 false 兩種狀態的 attribute。

            // .find(':selected').text(); 
            // 一定要加.find(':selected')才能抓到選到的option
            // 如果偷懶只寫.text()，那會抓到所有的option內容
            // 例如 $(this).text(); 會輸出：健康長肉肉健康不吃肉家常好手藝一週不煩惱
            // 例如 $(this).find(':selected').text(); 會輸出：一週不煩惱

            $('#type').change(function(){
                let weekcheck = $(this).find(':selected').text();
                if(weekcheck == '一週不煩惱'){
                    $("#type2222").prop("disabled", false);
                } else {
                    $("#type2222").prop("disabled", true);
                }
                
            })
        });
    </script>
</body>

</html>