<?php session_start(); ?>
<?php require_once("admin-header.php"); ?>
<?php require_once("admin-sidebar.php"); ?>
<?php require_once("database.php"); ?>

<?php
    if(!$_SESSION['user'])
    {
        header('Location: admin-login.php');
    }


    $query = "SELECT * FROM product";
    $result = mysqli_query($con, $query);

    if(!$result) {
        echo "Query Failed !";
    }
?>


<section>
    <div id="main-body">
        <h1 id="allp">All Products : </h1>
        <a href="add-new-product.php" id="paddnew">Add New Product !</a>

        <ul id="main-product-list" class="clearfix">

           <?php 
                while($row = mysqli_fetch_array($result)) {
                    $user_id = $row['id'];
            
                    $output = "<a href=\"edit-product.php?id=". $row['id'] ."\"><li>";
                    $output .= "<img src=get-product-image.php?id=".$user_id.">";
                    $output .= "<p id='pname'>".$row['p_name']."</p>";
                    $output .= "<p id='pearning'>Earned: <strong> ".$row['p_earning'] ." &#2547;</strong></p>";
                    $output .= "<p id='psale'>Sale: <strong>".$row['p_sale']."</strong></p>";
                    $output .= "<a href='delete-product.php?id=$user_id' id='pdelete' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>";
                    $output .= "</li></a>";

                    echo $output;
                }
            ?>
        </ul>
    </div> <!-- /#main-body -->
</section>

<?php require_once("admin-sidebar.php"); ?>