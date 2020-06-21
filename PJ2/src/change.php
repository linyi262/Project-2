<?php
if($_POST['second']=="请选择城市"){
    header("location:Upload.php");
}

$conn=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
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
    && ($_FILES["file"]["size"] < 20480000)
    && in_array($extension, $allowedExts)){
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        //删除原先的照片
        $path0 =  "../img/normal/medium";

        $sqlPATH = "SELECT * FROM travelimage WHERE ImageID=".$_GET['ImageID'];
        $queryPATH = mysqli_query($conn,$sqlPATH);
        $resultPATH = $conn -> query($sqlPATH);
        $rowPATH = $resultPATH->fetch_assoc();

        $file = $rowPATH['PATH'];
        echo $file;

        if(file_exists($path0)){
            echo'yes';
            $res=unlink($path0.'/'.$file);
            if($res){
                echo'成功删除文件';
            }else{
                echo'删除文件失败<a href="photo.php">点击重试</a>';
            }
        }else{
            echo'没有找到文件目录<a href="photo.php">点击重试</a>';
        }



        echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
        echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
        echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";

        // 判断当前目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        if (file_exists("../travel-images/small/" . $_FILES["file"]["name"]))
        {
            echo $_FILES["file"]["name"] . " 文件已经存在。 ";
        }
        else
        {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            move_uploaded_file($_FILES["file"]["tmp_name"], "../travel-images/small/" . $_FILES["file"]["name"]);
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
                $sqlChange = "UPDATE `travelimage` SET `Title`='".$title."',`Description`='".$description."',`CityCode`='".$cityCode."',`CountryCodeISO`='".$country_RegionCodeISO."',`Content`='".$content."',`PATH`='".$PATH."' WHERE ImageID=".$_GET['ImageID'];
                $queryChange = mysqli_query($conn,$sqlChange);
                echo $sqlChange;
                header('location:MyPhoto.php');
            }else{
                $sqlChange = "UPDATE `travelimage` SET `Title`='".$title."',`Description`= NULL,`CityCode`='".$cityCode."',`CountryCodeISO`='".$country_RegionCodeISO."',`Content`='".$content."',`PATH`='".$PATH."' WHERE ImageID=".$_GET['ImageID'];
                $queryChange = mysqli_query($conn,$sqlChange);
                echo $sqlChange;
                header('location:MyPhoto.php');
            }
            echo'修改成功';
        }
    }
}
else{
    echo "非法的文件格式";
    if(!empty($_POST['description'])){
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

        $description = $_POST['description'];

        $sqlChange = "UPDATE `travelimage` SET `Title`='".$title."',`Description`='".$description."',`CityCode`='".$cityCode."',`CountryCodeISO`='".$country_RegionCodeISO."',`Content`='".$content."' WHERE ImageID=".$_GET['ImageID'];
        $queryChange = mysqli_query($conn,$sqlChange);
        header('location:MyPhoto.php');
    }else{
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

        $sqlChange = "UPDATE `travelimage` SET `Title`='".$title."',`Description`= NULL,`CityCode`='".$cityCode."',`CountryCodeISO`='".$country_RegionCodeISO."',`Content`='".$content."' WHERE ImageID=".$_GET['ImageID'];
        $queryChange = mysqli_query($conn,$sqlChange);
        echo $sqlChange;
        header('location:MyPhoto.php');
    }
}
?>