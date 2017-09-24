<?php
    require_once("database.php");

    global $id;

    if(isset($_GET['id']))
    {
         $id=$_GET['id'];
    }

    $query = "DELETE FROM product WHERE id=$id";

    $result = mysqli_query($con, $query);

    if(!$result) {
        echo "query failed !" ;
    } else {
        header("Location:admin-all-products.php");
        exit;
    }

?>
