<!--private-page-->
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
if(!empty($_GET['msg']))
{
    if($_GET['msg'] == sha1('true'))
    {
        ?>
        <script>
            alert('Successfully Deleted.');
        </script>
        <?php
    }
    elseif($_GET['msg'] == sha1('false'))
    {
        ?>
        <script>
            alert('Error : Cannot Delete. Try again.');
        </script>
        <?php
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
        <style type="text/css">
            table, tr, td, th
            {
                border: 1px solid rgba(142, 14, 0, 1.00);
                padding: 10px;
                border-collapse: collapse;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <?php require("banner.php");?>
        <br>
        <div align="center">
            <div id="box">
                <span class="formHeading">Manage Student Details</span>
                <br>
                <br>
                <img src="profile_pictures/<?php echo $details['picture'];?>" height="100" width="100" />
                <br>
                <table class="manageTable" border="1" cellpadding="5" cellspacing="5">
                    <tr>
                        <th>Sl. No.</th>
                        <th>Name</th>
                        <th>Date of Birth</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Picture</th>
                        <th>Registration Time &amp; Date</th>
                        <th>Delete Account</th>
                    </tr>
                    <?php
                    $table = mysqli_query($al, "SELECT * FROM students WHERE user_type = '0' ORDER BY id ASC");
                    $sl = 1;
                    while($c = mysqli_fetch_array($table))
                    {
                    ?>
                    <tr>
                        <td><?php echo $sl; $sl++;?></td>
                        <td><?php echo $c['name'];?></td>
                        <td><?php echo $c['dob'];?></td>
                        <td><?php echo $c['address'];?></td>
                        <td><?php echo $c['email'];?></td>
                        <td><img src="profile_pictures/<?php echo $c['picture'];?>" height="50" width="50"></td>
                        <td><?php echo $c['time']." & ".$c['date'];?></td>
                        <td><a href="delete.php?key=<?php echo $c['hash_key'];?>" onclick="return confirm('Are you sure?');" class="labels">DELETE</a></td>
                    </tr>
                    <?php
                    }?>
                </table>
                <br>
                <input type="button" value="ADD DETAILS" onClick="window.location='addDetails.php'">
                <input type="button" value="HOME" onClick="window.location='home.php'">
            </div>
        </div>
        <?php require("footer.php");?>
    </body>
</html>