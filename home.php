<!--private-page-->
<?php
require_once("config.php");
if(!isset($_SESSION['email']))
{
    header("location:index.php");
}
$details = mysqli_fetch_array(mysqli_query($al, "SELECT * FROM students WHERE email = '".$_SESSION['email']."'"));
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
                <span class="formHeading">Welcome <?php echo $details['name']; if($details['user_type'] == 1){ echo " - [ADMIN]"; }?></span>
                <br>
                <br>
                <img src="profile_pictures/<?php echo $details['picture'];?>" height="100" width="100" />
                <br>
                <input type="button" value="My Profile" onClick="window.location='profile.php'">
                <?php
                    if($details['user_type'] == 1)
                    {
                        ?> 
                        <input type="button" value="Manage Students" onClick="window.location='manageStudents.php'">
                        <?php        
                    }
                ?>
                <input type="button" value="Change Password" onClick="window.location='changePassword.php'">
                <?php
                    if($details['user_type'] == 0)
                    {
                        ?> 
                        <input type="button" value="Delete Account" onClick="window.location='deleteAccount.php'">
                        <?php        
                    }
                ?>
            </div>
        </div>
        <?php require("footer.php");?>
    </body>
</html>