<?php

if($_POST['second']=="请选择城市"){
    header("location:Upload.php");
}

// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 20480000)   // 小于 20000 kb
&& in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
        echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
        echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
        
        // 判断当前目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("../travel-images/samll/" . $_FILES["file"]["name"]))
        {
            echo $_FILES["file"]["name"] . " 文件已经存在。 ";
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "../travel-images/samll/" . $_FILES["file"]["name"]);
            echo "文件存储在: " . "../travel-images/small/" . $_FILES["file"]["name"];
            //为表格添加列
            $conn=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
            $title = $_POST['name'];
            $city = $_POST['second'];
            $sqlCityCode = "SELECT * FROM `geocities` WHERE AsciiName = '".$city."'";
            $queryCityCode = mysqli_query($conn,$sqlCityCode);
            $resultCityCode = $conn -> query($sqlCityCode);
            $rowCityCode = $resultCityCode->fetch_assoc();
            $cityCode = $rowCityCode['GeoNameID'];
            $country_RegionCodeISO = $rowCityCode['Country_RegionCodeISO'];

            $sqlUID = "SELECT * FROM `traveluser` WHERE UserName = '".$_SESSION['user']."'";
            $queryUID = mysqli_query($conn,$sqlUID);
            $resultUID = $conn -> query($sqlUID);
            $rowUID = $resultUID->fetch_assoc();
            $UID = $rowUID['UID'];

            $PATH = $_FILES["file"]["name"];
            $content = $_POST['topic'];


            if(!empty($_POST['description'])){
                $description = $_POST['description'];
                $sqlUP = "INSERT INTO `travelimage`(`Title`, `Description`, `CityCode`, `CountryCodeISO`, `UID`, `PATH`, `Content`) VALUES ('".$title."','".$description."','".$cityCode."','".$country_RegionCodeISO."','".$UID."','".$PATH."','".$content."')";
                $queryUP = mysqli_query($conn,$sqlUP);
            }else{
                $description = $_POST['description'];
                $sqlUP = "INSERT INTO `travelimage`(`Title`, `CityCode`, `CountryCodeISO`, `UID`, `PATH`, `Content`) VALUES ('".$title."','".$cityCode."','".$country_RegionCodeISO."','".$UID."','".$PATH."','".$content."')";
                $queryUP = mysqli_query($conn,$sqlUP);
            }
            header('location:MyPhoto.php');
        }
    }
}
else
{
    echo "非法的文件格式";
}
?>