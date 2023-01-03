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
if(!empty($_GET['key']))
{
    $sql = mysqli_query($al, "DELETE FROM students WHERE hash_key='".$_GET['key']."'");
    if($sql)
    {
        header("location:manageStudents.php?msg=".sha1('true'));
    }
    else
    {
        header("location:manageStudents.php?msg=".sha1('false'));
    }
}
?>