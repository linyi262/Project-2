<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>details</title>
    <link href="../CSS/details.css" rel="stylesheet" type="text/css">
<script>
    function like() {
        alert("图片已加入“我的收藏”")
    }
</script>
</head>
<body>

<div class="header">
    <div class="lift">
        <a href="index.html" class="target" >Home</a>
        <a href="Browse.html" class="target" >Browse</a>
        <a href="Search.html" class="target">Search</a>
    </div>

    <div class="dropdown" style="float:right;">
        <button class="dropbtn">My account ▼</button>

        <div class="dropdown-content">
            <a href="MyPhoto.html">My Photo</a>
            <a href="My%20Favourite.html">My Favorite</a>
            <a href="UpLoad.html">Upload</a>
            <a href="../index.html">Log In</a>
        </div>
    </div>
</div>

<table class="details" >
    <tr>
        <th id="d-top">Details</th>
    </tr>
    <tr>
        <td style="text-align: center;font-size: 30px">田园风光 by Tammy</td>
    </tr>
    <tr>
        <td style="height: 600px;">
  <img src="../img/detail).jpg" style=" display: block;width: 70%;height: 100%;margin-left: 15%" >
        </td>
    </tr>
    <tr>

            <th>Like Number</th>

    </tr>
    <tr>
        <td style="font-size: 30px;text-align: center;color: orangered">
            99
        </td>
    </tr>
    <tr>
        <th>
            Image Details
        </th>
    </tr>
    <tr>
        <td style="font-size: 30px;text-align: center">
            Content:Senery
        </td>
    </tr>
    <tr>
        <td style="font-size: 30px;text-align: center">
            Country:England
        </td>
    </tr>
    <tr>
        <td style="font-size: 30px;text-align: center">
            City:London
        </td>
    </tr>

<tr>
    <td>
            <button class="D-btn" onclick="like()">Like </button>
    </td>
</tr>
    <tr>
        <th style="background-color: lightgray">Description</th>
    </tr>
    <tr>
    <td>
            <P class="wen">This is a rural life scene.
                In front of it is an open field with golden crops.
                In the distance, there is a forest.
                The trees are covered with golden leaves.
                It can be seen that autumn is coming.
                Farmers are using harvesters to harvest crops in the field.
                In front of them is a green vegetation.
                It can be seen that it is the end of summer and the beginning of autumn.
                At the end of the field stand several windmills It's turning with the wind to generate electricity.
                Ah, it makes the Buddha stay in the Netherlands.
                In the windmill Kingdom, there are a few wisps of white clouds floating in the sky, as if it's sunny after the rain.
                It's really beautiful. It's a paradise of the world.</P>
        </td>
    </tr>

</table>





<div id="footer" style="clear:both;text-align:left;">
    Copyright@ 2019-2021 ############################  备案号：19302010054</div>


</body>
</html>