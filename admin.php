<?php session_start(); ?>
<?php require_once("admin-header.php"); ?>
<?php require_once("admin-sidebar.php"); ?>
<?php require_once("database.php"); ?>

<?php
    if(!$_SESSION['user'])
    {
        header('Location: admin-login.php');
    }

    $query = mysqli_query($con, "SELECT * FROM info");
    $row = mysqli_fetch_array($query);
    if(!$row)
    {
        echo "falied !";
    }

    $query1 = mysqli_query($con, "SELECT * FROM product");
    $row1_count = mysqli_num_rows($query1);
    
    $query2 = mysqli_query($con, "SELECT * FROM category");
    $row2_count = mysqli_num_rows($query2);
    
?>
<section>
    <div id="main-body">
        <ul id="admin-info">
            <a href="#"><li><img src="images/admin/community.png" alt=""><p>Total Visitors: <br> <span><?php echo $row['visitor']; ?></span></p></li></a>
            <a href="#"><li><img src="images/admin/products.png" alt=""><p>Total Products: <br> <span><?php echo $row1_count; ?></span></p></li></a>
            <a href="#"><li><img src="images/admin/category.png" alt=""><p>Total Categories: <br> <span><?php echo $row2_count; ?></span></p></li></a>
            <a href="#"><li><img src="images/admin/cash.ico" alt=""><p>Total Earning: <br> <span><?php echo $row['sale']; ?> &#2547; </span></p></li></a>
        </ul>

        <ul id="more-links">
            <a href="add-new-product.php"><li>Add More Products</li></a>
            <a href="add-new-category.php"><li>Add More Categories</li></a>
            <a href="sales-report.php"><li>Check Sales Status</li></a>
        </ul>
    </div>
</section>


<?php require_once("admin-footer.php"); ?>