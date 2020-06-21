<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <link rel="stylesheet" href="../CSS/sighup-login.css">
</head>
<body>
<div class="slogan">
    <p>Open your eyes with pleasure</p>
    <p>Share with us your wonderful travel</p>
</div>
<div class="ls-div">
    <form class="" action="Singup.html" method="post">
        <legend>Join us in SharingTrip</legend>
        <fieldset>
        <input calss="ls-text" id="user" type="text" placeholder="Username" required>
        <input calss="ls-text" id="email"  type="email" placeholder="@email" required>
        <input calss="ls-text" id="pass" type="password" placeholder="Set password" onkeyup="check()" required>
        <input calss="ls-text" id="com" type="password" placeholder="Comfirm password" onkeyup="com()" required>
            <div class="form-group">
                <label class="text-danger">
                    <?php
                    require_once('../src/config.php');
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $username = $_POST['user'];
                        $email = $_POST['email'];
                        $password = $_POST['pass'];
                        $check_password = $_POST['com'];
                        if ($password !== $check_password) echo '两次密码不一致';
                        else {
                            if (validRegister($username, $email, $password)) {
                                header("Location:Login.php");
                            } else echo '用户名已存在';
                        }
                    }
                    ?></label>
            </div>
            <input class="btn btn-success btn-block" type="submit" value="Sign in">
        </fieldset>
        <span id= "myspan" style="font-size: 20px;" ></span>
        <p>Already have an account?</p><a href="Login.php">Click here to LOGIN IN</a>
    </form>
    <script src="../JS/login-signup.js"></script>
</div>
</body>
</html>
<?php
function validRegister($user, $email, $pass)
{
    require_once('../src/config.php');
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = 'SELECT * FROM traveluser WHERE UserName =:user';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':user', $user);
    $statement->execute();
    if ($statement->rowCount() === 0) {
        $sql = 'INSERT INTO `traveluser` (`UID`, `Email`, `UserName`, `Pass`, `State`, `DateJoined`, `DateLastModified`)
 VALUES (NULL , :email, :user, :pass , 1, NULL, NULL)';
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':user', $user);
        $statement->bindValue(':pass', $pass);
        $result = $statement->execute();
        $pdo = null;
        if ($result) {
            return true;
        }
    }
    return false;
}
