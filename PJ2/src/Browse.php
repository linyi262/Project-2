<?php
require_once('../src/config.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse</title>
    <link rel="stylesheet" href="../CSS/Browse.css">
    <link rel="stylesheet" href="../CSS/nav.css">

</head>
<body>
<div class="header">
    <div class="lift">
        <a href="../index.php" class="target" style="color: yellow ">Home</a>
        <a href="Browse.php" class="target">Browse</a>
        <a href="Search.php" class="target">Search</a>
    </div>
    <div class="dropdown" style="float:right;">
        <div class="dropbtn">
            <a href="Login.php">Login</a>
        </div>
    </div>
</div>


<div class="container">
    <div class="row" style="float: left;margin-left: -100px">
        <div class="col-3" style="min-height: 840px">
            <div class="card w-100">
                <form action="" method="get">

                    <div class="card-header">
                        <label for="flt-tit">Search by title</label>
                    </div>

                    <div class="input-group">
                        <input type="text" name="thm" style="display: none">
                        <input type="text" name="ctr" style="display: none">
                        <input type="text" name="cty" style="display: none">
                        <input type="text" class="form-control" placeholder="" id="tit" name="tit">
                        <div class="input-group-append">
                            <button type="submit" class="input-group-text">search</button>
                        </div>
                    </div>
                </form>
            </div>
            <br><br>
            <div class="card w-100" >
                <div class="card-header">Hot Content</div>
                <div class="card-body text-left">
                    <?php
                    try {
                        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = 'SELECT Content, count( * ) AS count FROM travelimage GROUP BY Content ORDER BY count DESC limit 3';
                        $result = $pdo->query($sql);
                        for ($j = 0; $j < 2; $j++) {
                            $row = $result->fetch(PDO::FETCH_ASSOC);
                            echo "<span value=\"" . $row['Content'] . "\" onclick = \"";
                            echo "document . getElementById('thm') . value = '" . $row['Content'] . "';";
                            echo "document.getElementById('hiddenForm').submit(); \">" . $row['Content'] . "</span><hr>";
                        }
                        $row = $result->fetch(PDO::FETCH_ASSOC);
                        echo "<span value=\"" . $row['Content'] . "\" onclick = \"";
                        echo "document . getElementById('thm') . value = '" . $row['Content'] . "';";
                        echo "document.getElementById('hiddenForm').submit(); \">" . $row['Content'] . "</span>";
                    } catch (PDOException $e) {
                        die($e->getMessage());
                    }
                    ?>
                </div>
            </div>
            <br><br>
            <div class="card w-100">
                <div class="card-header">Hot Country or Region</div>
                <div class="card-body text-left">
                    <?php
                    try {
                        $sql = 'SELECT CountryCodeISO, count( * ) AS count FROM travelimage GROUP BY CountryCodeISO ORDER BY count DESC limit 3';
                        $result = $pdo->query($sql);

                        for ($j = 0; $j < 2; $j++) {
                            $row = $result->fetch(PDO::FETCH_ASSOC);
                            echo "<span value=\"" . $row['CountryCodeISO'] . "\" onclick = \"";
                            echo "document . getElementById('ctr') . value = '" . $row['CountryCodeISO'] . "';";
                            echo "document.getElementById('hiddenForm').submit(); \">" . $row['CountryCodeISO'] . "</span><hr>";
                        }
                        $row = $result->fetch(PDO::FETCH_ASSOC);
                        echo "<span value=\"" . $row['CountryCodeISO'] . "\" onclick = \"";
                        echo "document . getElementById('ctr') . value = '" . $row['CountryCodeISO'] . "';";
                        echo "document.getElementById('hiddenForm').submit(); \">" . $row['CountryCodeISO'] . "</span>";
                    } catch (PDOException $e) {
                        die($e->getMessage());
                    }
                    ?>
                </div>
            </div>
            <br><br>
            <div class="card w-100">
                <div class="card-header">Hot City</div>
                <div class="card-body text-left">
                    <?php
                    try {
                        $sql = 'SELECT CityCode, count( * ) AS count FROM travelimage GROUP BY CityCode ORDER BY count DESC limit 3';
                        $result = $pdo->query($sql);

                        for ($j = 0; $j < 2; $j++) {
                            $row = $result->fetch(PDO::FETCH_ASSOC);
                            echo "<span value=\"" . $row['CityCode'] . "\" onclick = \"";
                            echo "document . getElementById('cty') . value = '" . $row['CityCode'] . "';";
                            echo "document.getElementById('hiddenForm').submit(); \">" . $row['CityCode'] . "</span><hr>";
                        }
                        $row = $result->fetch(PDO::FETCH_ASSOC);
                        echo "<span value=\"" . $row['CityCode'] . "\" onclick = \"";
                        echo "document . getElementById('cty') . value = '" . $row['CityCode'] . "';";
                        echo "document.getElementById('hiddenForm').submit(); \">" . $row['CityCode'] . "</span>";
                        $pdo = null;
                    } catch (PDOException $e) {
                        die($e->getMessage());
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-9 bg-light" style="border-radius: 20px;min-height: 840px">
            <p class="text-muted" style="height: 2em">&nbsp;Filter</p>
            <form>
                <select class="form-control" name="thm" id="slt-thm">
                    <?php
                    if (isset($_GET['ed-thm']) && $_GET['ed-thm'] != "")
                        echo '<option value="' . $_GET['ed-thm'] . '" selected>' . $_GET['ed-thm'] . '</option>';
                    elseif ($_GET['ed-thm'] == "") echo '<option value="" selected disabled>choose content</option>';
                    else echo '<option value="" selected disabled>choose content</option>';
                    ?>
                    <option value="scenery"> scenery</option>
                    <option value="city"> city</option>
                    <option value="people"> people</option>
                    <option value="animal"> animal</option>
                    <option value="building"> building</option>
                    <option value="wonder"> wonder</option>
                    <option value="other"> other</option>
                </select>
                &nbsp;&nbsp;
                <select class="form-control" name="img-ctr" id="slt-ctr" onchange="
                    document.getElementById('ed-thm').value = document.getElementById('slt-thm').value;
                    document.getElementById('ed-ctr').value = document.getElementById('slt-ctr').value;
                    document.getElementById('hidden').submit();">
                    <?php
                    if (isset($_GET['ed-ctr']))
                        echo '<option value="' . $_GET['ed-ctr'] . '" selected>' . $_GET['ed-ctr'] . '</option>';
                    else echo '<option value="" selected disabled>choose country or region</option>';
                    try {
                        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = 'SELECT * FROM `geocountries` ORDER BY `geocountries`.`Population` DESC limit 75';
                        $result = $pdo->query($sql);

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . $row['CountryName'] . '">' . $row['CountryName'] . '</option>';
                        }
                        $pdo = null;
                    } catch (PDOException $e) {
                        die($e->getMessage());
                    }
                    ?>
                </select>
                &nbsp;&nbsp;
                <select class="form-control" name="img-cty" id="slt-cty">
                    <option value="" selected disabled>choose city</option>
                    <?php
                    if (isset($_GET['ed-ctr'])) {
                        try {
                            $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "SELECT ISO FROM `geocountries` where CountryName = '" . $_GET['ed-ctr'] . "' limit 1";
                            $result1 = $pdo->query($sql);
                            $row = $result1->fetch(PDO::FETCH_ASSOC);
                            $ctr = $row['ISO'];
                            $sql = "SELECT * FROM `geocities` where CountryCodeISO = '$ctr' ORDER BY `geocities`.`Population` DESC LIMIT 160";
                            $result = $pdo->query($sql);

                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="' . $row['AsciiName'] . '">' . $row['AsciiName'] . '</option>';
                            }
                            $pdo = null;
                        } catch (PDOException $e) {
                            die($e->getMessage());
                        }
                    }
                    ?>
                </select>
                <button type="button" class="btn btn-primary btn-block" style="margin-top: 1%"
                        onclick="document.getElementById('tit').value = '';
document.getElementById('thm').value = document.getElementById('slt-thm').value;
document.getElementById('ctr').value = document.getElementById('slt-ctr').value;
document.getElementById('cty').value = document.getElementById('slt-cty').value;
document.getElementById('hiddenForm').submit();">Filter
                </button>
            </form>
            <br>
            <div class="d-flex flex-wrap align-content-center ">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET"){
                $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if (empty($_GET['tit']) && empty($_GET['thm']) && empty($_GET['ctr']) && empty($_GET['cty'])) {
                    $str = "";
                    $filter = "";
                    echo '<h5 class="text-info" style="font-size: xx-small;width: 100%">当前状态显示所有结果</h5><hr>';
                } else {
                    $str = '&tit=' . $_GET['tit'] . '&thm=' . $_GET['thm']
                        . '&ctr=' . $_GET['ctr'] . '&cty=' . $_GET['cty'];
                    $filter = getFilterFactor();
                }

                $sql = 'select * from travelimage ' . $filter . ';';
                $result = $pdo->query($sql);

                if ($result)
                    $totalCount = $result->rowCount();
                else
                    $totalCount = 0;

                if ($totalCount == 0)
                echo '<h1 class="text-info">&nbsp;&nbsp;对不起，未找到相关结果<h1></div>';
                else {
                $pageSize = 9;
                $remain = $totalCount;
                $totalPage = (int)(($totalCount % $pageSize == 0) ? ($totalCount / $pageSize) : ($totalCount / $pageSize + 1));

                if (!isset($_GET['page']))
                    $currentPage = 1;
                else
                    $currentPage = $_GET['page'];

                $mark = ($currentPage - 1) * $pageSize;
                $remain = $remain - ($currentPage - 1) * $pageSize;
                $firstPage = 1;
                $page2 = ($totalPage - $currentPage > 0) ? $currentPage + 1 : null;
                $page3 = ($totalPage - $currentPage > 1) ? $currentPage + 2 : null;
                $page4 = ($currentPage > 1) ? $currentPage - 1 : null;
                $page5 = ($currentPage > 2) ? $currentPage - 2 : null;
                $prePage = ($currentPage > 1) ? $currentPage - 1 : null;
                $nextPage = ($totalPage - $currentPage > 0) ? $currentPage + 1 : null;

                $sql = 'select * from travelimage ' . $filter . ' limit ' . $mark . "," . $pageSize . ';';
                $result = $pdo->query($sql);

                if ($remain < $pageSize) {
                    for ($j = 0; $j < $remain; $j++) {
                        $id = $result->fetch(PDO::FETCH_ASSOC);
                        paintResult($id);
                    }
                } else
                    for ($j = 0; $j < $pageSize; $j++) {
                        $id = $result->fetch(PDO::FETCH_ASSOC);
                        paintResult($id);
                    }
                ?>
            </div>
            <div class="row">
                <ul class="pagination pagination-sm mx-auto">
                    <?php
                    if ($prePage != null)
                        echo '<li class="page-item"><a class="page-link"
                                     href="Browse.php?page=' . $prePage . $str . ' ">&lt;</a></li>';
                    else
                        echo '<li class="page-item disabled"><a class="page-link"
                                     href="Browse.php?page=' . $prePage . $str . ' ">&lt;</a></li>';
                    if ($page5 != null)
                        echo '<li class="page-item"><a class="page-link"
                                     href="Browse.php?page=' . $page5 . $str . ' "> ' . $page5 . '</a></li>';
                    if ($page4 != null)
                        echo '<li class="page-item"><a class="page-link"
                                     href="Browse.php?page=' . $page4 . $str . ' "> ' . $page4 . '</a></li>';

                    echo '<li class="page-item active"><a class="page-link"
                               href="Browse.php?page=' . $currentPage . $str . '"> ' . $currentPage . '</a></li>';

                    if ($page2 != null)
                        echo '<li class="page-item"><a class="page-link"
                                     href="Browse.php?page=' . $page2 . $str . ' "> ' . $page2 . '</a></li>';
                    if ($page3 != null)
                        echo '<li class="page-item"><a class="page-link"
                                     href="Browse.php?page=' . $page3 . $str . ' "> ' . $page3 . '</a></li>';
                    if ($nextPage != null)
                        echo '<li class="page-item"><a class="page-link"
                                     href="Browse.php?page=' . $nextPage . $str . ' ">&gt;</a></li>';
                    else
                        echo '<li class="page-item disabled"><a class="page-link"
                                     href="Browse.php?page=' . $nextPage . $str . ' ">&gt;</a></li>';
                    ?>
                </ul>
            </div>
            <?php
            }
            $pdo = null;
            }
            ?>
        </div>
    </div>
</div>


<form method="get" style="display: none" id="hidden">
    <input type="text" name="ed-thm" id="ed-thm">
    <input type="text" name="ed-ctr" id="ed-ctr">
</form>
<form method="get" style="display: none;width: 70%;float: right" id="hiddenForm" class="picshow">
    <input type="text" name="tit" id="tit">
    <input type="text" name="thm" id="thm">
    <input type="text" name="ctr" id="ctr">
    <input type="text" name="cty" id="cty">
</form>

<div class="modal-footer bg-dark text-white">
    <p style="height: 2em">Copyright &copy; 2019-2020 Web
        fundamental.All Rights Reserved.L00335856757576465465465464747</p>
</div>
<script src='../JS/bootstrap.min.js' type='text/javascript'></script>
<script src='../JS/jquery-3.3.1.min.js' type='text/javascript'></script>
</body>
</html>









<?php
function getFilterFactor()
{
    $filter = "";
    $title = $_GET['tit'];
    $thm = $_GET['thm'];
    $ctr = changeStr($_GET['ctr']);
    $cty = changeStr($_GET['cty']);
    if (empty($title)) {
        if (!empty($thm))
            $filter1 = " Content = '" . $thm . "' ";
        else $filter1 = "";
        if (!empty($ctr))
            $filter2 = " CountryCodeISO = '" . $ctr . "' ";
        else $filter2 = "";
        if (!empty($cty))
            $filter3 = " CityCode = '" . $cty . "' ";
        else $filter3 = "";
        if ($filter1 !== "" && $filter2 !== "" && $filter3 !== "")
            $filter = " WHERE " . $filter1 . " and " . $filter2 . " and " . $filter3 . " ";
        elseif ($filter1 !== "" && $filter2 !== "" && $filter3 === "")
            $filter = " WHERE " . $filter1 . " and " . $filter2 . " ";
        elseif ($filter1 !== "" && $filter2 === "" && $filter3 === "")
            $filter = " WHERE " . $filter1 . " ";
        elseif ($filter1 === "" && $filter2 !== "" && $filter3 === "")
            $filter = " WHERE " . $filter2 . " ";
        elseif ($filter1 === "" && $filter2 !== "" && $filter3 !== "")
            $filter = " WHERE " . $filter2 . " and " . $filter3 . " ";
        elseif ($filter1 === "" && $filter2 === "" && $filter3 !== "")
            $filter = " WHERE " . $filter3 . " ";
        return $filter;
    } else {
        $filter = " WHERE Title like '%" . $title . "%' ";
        return $filter;
    }
}

function changeStr($str){
    $str = str_replace("'","\'",$str);
    $str = str_replace('"','\"',$str);
    return $str;
}

function paintResult($id)
{
    echo '<div class="col-3"><div class="crop mx-auto">';
    echo '<a href="../src/detail2.php?id=' . $id['ImageID'] . '"><img class="rounded img-fluid" src="' . IMAGE_ROOT. $id['PATH'] . '" alt="图片损坏"></a>';
    echo '</div></div>';
}

function paintNotLogin()
{
    echo '<div><a href="login.php">Log in</a></div>';
}

function paintLogin()
{
    echo '<div><a href="#">My account ▼</a>';
    echo '<ul><li id="upload_image" class="nav_list_right_li">';
    echo '<a href="upload.php?">';
    echo '<img src="../img/nav/upload.png" width="16" height="16" alt="图标1">Upload</a>';
    echo '</li><li id="photo_image" class="nav_list_right_li">';
    echo '<a href="my_photo.php?">';
    echo '<img src="../img/nav/photo.png" width="16" height="16" alt="图标2">My Photo</a>';
    echo '</li><li id="favor_image" class="nav_list_right_li">';
    echo '<a href="favor.php?">';
    echo '<img src="../img/nav/favor.png" width="16" height="16" alt="图标3">My Favorite</a>';
    echo '</li><li id="logout_image" class="nav_list_right_li">';
    echo '<a href="logout.php">';
    echo '<img src="../img/nav/logout.png" width="16" height="16" alt="图标4">Log out</a>';
    echo '</li></ul></div>';
}

?>