<?php 

    require_once("database.php");

    $id = $_REQUEST['id'];

    $image = mysqli_query($con, "SELECT * FROM product WHERE id = $id") or die();

    $image = mysqli_fetch_assoc($image);

    $image = $image['p_image'];

    header("Content-type: image/jpeg");

    echo $image;

?>