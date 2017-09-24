<?php session_start(); ?>
<?php require_once("admin-header.php"); ?>
<?php require_once("admin-sidebar.php"); ?>
<?php require_once("database.php"); ?>

<h1 id="p_report"> Purchase Report </h1>

<ul class="purchase">
   <?php
    
    if(!$_SESSION['user'])
    {
        header('Location: admin-login.php');
    }
    
        $query = mysqli_query($con, "SELECT * FROM sales");
        while ($row = mysqli_fetch_array($query)) {
            $output = "<li class=\"clearfix\">";
            $output .= "<div class=\"p_left\">";
            $output .= "<h1 class=\"hd\">Owner Details: </h1>";
            $output .= "<h2>Name: ".$row['s_name']."</h2>";
            $output .= "<h3>Email: ".$row['s_email']."</h3>";
            $output .= "<h4>Phone: ".$row['s_phone']."</h4>";
            $output .= "<h5>Address: ".$row['s_address']."</h5>";
            $output .= "<h6>Total Cost: ".$row['s_exp']."</h6>";
            $output .= "</div>";
            $output .= "<div class=\"p_right\">";
            $output .= "<h1 class=\"hd\">Products Details: </h1>";
            
            $products = mysqli_query($con, "SELECT * FROM sales_info WHERE s_id=". $row['s_id']);
            while ($result = mysqli_fetch_array($products))
            {
                $info = mysqli_query($con, "SELECT * FROM product WHERE id=".$result['p_id']);
                while ($info_row = mysqli_fetch_array($info))
                {
                    $output .= "<div class=\"pp\">";
                    $output .= "<h2>".$info_row['p_name']."</h2>";
                    $output .= "<img src=get-product-image.php?id=".$info_row['id'].">";
                    $output .= " <h3>Quantity: ".$result['quantity']."</h3>";
                    $output .= "<h4>Price: ".$info_row['p_price']."</h4>";
                    $output .= "</div>";
                }
            }
            
            $output .= "</div>";
            $output .= "</li>";
            
            echo $output;
            
        }
    ?>
</ul>



<?php require_once("admin-footer.php"); ?>