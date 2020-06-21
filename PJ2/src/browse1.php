
<!DOCTYPE html>
<html>
<head>
<title>浏览页-云驿图片站</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../CSS/bb.css">
</head>
<body>
<ul class="nav">
    <li><a href="..\index.php">首页</a></li>
    <li><a class="active" href="">浏览页</a></li>
    <li><a href="search.php">搜索页</a></li>
    <?php
    header("content-type:text/html;charset=utf8");
    session_start();
    if(empty($_SESSION['user'])){
        echo <<<EOF
        <div class="dropdown">    
        <a href="log.php" class="dropbtn">
            <img src="..\img\head.png" width="22" height="22">
            登录</a>
EOF;

    }else{
        echo '<div class="dropdown">';
        echo '<a href="" class="dropbtn"><img src="..\img\head.png" width="22" height="22">欢迎回来，'.$_SESSION['user'].'</a>';
        echo '<div class="dropdown-content">';
        echo '<a href="upload.php"><img src="..\img\icon\shangchuan.png" width="25" height="25">上传</a>';
        echo '<a href="photo.php"><img src="..\img\icon\tupian.png" width="25" height="25">我的图片</a>';
        echo '<a href="like.php"><img src="..\img\icon\shoucang.png" width="25" height="25">我的收藏</a>';
        echo ' <a href="logout.php"><img src="..\img\icon\denglu-copy.png" width="25" height="25">登出</a>';
        echo '</div>';

    }
    ?>
    </div>
</ul>

<div class="leftguide">
    <ul>
        <li>标题搜索</li>
        <li><input type="text" name="searchtitle" class="searchinput"></li>
        <li>
            <button>搜索</button>
        </li>
        <li>热门国家</li>
        <div class="hot">
            <?php

            $servername ="localhost";
            $db_username="projectuser";
            $db_password="123456";
            $db_name="photos";
            $conn=new mysqli($servername,$db_username,$db_password,$db_name);

            $sql = "SELECT *, COUNT(*) FROM travelimage GROUP BY Country_RegionCodeISO ORDER BY COUNT(*) DESC LIMIT 3";
            $query = mysqli_query($conn,$sql);
            $result = $conn -> query($sql);
            while($row = $result->fetch_assoc()){
                $sql1 = "SELECT * FROM geocountries_regions WHERE ISO = '".$row['Country_RegionCodeISO']."'";
                $query1 = mysqli_query($conn,$sql1);
                $result1 = $conn -> query($sql1);
                $row1= $result1->fetch_assoc();
                echo '<a href="browser1.php?hotcountry='.$row1['Country_RegionName'].'"><li><button>'.$row1['Country_RegionName'].'</button></li></a>';
            }
            ?>
        </div>
        <li>热门城市</li>
        <div class="hot">
        <?php

        $servername ="localhost";
        $db_username="projectuser";
        $db_password="123456";
        $db_name="photos";
        $conn=new mysqli($servername,$db_username,$db_password,$db_name);

        $sql = "SELECT *, COUNT(*) FROM travelimage GROUP BY CityCode ORDER BY COUNT(*) DESC LIMIT 20";
        $query = mysqli_query($conn,$sql);
        $result = $conn -> query($sql);
        for($i=0;$i<4;$i++){
            $row = $result->fetch_assoc();
            $sql1 = "SELECT * FROM geocities WHERE GeoNameID = '".$row['CityCode']."'";
            $query1 = mysqli_query($conn,$sql1);
            $result1 = $conn -> query($sql1);
            $row1= $result1->fetch_assoc();
            if(!empty($row1['AsciiName'])){
            echo '<a href="browser1.php?hotcity='.$row1['AsciiName'].'"><li><button>'.$row1['AsciiName'].'</button></li></a>';}else{
                $i--;
            }
        }
        ?>
            <li>热门内容</li>
            <div class="hot">
            <?php

            $servername ="localhost";
            $db_username="projectuser";
            $db_password="123456";
            $db_name="photos";
            $conn=new mysqli($servername,$db_username,$db_password,$db_name);

            $sql = "SELECT *, COUNT(*) FROM travelimage GROUP BY Content ORDER BY COUNT(*) DESC LIMIT 20";
            $query = mysqli_query($conn,$sql);
            $result = $conn -> query($sql);
            for($i=0;$i<4;$i++){
                $row = $result->fetch_assoc();
                if(!empty($row['Content'])){
                    echo '<a href="browser1.php?hotcontent='.$row['Content'].'"><li><button>'.$row['Content'].'</button></li></a>';}
            }
        ?>
            </div>
    </ul>
</div>



<?php
    $sqlCou = "SELECT *, COUNT(*) FROM travelimage GROUP BY Country_RegionCodeISO ORDER BY COUNT(*) DESC LIMIT 4";
    $queryCou = mysqli_query($conn,$sqlCou);
    $resultCou = $conn -> query($sqlCou);
?>

<form method="POST" action="select.php" class="screen">
    <select id="first" name="first" onChange="nextChange()">
        <option selected="selected">请选择国家</option>
        <?php
        while($rowCou = $resultCou->fetch_assoc()){
            $sqlCou1 = "SELECT * FROM geocountries_regions WHERE ISO = '".$rowCou['Country_RegionCodeISO']."'";
            $queryCou1 = mysqli_query($conn,$sqlCou1);
            $resultCou1 = $conn -> query($sqlCou1);
            $rowCou1= $resultCou1->fetch_assoc();
            echo'<option>'.$rowCou1['Country_RegionName'].'</option>';
        }
        ?>
    </select>

    <select id="second" name="second">
        <option selected="selected">请选择城市</option>
    </select>

    <input class="circlebtn" value="搜索" type="submit">
</form>

<script>
    function nextChange()
    {
        var first = document.getElementById("first");
        var second = document.getElementById("second");
        second.options.length = 0;
        if(first.selectedIndex == 1)
        {
            <?php
            $sqlCou2 = "SELECT *, COUNT(*) FROM travelimage GROUP BY Country_RegionCodeISO ORDER BY COUNT(*) DESC LIMIT 1";
            $queryCou2 = mysqli_query($conn,$sqlCou2);
            $resultCou2 = $conn -> query($sqlCou2);

            $rowCou2 = $resultCou2->fetch_assoc();


            $sqlCou3 = "SELECT * FROM geocountries_regions WHERE ISO = '".$rowCou2['Country_RegionCodeISO']."'";
            $queryCou3 = mysqli_query($conn,$sqlCou3);
            $resultCou3 = $conn -> query($sqlCou3);
            $rowCou3= $resultCou3->fetch_assoc();

            $sqlCit = "SELECT * FROM `geocities` WHERE Country_RegionCodeISO= '".$rowCou3['ISO']."' ORDER BY Population DESC LIMIT 4";
            $queryCit = mysqli_query($conn,$sqlCit);
            $resultCit = $conn -> query($sqlCit);
            while($rowCit = $resultCit->fetch_assoc()){
                echo'second.options.add(new Option("'.$rowCit['AsciiName'].'"));';
            }
            ?>
        }

        if(first.selectedIndex == 2)
        {
            <?php
            $sqlCou2 = "SELECT *, COUNT(*) FROM travelimage GROUP BY Country_RegionCodeISO ORDER BY COUNT(*) DESC LIMIT 1,1";
            $queryCou2 = mysqli_query($conn,$sqlCou2);
            $resultCou2 = $conn -> query($sqlCou2);

            $rowCou2 = $resultCou2->fetch_assoc();


            $sqlCou3 = "SELECT * FROM geocountries_regions WHERE ISO = '".$rowCou2['Country_RegionCodeISO']."'";
            $queryCou3 = mysqli_query($conn,$sqlCou3);
            $resultCou3 = $conn -> query($sqlCou3);
            $rowCou3= $resultCou3->fetch_assoc();

            $sqlCit = "SELECT * FROM `geocities` WHERE Country_RegionCodeISO= '".$rowCou3['ISO']."' ORDER BY Population DESC LIMIT 4";
            $queryCit = mysqli_query($conn,$sqlCit);
            $resultCit = $conn -> query($sqlCit);
            while($rowCit = $resultCit->fetch_assoc()){
                echo'second.options.add(new Option("'.$rowCit['AsciiName'].'"));';
            }
            ?>
        }

        if(first.selectedIndex == 3)
        {
            <?php
            $sqlCou2 = "SELECT *, COUNT(*) FROM travelimage GROUP BY Country_RegionCodeISO ORDER BY COUNT(*) DESC LIMIT 2,2";
            $queryCou2 = mysqli_query($conn,$sqlCou2);
            $resultCou2 = $conn -> query($sqlCou2);

            $rowCou2 = $resultCou2->fetch_assoc();


            $sqlCou3 = "SELECT * FROM geocountries_regions WHERE ISO = '".$rowCou2['Country_RegionCodeISO']."'";
            $queryCou3 = mysqli_query($conn,$sqlCou3);
            $resultCou3 = $conn -> query($sqlCou3);
            $rowCou3= $resultCou3->fetch_assoc();

            $sqlCit = "SELECT * FROM `geocities` WHERE Country_RegionCodeISO= '".$rowCou3['ISO']."' ORDER BY Population DESC LIMIT 4";
            $queryCit = mysqli_query($conn,$sqlCit);
            $resultCit = $conn -> query($sqlCit);
            while($rowCit = $resultCit->fetch_assoc()){
                echo'second.options.add(new Option("'.$rowCit['AsciiName'].'"));';
            }
            ?>
        }

        if(first.selectedIndex == 4)
        {
            <?php
            $sqlCou2 = "SELECT *, COUNT(*) FROM travelimage GROUP BY Country_RegionCodeISO ORDER BY COUNT(*) DESC LIMIT 3,3";
            $queryCou2 = mysqli_query($conn,$sqlCou2);
            $resultCou2 = $conn -> query($sqlCou2);

            $rowCou2 = $resultCou2->fetch_assoc();


            $sqlCou3 = "SELECT * FROM geocountries_regions WHERE ISO = '".$rowCou2['Country_RegionCodeISO']."'";
            $queryCou3 = mysqli_query($conn,$sqlCou3);
            $resultCou3 = $conn -> query($sqlCou3);
            $rowCou3= $resultCou3->fetch_assoc();

            $sqlCit = "SELECT * FROM `geocities` WHERE Country_RegionCodeISO= '".$rowCou3['ISO']."' ORDER BY Population DESC LIMIT 4";
            $queryCit = mysqli_query($conn,$sqlCit);
            $resultCit = $conn -> query($sqlCit);
            while($rowCit = $resultCit->fetch_assoc()){
                echo'second.options.add(new Option("'.$rowCit['AsciiName'].'"));';
            }
            ?>
        }

        if(first.selectedIndex == 0)
        {
            second.options.add(new Option("请选择城市"));
        }
    }
</script>

<?php
 $servername ="localhost";
 $db_username="projectuser";
 $db_password="123456";
 $db_name="photos";
 $conn=new mysqli($servername,$db_username,$db_password,$db_name);

 if(empty($_GET["hotcountry"])&empty($_GET["hotcity"])&empty($_GET["hotcontent"])){
    $_GET["hotcountry"] = "Italy";
 }

 $num_rec_per_page=15;   // 每页显示数量
 if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
 $start_from = ($page-1) * $num_rec_per_page;

 $row0;
 $sql1;
if(!empty($_GET["hotcountry"])){
    //搜索热门国家
    $sql = "SELECT * FROM geocountries_regions WHERE Country_RegionName  = '".$_GET["hotcountry"]."'";
    $query = mysqli_query($conn,$sql);
    $result = $conn -> query($sql);
    $row = $result->fetch_assoc();

    $sql0 = "SELECT * FROM travelimage WHERE Country_RegionCodeISO  = '".$row['ISO']."'LIMIT $start_from, $num_rec_per_page ";
    $sql1 = "SELECT * FROM travelimage WHERE Country_RegionCodeISO  = '".$row['ISO']."'";
    $query0 = mysqli_query($conn,$sql0);
    $result0 = $conn -> query($sql0);
    }else if(!empty($_GET["hotcity"])){
    //搜索热门城市]
    $sql = "SELECT * FROM geocities WHERE AsciiName = '".$_GET["hotcity"]."'";
    $query = mysqli_query($conn,$sql);
    $result = $conn -> query($sql);
    $row = $result->fetch_assoc();

    $sql0 = "SELECT * FROM travelimage WHERE CityCode  = '".$row['GeoNameID']."'LIMIT $start_from, $num_rec_per_page ";
    $sql1 = "SELECT * FROM travelimage WHERE CityCode  = '".$row['GeoNameID']."'";
    $query0 = mysqli_query($conn,$sql0);
    $result0 = $conn -> query($sql0);
}
else if(!empty($_GET["hotcontent"])){
    //搜索热门内容
     $sql0 = "SELECT * FROM travelimage WHERE Content  = '".$_GET["hotcontent"]."'LIMIT $start_from, $num_rec_per_page ";
     $sql1 = "SELECT * FROM travelimage WHERE Content  = '".$_GET["hotcontent"]."'";
    $query0 = mysqli_query($conn,$sql0);
    $result0 = $conn -> query($sql0);
}

echo'<p class="line">';
echo'搜索结果 关键词：';
if(!empty($_GET["hotcountry"])){
    echo $_GET["hotcountry"];
}else if(!empty($_GET["hotcity"])){
    echo $_GET["hotcity"];
}else if(!empty($_GET["hotcontent"])){
    echo $_GET["hotcontent"];
}
echo'</p>';
echo'<div class="result">';
echo'<table>';
echo'<tr>';
//td
for($i=0;$i<5;$i++){
    $row0 = $result0->fetch_assoc();
    if(!empty($row0['ImageID'])&&!empty($row0['PATH'])){
    echo'<td><a href="introduction.php?ImageID='.$row0['ImageID'].'"><img width="150px" height="150px" title="'.$row0['Title'].'" src="travel-images/normal/medium/'.$row0['PATH'].'"></a></td>';
    }else if(!empty($row0['ImageID'])&&empty($row0['PATH'])){
    echo'<td><a href="introduction.php?ImageID='.$row0['ImageID'].'"><img title="'.$row0['Title'].'" src="travel-images/square/square-medium/none.png"></a></td>';
    }
}
echo'</tr>';
echo'<tr>';
//td
for($i=0;$i<5;$i++){
    $row0 = $result0->fetch_assoc();
    if(!empty($row0['ImageID'])&&!empty($row0['PATH'])){
        echo'<td><a href="introduction.php?ImageID='.$row0['ImageID'].'"><img width="150px" height="150px" title="'.$row0['Title'].'" src="travel-images/normal/medium/'.$row0['PATH'].'"></a></td>';
    }else if(!empty($row0['ImageID'])&&empty($row0['PATH'])){
    echo'<td><a href="introduction.php?ImageID='.$row0['ImageID'].'"><img title="'.$row0['Title'].'" src="travel-images/square/square-medium/none.png"></a></td>';
    }
}
echo'</tr>';
echo'<tr>';
//td
for($i=0;$i<5;$i++){
    $row0 = $result0->fetch_assoc();
    if(!empty($row0['ImageID'])&&!empty($row0['PATH'])){
        echo'<td><a href="introduction.php?ImageID='.$row0['ImageID'].'"><img width="150px" height="150px" title="'.$row0['Title'].'" src="travel-images/normal/medium/'.$row0['PATH'].'"></a></td>';
    }else if(!empty($row0['ImageID'])&&empty($row0['PATH'])){
    echo'<td><a href="introduction.php?ImageID='.$row0['ImageID'].'"><img title="'.$row0['Title'].'" src="travel-images/square/square-medium/none.png"></a></td>';
    }
}
echo'</tr>';
echo'</table>';
echo'</div>';

$rs_result = mysqli_query($conn,$sql1); //查询数据
$total_records = mysqli_num_rows($rs_result);// 统计总共的记录条数
$total_pages = ceil($total_records / $num_rec_per_page);  // 计算总页数
if($total_pages > 5){
    $total_pages = 5;
}

if($result1->num_rows > 0){
echo "<div  class='change'>";
if($page != 1){
    if(!empty($_GET["hotcountry"])){
    echo "<a href='browser.php?page=".($page - 1)."&hotcountry=".$_GET["hotcountry"]."'>".'上一页'."</a> "; }else if(!empty($_GET["hotcity"])){
        echo "<a href='browser.php?page=".($page - 1)."&hotcity=".$_GET["hotcity"]."'>".'上一页'."</a> ";
    }else if(!empty($_GET["hotcontent"])){
        echo "<a href='browser.php?page=".($page - 1)."&hotcontent=".$_GET["hotcontent"]."'>".'上一页'."</a> ";
    }// 上一页
}
for ($i=1; $i<=$total_pages; $i++) {
    if(!empty($_GET["hotcountry"])){
    echo "<a href='browser.php?page=".$i."&hotcountry=".$_GET["hotcountry"]."'>".$i."</a> "; }else if(!empty($_GET["hotcity"])){
        echo "<a href='browser.php?page=".$i."&hotcity=".$_GET["hotcity"]."'>".$i."</a> ";
    }else if(!empty($_GET["hotcontent"])){
        echo "<a href='browser.php?page=".$i."&hotcontent=".$_GET["hotcontent"]."'>".$i."</a> ";
    }
};
if($page != $total_pages&&$page != 1){
    if(!empty($_GET["hotcountry"])){
    echo "<a href='browser.php?page=".($page + 1)."&hotcountry=".$_GET["hotcountry"]."'>".'下一页'."</a> "; }else if(!empty($_GET["hotcity"])){
        echo "<a href='browser.php?page=".($page + 1)."&hotcity=".$_GET["hotcity"]."'>".'下一页'."</a> ";
    }else if(!empty($_GET["hotcontent"])){
        echo "<a href='browser.php?page=".($page + 1)."&hotcontent=".$_GET["hotcontent"]."'>".'下一页'."</a> ";
    }// 下一页
echo "</div>";
}
}
?>

<p id="footer">虚空备案号：19302016001</p>
</body>
</html>