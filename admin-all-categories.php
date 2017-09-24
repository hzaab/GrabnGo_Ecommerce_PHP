<?php session_start(); ?>
<?php require_once("admin-header.php"); ?>
<?php require_once("admin-sidebar.php"); ?>
<?php require_once("database.php"); ?>

<?php
    if(!$_SESSION['user'])
    {
        header('Location: admin-login.php');
    }


    $query = "SELECT * FROM category";
    $result = mysqli_query($con, $query);

    if(!$result) {
        echo "Query Failed !";
    }
?>
      
       
<section>
    <div id="main-body">
        <h1 id="allp">All Categories : </h1>
        <a href="add-new-category.php" id="paddnew">Add New Category !</a>

        <ul id="main-product-list" class="clearfix">
           <?php 
                while($row = mysqli_fetch_array($result)) {
                    $user_id = $row['c_id'];
            
                    $output = "<a href=\"edit-category.php?id=". $row['c_id'] ."\"><li> ";
                    $output .= "<img src=get-category-image.php?id=".$user_id.">";
                    $output .= " <p id='pname'>".$row['c_name']."</p> ";
                    $output .= "<a href='delete-category.php?id=$user_id' id='pdelete' onclick=\"return confirm('Are you sure you want to delete this item?');\">Delete</a>";
                    $output .= "</li></a>";
                    
                    echo $output;
                }
            
            ?>
        </ul>
    </div> <!-- /#main-body -->
</section>

<?php require_once("admin-footer.php"); ?>