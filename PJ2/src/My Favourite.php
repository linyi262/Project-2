<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Favourite</title>
    <link href="../CSS/MyFav.css" rel="stylesheet" type="text/css">
    <script>
        function Delete()
        {
            alert("该图片已从“我的收藏”中删除");
        }
    </script>
</head>
<body>
<div class="header">
    <div class="lift">
        <a href="Home.html" class="target" >Home</a>
        <a href="Browse.html" class="target" >Browse</a>
        <a href="Search.html" class="target">Search</a>
    </div>

    <div class="dropdown" style="float:right;">
        <button class="dropbtn">My account ▼</button>

        <div class="dropdown-content">
            <a href="MyPhoto.html">My Photo</a>
            <a href="My%20Favourite.html" style="background-color: lightpink">My Favorite</a>
            <a href="UpLoad.html">Upload</a>
            <a href="../index.html">Log In</a>
        </div>
    </div>
</div>
<table class="fav">

    <tr>
        <th>My Favourites</th>
    </tr>

    <tr>
        <td>
            <a href="details.html"><img src="../img/detail).jpg" class="image" alt=""></a>
            <table class="inner">
                <tr>
                    <th>Title</th>
                </tr>

                <tr>
                    <td>
                        <div class="centent">
                            Provence is a former Roman province and is now a region of southeastern France,
                            located on the Mediterranean Sea adjacent to France's border with Italy.
                            It is now part of the administrative région of Provence-Alpes-Côte d'Azur.
                            The traditional region of Provence encompasses the départements of Var, Vaucluse,
                            and Bouches-du-Rhône in addition to parts of Alpes-de-Haute-Provence and Alpes-Maritimes.
                            History： Provence has been inhabited since prehistoric times. It was known
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>
                            <button class="btn" onclick="Delete()">Delete</button>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <a href="details.html"><img src="../img/fav1.jpg" class="image" alt=""></a>
            <table class="inner">
                <tr>
                    <th>Title</th>
                </tr>

                <tr>
                    <td>
                        <div class="centent">
                            Provence is a former Roman province and is now a region of southeastern France,
                            located on the Mediterranean Sea adjacent to France's border with Italy.
                            It is now part of the administrative région of Provence-Alpes-Côte d'Azur.
                            The traditional region of Provence encompasses the départements of Var, Vaucluse,
                            and Bouches-du-Rhône in addition to parts of Alpes-de-Haute-Provence and Alpes-Maritimes.
                            History： Provence has been inhabited since prehistoric times. It was known
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>
                            <button class="btn" onclick="Delete()">Delete</button>
                        </div>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
    <tr>
        <td>
            <a href="details.html"><img src="../img/fav2.jpg" class="image" alt=""></a>
            <table class="inner">
                <tr>
                    <th>Title</th>
                </tr>

                <tr>
                    <td>
                        <div class="centent">
                            Provence is a former Roman province and is now a region of southeastern France,
                            located on the Mediterranean Sea adjacent to France's border with Italy.
                            It is now part of the administrative région of Provence-Alpes-Côte d'Azur.
                            The traditional region of Provence encompasses the départements of Var, Vaucluse,
                            and Bouches-du-Rhône in addition to parts of Alpes-de-Haute-Provence and Alpes-Maritimes.
                            History： Provence has been inhabited since prehistoric times. It was known。
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>
                            <button class="btn" onclick="Delete()">Delete</button>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <a href="details.html"><img src="../img/fav3.jpg" class="image" alt=""></a>
            <table class="inner">
                <tr>
                    <th>Title</th>
                </tr>

                <tr>
                    <td>
                        <div class="centent">
                            Provence is a former Roman province and is now a region of southeastern France,
                            located on the Mediterranean Sea adjacent to France's border with Italy.
                            It is now part of the administrative région of Provence-Alpes-Côte d'Azur.
                            The traditional region of Provence encompasses the départements of Var, Vaucluse,
                            and Bouches-du-Rhône in addition to parts of Alpes-de-Haute-Provence and Alpes-Maritimes.
                            History： Provence has been inhabited since prehistoric times. It was known
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>
                            <button class="btn" onclick="Delete()">Delete</button>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td class="span" style="text-align: center;font-size: 20px">
            <<span style="color: dodgerblue;font-size: 30px">1</span> 2 3 4 5 6 ... 9 >
        </td>
    </tr>
</table>
<div class="footer" >
    Copyright@ 2019-2021 ############################  备案号：19302010054</div>
</body>
</html>