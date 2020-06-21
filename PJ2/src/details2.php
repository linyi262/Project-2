<?php

require_once('config.php');

/*
 Displays a list of genres
*/

try {
   $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $sql = 'select * from travelimage where ImageID=:id';;
   $id = $_GET['id'];
   $statement = $pdo->prepare($sql);
   $statement->bindValue(':id', $id);
   $statement->execute();

   $row = $statement->fetch(PDO::FETCH_ASSOC);
   $pdo = null;
}
catch (PDOException $e) {
   die( $e->getMessage() );
}
function AddToFa(){}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapter 14</title>
    <link href=" ../CSS/details.css" rel="stylesheet">
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
            <a href="UpLoad.php">Upload</a>
            <a href="Login.php">Log In</a>
        </div>
    </div>
</div>


<table class="details" >
    <tr>
        <th id="d-top">Details</th>
    </tr>
    <tr>
        <td> <h1 style="text-align: center"><?php echo $row['Title']; ?></h1></td>
    </tr>
    <tr>
        <td style="height: 600px;">
            <img src="../travel-images/small/<?php echo $row['PATH']; ?>"
                 style=" display: block;width: 70%;height: 100%;margin-left: 15%" >
        </td>
    </tr>
    <tr>

        <th>Latitude</th>
    </tr>
    <tr>
        <td style="font-size: 30px;text-align: center;">
            <?php echo $row['Latitude']; ?>
        </td>
    </tr>
    <tr>
        <th>
            Longitude
        </th>
    </tr>
    <tr>
        <td style="font-size: 30px;text-align: center">
            <?php echo $row['Longitude']; ?>
        </td>
    </tr>
    <tr>
        <th>
            Country
        </th>
    </tr>
    <tr>
        <td style="font-size: 30px;text-align: center">
            <?php echo $row['CountryCodeISO']; ?>
        </td>
    </tr>
    <tr>
        <th>
            Camerist ID
        </th>
    </tr>
    <tr>
        <td style="font-size: 30px;text-align: center">
           <?php echo $row['UID']; ?>
        </td>
    </tr>

    <tr>
        <th style="background-color: lightgray">Description</th>
    </tr>
    <tr>
        <td>
            <P class="wen"><?php echo $row['Description']; ?></P>
        </td>
    </tr>
    <tr>
        <td>
            <span id="myspan" style="color:deepskyblue;font-size: 40px;">喜欢吗？赶紧收藏起来</span>
            <button class="D-btn" onblur="<?php AddToFa();?>" onclick="AddToFA()">Add To Favourite </button>
        </td>
    </tr>

</table>


</body>
</html>
<script src="../JS/details.js"></script>
