<?php session_start(); ?>
<?php require_once("admin-header.php"); ?>
<?php require_once("admin-sidebar.php"); ?>
<?php require_once("database.php"); ?>

<h1 id="report"> Sales Report </h1>

<ul class="sales_r">
  
  <?php 
    
    if(!$_SESSION['user'])
    {
        header('Location: admin-login.php');
    }
    
        $query = mysqli_query($con, "SELECT * FROM product") or die();
        
        while ($row = mysqli_fetch_array($query))
        {
            $output = "<li>";
            $output .= "<img src=get-product-image.php?id=".$row['id'].">";
            $output .= "<a href=\"edit-product.php?id=".$row['id']."\">".$row['p_name']."</a>";
            $output .= "<p class=\"detail-info\">(Total Sale: ".$row['p_sale']." , Total Earned: ".$row['p_earning']." )</p>";
            $output .= "<p>Sales Report: </p>";
            $output .= "<p class=\"detail-board\" style=\"width: ".$row['p_sale']."%;\">";
            $output .= "</p>";
            $output .= "</li>";
            $output .= "";
            $output .= "";
            $output .= "";
            
            echo $output;
            
        }
    ?>  
</ul>

<?php require_once("admin-footer.php"); ?>