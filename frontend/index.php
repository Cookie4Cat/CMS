<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>内容管理系统</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.js"></script>
</head>
<body>
<?php include ('../includes/header.php'); ?>
<?php
if(isset($_GET['type'])){
    $type = $_GET['type'];
}else{
    $type = 1;
}
$display = 2;//每页显示的条数
$q = "SELECT COUNT(*) FROM article WHERE type = ".$type;
$r = @mysqli_query($dbc, $q);
$row = @mysqli_fetch_array($r, MYSQLI_NUM);
$records = $row[0];
if($records>$display){//计算页码
    $pages = ceil($records/$display);
}else{
    $pages = 1;
}
if(isset($_GET['page'])&&is_numeric($_GET['page'])){
    $current_page = $_GET['page'];
    $start = ($current_page - 1)*$display;
}else{
    $current_page = 1;
    $start = 0;
}
$query = "SELECT id, title, author, time FROM article WHERE type = '$type'
              ORDER BY time ASC LIMIT $start,$display";
$result = @mysqli_query($dbc, $query);   //执行分页查询

?>

<div class="container">
    <div class="row">
        <table class="table table-bordered col-md-10">
            <thead>
            <tr>
                <th>标题</th>
                <th class="col-md-2">作者</th>
                <th class="col-md-2">发布时间</th>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach ($result as $row){
                    echo '<tr></tr><td><a href="detail.php?id='.$row['id'].'">'.$row['title'].'</a></td>';
                    echo '<td>'.$row['author'].'</td>';
                    echo '<td>'.$row['time'].'</td></tr>';
                }
            ?>
            </tbody>
        </table>
        <?php
            if($pages>1){
                if($current_page>1){    //设置前一页
                    $pre_page = $current_page - 1;
                }else{
                    $pre_page = 1;
                }

                if($current_page==$pages){   //设置后一页
                    $next_page = $current_page;
                }else{
                    $next_page = $current_page + 1;
                }

                echo '<ul class="pagination">';
                echo '<li><a href="index.php?type='.$type.'&page='.$pre_page.'">&laquo;</a></li>';

                for($i=1; $i<=$pages; $i++) {   //设置页码样式
                    if($i == $current_page){
                        echo '<li class="active"><a href="index.php?type='.$type.'&page=' . $i . '">'.$i.'</a></li>';
                    }else{
                        echo '<li><a href="index.php?type='.$type.'&page=' . $i . '">'.$i.'</a></li>';
                    }
                }
                echo '<li><a href="index.php?type='.$type.'&page='.$next_page.'">&raquo;</a></li>';
            }
        ?>
    </div>
</div>
<?php include ('../includes/footer.php'); ?>
</body>
</html>
