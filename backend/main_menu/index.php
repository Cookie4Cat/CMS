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
require('../../mysqli_connect.php');  //连接数据库
$query = 'SELECT id,name,description,is_used from main_menu';
$result = @mysqli_query($dbc, $query);

?>

<div class="container">
    <div class="row">
        <h2>栏目管理</h2>
        <a href="create.php" class="btn btn-success">创建栏目</a>
    </div>
    <div class="row">
        <table class="table table-bordered col-md-10">
            <thead>
            <tr>
                <th class="col-md-4">栏目名称</th>
                <th class="col-md-4">栏目描述</th>
                <th class="col-md-1">是否启用</th>
                <th class="col-md-3">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($result as $row){
                echo '<tr><td>'.$row['name'].'</td>';
                echo '<td>'.$row['description'].'</td>';
                $is_used = '是';
                if($row['is_used'] != 0){
                    $is_used = '否';
                }
                echo '<td>'.$is_used.'</td>';
                echo '<td>';
                echo '<a href="view.php?id='.$row['id'].'" class="btn btn-default">查看</a>&nbsp;';
                echo '<a href="update.php?id='.$row['id'].'" class="btn btn-primary">更新</a>&nbsp;';
                echo '<a href="delete.php?id='.$row['id'].'" class="btn btn-danger">删除</a>';
                echo '</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>

</div>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
