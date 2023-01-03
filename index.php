<!--public-page-->
<?php
require_once("config.php");
if(isset($_SESSION['email']))
{
    header("location:home.php");
}
if(!empty($_POST))
{
    $email = mysqli_real_escape_string($al, $_POST['email']);
    $password = mysqli_real_escape_string($al, sha1($_POST['password']));
    $sql = mysqli_query($al, "SELECT * FROM students WHERE email = '".$email."' AND password = '".$password."'");
    if(mysqli_num_rows($sql) == 1)
    {
        $_SESSION['email'] = $_POST['email'];
        header("location:home.php");
    }
    else
    {
        $msg = "Incorrect credentials!";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            Student Management System
        </title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php require("banner.php");?>
        <br>
        <div align="center">
            <div id="box">
                <span class="formHeading">- Student / Admin Login -</span>
                <br>
                <br>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <table border="0" cellpadding="5" cellspacing="5">
                        <tr>
                            <td class="labels" align="center" colspan="2"><?php if(isset($msg)) {echo $msg; }?></td>
                        </tr>
                        <tr>
                            <td class="labels">Email:</td>
                            <td><input type="email" name="email" size="20" placeholder="Enter Email" required></td>
                        </tr>
                        <tr>
                            <td class="labels">Password:</td>
                            <td><input type="password" name="password" size="20" placeholder="Enter Password" required></td>
                        </tr>
                        <tr>
                            <td class="labels" colspan="2" align="center"><input type="submit" value="Login"></td>
                        </tr>
                        <tr>
                            <td class="labels" colspan="2" align="center">New user? <a href="registration.php" class="link">Register here</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <?php require("footer.php");?>
    </body>
</html>