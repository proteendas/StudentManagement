<!--admin-page-->
<?php
require_once("config.php");
if(!isset($_SESSION['email']))
{
    header("location:index.php");
}
$details = mysqli_fetch_array(mysqli_query($al, "SELECT * FROM students WHERE email = '".$_SESSION['email']."'"));
if($details['user_type'] != 1)
{
    header("location:home.php");
}
if(!empty($_POST))
{
    $hash_key = sha1(microtime());
    if($_FILES["dp"]["error"] > 0)
    {
        $msg = "File cannot be uploaded!";
    }
    else
    {
        $file_name = $_FILES["dp"]["name"];
        $upload_dir = "profile_pictures";
        $extension = end(explode(".",$file_name));
        $file_id = md5($_POST['email']).".".$extension;
        if($extension == 'webp' || $extension == 'WEBP' || $extension == 'jpeg' || $extension == 'JPEG' || $extension == 'JPG' || $extension == 'jpg' || $extension == 'PNG' || $extension == 'png')
        {
            $sql = mysqli_query($al, "INSERT INTO students(user_type, hash_key, name, dob, address, email, password, picture, time, date, agent, ip) VALUES('0', '".$hash_key."','".mysqli_real_escape_string($al,$_POST['name'])."', '".mysqli_real_escape_string($al,$_POST['dob'])."', '".mysqli_real_escape_string($al,$_POST['address'])."', '".mysqli_real_escape_string($al,$_POST['email'])."', '".mysqli_real_escape_string($al,sha1(1234))."', '".$file_id."', '".date('h:i A')."', '".date('Y-m-d')."', '".$_SERVER['HTTP_USER_AGENT']."', '".$_SERVER['REMOTE_ADDR']."')");
            if($sql)
            {
                move_uploaded_file($_FILES["dp"]["tmp_name"],$upload_dir."/".$file_id);
                $msg = "Successfully Registered!";
            }
            else
            {
                $msg = "Registration Failed! Try again later.";
            }
        }
        else
        {
            $msg = "Wrong file format! Try uploading correct file.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head> 
        <meta charset="utf-8">
        <title>
            Student Management System | Registration
        </title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            function passwords()
            {
                if(document.getElementById('p1').value == document.getElementById('p2').value)
                {
                    return true;
                }
                else
                {
                    alert('Passwords do not match! Try again.');
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <?php require("banner.php");?>
        <br>
        <div align="center">
            <div id="box">
                <span class="formHeading">Add New Student Details</span>
                <br>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data" onsubmit="return passwords()">
                    <table border="0" cellpadding="5" cellspacing="5">
                        <tr>
                            <td class="labels" align="center" colspan="2"><?php if(isset($msg)) {echo $msg; }?></td>
                        </tr>
                        <tr>
                            <td class="labels">Name:</td>
                            <td><input type="text" name="name" size="20" placeholder="Enter Name" required></td>
                        </tr>
                        <tr>
                            <td class="labels">Date of Birth:</td>
                            <td><input type="date" name="dob" size="20" placeholder="Enter Date of Birth" required></td>
                        </tr>
                        <tr>
                            <td class="labels">Email:</td>
                            <td><input type="email" name="email" size="20" placeholder="Enter Email" required></td>
                        </tr>
                        <tr>
                            <td class="labels">Address:</td>
                            <td><textarea name="address" placeholder="Enter Permanent Address" required></textarea></td>
                        </tr>
                        <tr>
                            <td class="labels">Profile Picture:</td>
                            <td><input type="file" name="dp" required></td>
                        </tr>
                    </table>
                    <input type="submit" value="ADD" onclick="return confirm('Are you sure?');">
                    <input type="button" value="BACK" onClick="window.location='manageStudents.php'">
                </form>
            </div>
        </div>
        <?php require("footer.php");?>
    </body>
</html>