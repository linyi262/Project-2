<?php
require_once('../src/config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UpLoad</title>
    <link href="../CSS/UpLoad.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="header">
    <div class="lift">
        <a href="../index.php" class="target" >Home</a>
        <a href="Browse.php" class="target" >Browse</a>
        <a href="Search.php" class="target">Search</a>
    </div>

    <div class="dropdown" style="float:right;">
        <button class="dropbtn">My account ▼</button>
        <div class="dropdown-content">
            <a href="MyPhoto.php">My Photo</a>
            <a href="My%20Favourite.php">My Favorite</a>
            <a href="UpLoad.php" style="background-color: lightpink">Upload</a>
            <a href="../index.php">Log In</a>
        </div>

    </div>
</div>


<form method="POST"  class="form" action="<?php

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
                echo'<img width="340px" src="" id="up-img">';
            }else{

                $conn=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);

                $sql = "SELECT * FROM travelimage WHERE ImageID=" .$_GET['ImageID'];
                $query = mysqli_query($conn,$sql);
                $result = $conn -> query($sql);
                $row = $result->fetch_assoc();

                echo'<img id="up-img" width="640px" src="travel-images/small/'.$row['PATH'].'">';
            }
            ?>

            <br>

            <br>
            <button class="copy">
                <input type="file" id="uploadadd" onchange="upload(this)" name="file">
            </button>
            <p style="font-size: 20px;font-family: 'Agency FB';background: #da9796">图片标题</p>
            <input type="text" name="name" <?php if(!empty($row)){echo'value = "'.$row['Title'].'"';}?> pattern="[A-Z | a-z | 0-9 |_]*" title="大小写字母、数字、下划线" required>
            <br>
            <p style="font-size: 20px;font-family: 'Agency FB';background: #da9796">拍摄地点</p>

            <?php

            $conn=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);

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

            <p style="font-size: 20px;font-family: 'Agency FB';background: #da9796">主题</p>
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

            <p style="font-size: 20px;font-family: 'Agency FB';background: #da9796">图片描述</p>
            <textarea  rows="6" cols="80" name="description"><?php if(!empty($row)){echo $row['Description'];}?></textarea>
            <br>
            <input class="up-btn" style="text-align:center;background: khaki;width: 100px;height: 50px;font-size: 20px"type="submit" value="<?php if(!empty($row)){echo '修改';}else{echo'上传';} ?>">
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


<div class="footer" >
    Copyright@ 2020-2021 ############################  备案号：19302010054</div>
</body>

<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>

</html>