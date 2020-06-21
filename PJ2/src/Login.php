<?php
session_start();
unset($_SESSION['Username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../CSS/sighup-login.css">
</head>
<body>
<div class="slogan">
    <p>Open your eyes with pleasure</p>
    <p>Share with us your wonderful travel</p>
</div>
<div class="ls-div">
    <form class="" action="../index.php" method="post">
        <legend>Welcome to SharingTrip</legend>
        <h2>Go outside and see the world!!</h2>
        <fieldset>
        <input calss="ls-text" id="user" type="text" placeholder="Username" required>
        <input calss="ls-text" id="pass" type="password" placeholder="password" required>
        </fieldset>
        <div class="form-group">
            <label class="text-danger">
                <?php
                require_once('../src/config.php');

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (validLogin()) {
                        $_SESSION['Username'] = $_POST['user'];
                        header("Location:../index.php");
                    } else {
                        echo '用户名或密码不正确';
                    }
                }
                ?>
            </label>
        </div>
        <input class="btn btn-success btn-block" type="submit" value="Sign in">
        <p>Haven't registered yet?</p><a href="../src/Singup.php" >Click here to SIGN UP first</a>
    </form>
</div>
<?php

echo "<script src='../JS/jquery-3.3.1.min.js'></script>";
?>
</body>
</html>
<?php
function validLogin()
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "SELECT * FROM traveluser WHERE UserName =:user and Pass =:pass";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(':user', $_POST['user']);
    $statement->bindValue(':pass', $_POST['pass']);
    $statement->execute();
    if ($statement->rowCount() === 1) {
        $pdo = null;
        return true;
    }
    $pdo = null;
    return false;
}

?>
