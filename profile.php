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
                <span class="formHeading"><?php echo $details['name'];?>'s Profile</span>
                <br>
                <br>
                <img src="profile_pictures/<?php echo $details['picture'];?>" height="100" width="100" />
                <br>
                <table>
                    <tr>
                        <td class="labels">Name:</td>
                        <td class="labels"><?php echo $details['name'];?></td>
                    </tr>
                    <tr>
                        <td class="labels">Date of Birth:</td>
                        <td class="labels"><?php echo $details['dob'];?></td>
                    </tr>
                    <tr>
                        <td class="labels">Email ID:</td>
                        <td class="labels"><?php echo $details['email'];?></td>
                    </tr>
                    <tr>
                        <td class="labels">Address:</td>
                        <td class="labels"><?php echo $details['address'];?></td>
                    </tr>
                    <tr>
                        <td class="labels">Date of Registration:</td>
                        <td class="labels"><?php echo $details['date'];?></td>
                    </tr>
                </table>
                <br>
                <input type="button" value="EDIT" onClick="window.location='edit.php'">
                <input type="button" value="HOME" onClick="window.location='home.php'">
            </div>
        </div>
        <?php require("footer.php");?>
    </body>
</html>