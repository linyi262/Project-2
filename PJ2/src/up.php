<!DOCTYPE html>
<html>
<head>
    <title>上传-云驿图片站</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/upload.css">
</head>
<body>
<ul class="nav">
    <li><a href="..\index.php">首页</a></li>
    <li><a href="browser.php">浏览页</a></li>
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
        echo '<a class="active" href="upload.php"><img src="..\img\icon\shangchuan.png" width="25" height="25">上传</a>';
        echo '<a href="photo.php"><img src="..\img\icon\tupian.png" width="25" height="25">我的图片</a>';
        echo '<a href="like.php"><img src="..\img\icon\shoucang.png" width="25" height="25">我的收藏</a>';
        echo ' <a href="logout.php"><img src="..\img\icon\denglu-copy.png" width="25" height="25">登出</a>';
        echo '</div>';

    }
    ?>
    </div>
</ul>

<form method="POST" action="<?php

if(!empty($_GET['ImageID'])){
    echo'change.php?ImageID='.$_GET['ImageID'];
}else{
    echo'uploadFile.php';
}

?>" enctype="multipart/form-data">
    <table cellpadding="20px">
        <td>
            <?php
            if(empty($_GET['ImageID'])){
                echo'<p id="tip">图片未上传</p>';
                echo'<img width="640px" src="" id="uploadimg">';
            }else{
                $servername ="localhost";
                $db_username="projectuser";
                $db_password="123456";
                $db_name="photos";
                $conn=new mysqli($servername,$db_username,$db_password,$db_name);

                $sql = "SELECT * FROM travelimage WHERE ImageID=" .$_GET['ImageID'];
                $query = mysqli_query($conn,$sql);
                $result = $conn -> query($sql);
                $row = $result->fetch_assoc();

                echo'<img id="uploadimg" width="640px" src="../img/normal/medium/'.$row['PATH'].'">';
            }
            ?>

            <br>

            <br>
            <button class="copy">
                <input type="file" id="uploadadd" onchange="upload(this)" name="file">
            </button>
            <p>图片标题</p>
            <input type="text" name="name" <?php if(!empty($row)){echo'value = "'.$row['Title'].'"';}?> pattern="[A-Z | a-z | 0-9 |_]*" title="大小写字母、数字、下划线" required>
            <br>
            <p>拍摄地点</p>

            <?php
            $servername ="localhost";
            $db_username="projectuser";
            $db_password="123456";
            $db_name="photos";
            $conn=new mysqli($servername,$db_username,$db_password,$db_name);

            $sqlCou = "SELECT *, COUNT(*) FROM travelimage GROUP BY Country_RegionCodeISO ORDER BY COUNT(*) DESC LIMIT 4";
            $queryCou = mysqli_query($conn,$sqlCou);
            $resultCou = $conn -> query($sqlCou);
            ?>

            <select id="first" name="first" onChange="nextChange()">
                <option selected="selected"><?php
                    if(!empty($row)){
                        $sqlCouName = "SELECT * FROM geocountries_regions WHERE ISO='".$row['Country_RegionCodeISO']."'";
                        $queryCouName = mysqli_query($conn,$sqlCouName);
                        $resultCouName = $conn -> query($sqlCouName);
                        $rowCouName = $resultCouName->fetch_assoc();
                        echo $rowCouName['Country_RegionName'];
                    }else{
                        echo'请选择国家';
                    }
                    ?></option>
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
                <option selected="selected"><option selected="selected"><?php
                    if(!empty($row)){
                        $sqlCitName = "SELECT * FROM geocities WHERE GeoNameID='".$row['CityCode']."'";
                        $queryCitName = mysqli_query($conn,$sqlCitName);
                        $resultCitName = $conn -> query($sqlCitName);
                        $rowCitName = $resultCitName->fetch_assoc();
                        echo $rowCitName['AsciiName'];
                    }else{
                        echo'请选择城市';
                    }
                    ?></option>
            </select>

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

            <p>主题</p>
            <select name="topic" require>
                <?php
                if(!empty($row)){
                    echo '<option>'.$row['Content'].'</option>';
                }
                ?>
                <option>scenery</option>
                <option>city</option>
                <option>people</option>
                <option>animal</option>
                <option>building</option>
                <option>wonder</option>
                <option>other</option>
            </select>

            <p>图片描述</p>
            <textarea  rows="6" cols="80" name="description"><?php if(!empty($row)){echo $row['Description'];}?></textarea>
            <br>
            <input class="bigbutton" style="text-align:center" type="submit" value="<?php if(!empty($row)){echo '修改';}else{echo'上传';} ?>">
        </td>
    </table>
</form>

<script>
    function upload(obj) {

        var file = obj.files[0];
        console.log("file.size = " + file.size);

        var reader = new FileReader();
        reader.onloadstart = function (e) {
            console.log("开始读取....");
        }
        reader.onprogress = function (e) {
            console.log("正在读取中....");
        }
        reader.onabort = function (e) {
            console.log("中断读取....");
        }
        reader.onerror = function (e) {
            console.log("读取异常....");
        }
        reader.onload = function (e) {
            console.log("成功读取....");
            var img = document.getElementById("uploadimg");
            img.src = e.target.result;
        }
        reader.readAsDataURL(file)
        var obj = document.getElementById("tip");
        obj.remove();
    }

</script>




<p class="footer">虚空备案号：19302016001</p>
</body>
</html>