<?php 

    require_once("database.php");

    $id = $_REQUEST['id'];

    $image = mysqli_query($con, "SELECT * FROM category WHERE c_id = $id") or die();

    $image = mysqli_fetch_assoc($image);

    $image = $image['c_image'];

    header("Content-type: image/jpeg");

    echo $image;

?>