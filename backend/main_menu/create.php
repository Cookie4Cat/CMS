<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>内容管理系统</title>
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.js"></script>
</head>
<body>
<?php include('../../includes/backend_header.php'); ?>
<?php

//如果有请求提交
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $is_used = $_POST['is_used'];
    require('../../mysqli_connect.php');  //连接数据库
    $query = "INSERT INTO main_menu(name,description,is_used) VALUES ('$name','$description','$is_used')";
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
        <h2>创建栏目</h2>
        <ol class="breadcrumb">
            <li><a href="index.php">栏目管理</a></li>
            <li><a href="#">创建栏目</a></li>
        </ol>
    </div>
    <div class="row">
        <form action="create.php" method="POST" id="comment-form" enctype="multipart/form-data" class="col-lg-8">
            <div class="form-group">
                <label for="name">栏目名称</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="栏目1" required>
            </div>
            <div class="form-group">
                <label for="description">描述</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="简要描述" required>
            </div>
            <div class="form-group">
                <label for="yes">是否启用</label><br/>
                <label class="radio-inline">
                    <input type="radio" name="is_used" id="yes" value="0"> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="is_used" id="no" value="1" checked> 否
                </label>
            </div>
            <button type="submit" class="btn btn-success">创建</button>
        </form>
    </div>

</div>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
