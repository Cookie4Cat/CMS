<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">CMS</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <?php
                require('../mysqli_connect.php');  //连接数据库
                $q1 = "SELECT id,name FROM main_menu WHERE is_used = 0";
                $main_menus = @mysqli_query($dbc, $q1);
                foreach ($main_menus as $main_menu){
                    echo '<li class="dropdown">';
                    echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
                    echo $main_menu['name'];
                    echo '<b class="caret"></b></a>';
                    $q2 = "SELECT id,name FROM child_menu WHERE main_menu_id = ".$main_menu['id'];
                    $child_menus = @mysqli_query($dbc, $q2);
                    echo '<ul class="dropdown-menu">';
                    foreach ($child_menus as $child_menu){
                        echo '<li><a href="index.php?type='.$child_menu['id'].'">';
                        echo $child_menu['name'];
                        echo '</a></li>';
                    }
                    echo '</ul>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>