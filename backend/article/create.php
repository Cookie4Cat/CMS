<!doctype html>
<html lang="en">
<?php
$htmlData = '';
if (!empty($_POST['content1'])) {
    if (get_magic_quotes_gpc()) {
        $htmlData = stripslashes($_POST['content1']);
    } else {
        $htmlData = $_POST['content1'];
    }
}
?>
<head>
    <meta charset="UTF-8">
    <title>内容管理系统</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.js"></script>
    <link rel="stylesheet" href="../../kindeditor/themes/default/default.css" />
    <link rel="stylesheet" href="../../kindeditor/plugins/code/prettify.css" />
    <script charset="utf-8" src="../../kindeditor/kindeditor.js"></script>
    <script charset="utf-8" src="../../kindeditor/lang/zh_CN.js"></script>
    <script charset="utf-8" src="../../kindeditor/plugins/code/prettify.js"></script>
    <script>
        KindEditor.ready(function(K) {
            var editor1 = K.create('textarea[name="content1"]', {
                cssPath : '../../kindeditor/plugins/code/prettify.css',
                uploadJson : '../../kindeditor/php/upload_json.php',
                fileManagerJson : '../../kindeditor/php/file_manager_json.php',
                allowFileManager : true,
                afterCreate : function() {
                    var self = this;
                    K.ctrl(document, 13, function() {
                        self.sync();
                        K('form[name=example]')[0].submit();
                    });
                    K.ctrl(self.edit.doc, 13, function() {
                        self.sync();
                        K('form[name=example]')[0].submit();
                    });
                }
            });
            prettyPrint();
        });
    </script>
</head>
<body>
<?php include('../../includes/backend_header.php'); ?>
<?php
//父栏目下拉列表数据
require('../../mysqli_connect.php');  //连接数据库
$query = "SELECT id, name FROM child_menu";
$child_menu_types = @mysqli_query($dbc, $query);


//如果有请求提交
if(isset($_POST['title'])){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content1'];
    $child_menu_id = $_POST['child_menu_id'];
    $query = "INSERT INTO article(title,author,content,time,type)
              VALUES ('$title','$author','$content',now(),'$child_menu_id')";
    $r = @mysqli_query($dbc, $query);      //执行插入语句
    $id = mysqli_insert_id($dbc);
    function redirect($url){           //重定向函数
        echo "<script language=\"javascript\">";
        echo "location.href=\"$url\"";
        echo "</script>";
    }
    redirect("view.php?id=".$id);
}
?>

<div class="container">
    <div class="row">
        <h2>创建子栏目</h2>
        <ol class="breadcrumb">
            <li><a href="index.php">文章管理</a></li>
            <li><a href="#">创建文章</a></li>
        </ol>
    </div>
    <div class="row">
        <form action="create.php" method="POST" id="comment-form" enctype="multipart/form-data" class="col-lg-8">
            <div class="form-group">
                <label for="title">标题</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="标题" required>
            </div>
            <div class="form-group">
                <label for="author">作者</label>
                <input type="text" class="form-control" id="author" name="author" placeholder="作者" required>
            </div>
            <div class="form-group">
                <label for="menu">所属栏目</label>
                <select id="menu" class="form-control" style="width: 200px;margin-bottom: 15px;" name="child_menu_id">
                    <?php
                    foreach ($child_menu_types as $type){
                        echo '<option value="'.$type['id'].'">'.$type['name'].'</option>';
                    }
                    ?>
                </select>
            </div>
            <textarea name="content1" style="width:700px;height:200px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea>
            <button type="submit" class="btn btn-success">创建</button>
        </form>
    </div>

</div>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
