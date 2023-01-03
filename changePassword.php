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
    if(sha1($_POST['current_password']) == $details['password'])
    {
        if($_POST['new_password'] == $_POST['confirm_password'])
        {
            $sql = mysqli_query($al, "UPDATE students SET password='".sha1($_POST['new_password'])."' WHERE email='".$_SESSION['email']."'");
            if($sql)
            {
                $msg = "Password successfully updated.";
            }
            else
            {
                $msg = "Password can't be updated. Try later.";
            }
        }
        else
        {
            $msg = "Passwords don't match.";
        }
    }
    else
    {
        $msg = "Wrong password entered.";
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
                <span class="formHeading">Change Password</span>
                <br>
                <br>
                <img src="profile_pictures/<?php echo $details['picture'];?>" height="100" width="100" />
                <br>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <table border="0" cellpadding="5" cellspacing="5">
                        <tr>
                            <td class="labels" align="center" colspan="2"><?php if(isset($msg)) {echo $msg; }?></td>
                        </tr>
                        <tr>
                            <td class="labels">Current Password:</td>
                            <td><input type="password" name="current_password" size="30" placeholder="Enter current password" required/></td>
                        </tr>
                        <tr>
                            <td class="labels">New Password:</td>
                            <td><input type="password" name="new_password" size="30" placeholder="Enter new password" required/></td>
                        </tr>
                        <tr>
                            <td class="labels">Confirm Password:</td>
                            <td><input type="password" name="confirm_password" size="30" placeholder="Re-enter new password" required/></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2"><input type="submit" value="Change Password"/></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2"><input type="button" value="HOME" onClick="window.location='home.php'"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <?php require("footer.php");?>
    </body>
</html>