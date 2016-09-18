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
if(isset($_GET['id'])){
    $id = $_GET['id'];
    require('../../mysqli_connect.php');  //连接数据库
    $query = 'SELECT c.id, c.name,c.description, c.is_used, m.name main_menu_name
          FROM child_menu c, main_menu m
          WHERE c.main_menu_id = m.id AND c.id = '.$id;
    $r = @mysqli_query($dbc, $query);
    $name = "";
    $description = "";
    $is_used = "";
    foreach ($r as $row){
        $name = $row['name'];
        $description = $row['description'];
        $main_menu_name = $row['main_menu_name'];
        $is_used = $row['is_used']== 0 ? "是":"否";
    }
}
?>

<div class="container">
    <div class="row">
        <h2>查看子栏目</h2>
        <ol class="breadcrumb">
            <li><a href="index.php">子栏目管理</a></li>
            <li><a href="#">查看子栏目</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="row">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="col-md-3">属性</th>
                    <th class="col-md-5">内容</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><strong>子栏目名称</strong></td>
                    <td><?php echo $name?></td>
                </tr>
                <tr>
                    <td><strong>子栏目描述</strong></td>
                    <td><?php echo $description?></td>
                </tr>
                <tr>
                    <td><strong>父栏目名称</strong></td>
                    <td><?php echo $main_menu_name?></td>
                </tr>
                <tr>
                    <td><strong>是否启用</strong></td>
                    <td><?php echo $is_used?></td>
                </tr>
                </tbody>
            </table>
            <a href="index.php" class="btn btn-success">确定</a>
        </div>
    </div>
</div>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
