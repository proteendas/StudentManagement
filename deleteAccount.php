<!--private-page-->
<?php
require_once("config.php");
if(!isset($_SESSION['email']))
{
    header("location:index.php");
}
$details = mysqli_fetch_array(mysqli_query($al, "SELECT * FROM students WHERE email = '".$_SESSION['email']."'"));
if(!empty($_POST))
{
    if(sha1($_POST['password']) == $details['password'])
    {
        $sql = mysqli_query($al, "DELETE FROM students WHERE email='".$_SESSION['email']."'");
        if($sql)
        {
            header("location:logout.php");
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            <?php echo $details['name'];?>
        </title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php require("banner.php");?>
        <br>
        <div align="center">
            <div id="box">
                <span class="formHeading">Delete Account</span>
                <br>
                <br>
                <img src="profile_pictures/<?php echo $details['picture'];?>" height="100" width="100" />
                <br>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <table border="0" cellpadding="5" cellspacing="5">
                        <tr>
                            <td class="labels">Confirm Password to Delete Account:</td>
                            <td><input type="password" name="password" size="30" placeholder="Enter password" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" value="Permanently Delete Account" onclick="return confirm('Are you sure, you want to delete your account?')"></td>
                        </tr>
                    </table>
                </form>
                <input type="button" value="HOME" onClick="window.location='home.php'">
            </div>
        </div>
        <?php require("footer.php");?>
    </body>
</html>