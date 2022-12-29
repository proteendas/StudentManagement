<!--private-page-->
<?php
require_once("config.php");
if(!isset($_SESSION['email']))
{
    header("location:index.php");
}
if(!empty($_POST))
{
    $sql = mysqli_query($al, "UPDATE students SET name = '".$_POST['name']."', address = '".$_POST['address']."', dob = '".$_POST['dob']."' WHERE email = '".$_SESSION['email']."'");
    if($sql)
    {
        $msg = "Updated Successfully.";
    }
    else
    {
        $msg = "Cannot update credentials.";
    }
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
                <span class="formHeading">Edit Account Information</span>
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
                            <td class="labels">Name:</td>
                            <td class="labels"><input type="text" name="name" value="<?php echo $details['name'];?>" size="20" required></td>
                        </tr>
                        <tr>
                            <td class="labels">Date of Birth:</td>
                            <td class="labels"><input type="date" name="dob" value="<?php echo $details['dob'];?>" size="20" required></td>
                        </tr>
                        <tr>
                            <td class="labels">Email ID:</td>
                            <td class="labels"><input type="email" name="email" value="<?php echo $details['email'];?>" size="30" readonly disabled></td>
                        </tr>
                        <tr>
                            <td class="labels">Address:</td>
                            <td class="labels"><textarea name="address" placeholder="Enter Permanent Address" required><?php echo $details['name'];?></textarea></td>
                        </tr>
                        <tr>
                            <td class="labels" colspan="2" align="center"><input type="submit" value="UPDATE" onClick="return confirm('Are you sure?');"/></td>
                        </tr>
                    </table>
                </form>
                <br>
                <input type="button" value="BACK" onClick="window.location='profile.php'">
                <input type="button" value="HOME" onClick="window.location='home.php'">
            </div>
        </div>
        <?php require("footer.php");?>
    </body>
</html>