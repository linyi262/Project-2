<?php
require_once('config.php');

function outputGenres() {
try {
$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'select * from travelimage where ImageID=:dd';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':dd', rand(1,25));
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    outputSingleGenre( $row);
    $pdo = null;
}
catch (PDOException $e) {
die( $e->getMessage() );}
}

function outputSingleGenre($row) {
echo '<div class="card">';
    echo '<div class="image">';
        $img = '<img src="travel-images/small/' .$row['PATH'] .'">';
        echo  constructPICLink($row['ImageID'],$img);
        echo '</div>';
    echo '<div class="extra">';
        echo '<h4 style="font-size: 20px">';
    echo $row['Title'];
            echo '</h4>';
        echo '</div>';
        echo '<div class="des">';
        echo $row['Description'];
    echo '</div>';
    echo '</div>';
}

function constructPICLink($id, $label) {
    $link = '<a href="src/details2.php?id=' . $id . '">';
    $link .= $label;
    $link .= '</a>';
    return $link;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="CSS/Home.css" rel="stylesheet" type="text/css" >
    <script>
        function refresh() {
            alert("图片已经刷新！")
        }
    </script>
</head>
<body>
<div class="header">
    <div class="lift">
        <a href="index.php" class="target" style="color: yellow ">Home</a>
        <a href="src/Browse.php" class="target">Browse</a>
        <a href="src/Search.php" class="target">Search</a>
    </div>
    <div class="dropdown" style="float:right;">
        <div class="dropbtn">
            <a href="src/Login.php">Login</a>
        </div>
    </div>
</div>
<div class="toppic">
    <table>
        <tr>
            <th>
            <img src="img/logo.jpg">
            </th>
            <th>
                <p style=" font-size: 2vw;color:goldenrod;font-family: 'Ink Free'; sans-serif;">
                    Go outside and see the world!!
                <p style="font-size: 3vw;color:palevioletred;font-family: 'Ink Free;">Sharingtrip<p/>
                </p>
            </th>
            <th>
                <img src="img/logo1.jpg">
            </th>
        </tr>

    </table>
</div>

<div class="hottopic">

        <table>
            <tr>
            <th style="font-size: 35px;font-family:'Agency FB';text-align: center;background: #da9796;">PHOTO RECOMMENDATION</th>
            </tr>
            <tr>
                <th> <?php outputGenres(); ?></th>
                <th> <?php outputGenres(); ?></th>
                <th> <?php outputGenres(); ?></th>
                <th> <?php outputGenres(); ?></th>
            </tr>
            <tr>
                <th> <?php outputGenres(); ?></th>
                <th> <?php outputGenres(); ?></th>
                <th> <?php outputGenres(); ?></th>
                <th> <?php outputGenres(); ?></th>
            </tr>
        </table>
    <div/>


    <aside>
        <a href="javascript:scrollTo(0,0);"><button class="right-btn">UP</button></a> <br>
        <button class="right-btn">Refresh </button>
    </aside>


</body>
</html>