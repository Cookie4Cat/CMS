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

//获取要更新的id
if(isset($_GET['id'])){
    $id = $_GET['id'];
    require('../../mysqli_connect.php');  //连接数据库
    $query = "SELECT name,description, is_used FROM main_menu WHERE id = ".$id;
    $r = @mysqli_query($dbc, $query);
    $name = "";
    $description = "";
    $yes = "checked";
    $no = "checked";
    foreach ($r as $row){
        $name = $row['name'];
        $description = $row['description'];
        if($row['is_used'] == 0){
            $no = "";
        }else{
            $yes = "";
        }
    }
}
//如果有请求提交
if(isset($_POST['name'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $is_used = $_POST['is_used'];
    $yes = "";
    $no = "";
    require('../../mysqli_connect.php');  //连接数据库
    $query = "UPDATE main_menu SET name='$name',description='$description',is_used='$is_used' WHERE id = ".$id;
    $r = @mysqli_query($dbc, $query);      //执行更新语句
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
        <form action="update.php" method="POST" id="comment-form" enctype="multipart/form-data" class="col-lg-8">
            <div class="form-group">
                <label for="name">栏目名称</label>
                <input type="text" class="form-control" <?php echo 'value="'.$name.'"'?> id="name" name="name" placeholder="栏目1" required>
            </div>
            <div class="form-group">
                <label for="description">描述</label>
                <input type="text" class="form-control" <?php echo 'value="'.$description.'"'?> id="description" name="description" placeholder="简要描述" required>
            </div>
            <div class="form-group">
                <label for="yes">是否启用</label><br/>
                <label class="radio-inline">
                    <input type="radio" name="is_used" id="yes" value="0" <?php echo $yes?>> 是
                </label>
                <label class="radio-inline">
                    <input type="radio" name="is_used" id="no" value="1" <?php echo $no?>> 否
                </label>
            </div>
            <input type="hidden" name="id"<?php echo 'value="'.$id.'"'?>>
            <button type="submit" class="btn btn-success">更新</button>
        </form>
    </div>

</div>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
