<?php session_start(); ?>
<?php require_once("header.php")?>
<?php require_once("slider.php")?>
<?php require_once("database.php")?>

<?php
        $visitor = mysqli_query($con, "SELECT * FROM info");
            while ($visitor_row = mysqli_fetch_array($visitor))
            {
                $current_visit = $visitor_row['visitor'];
                $new_visit = $current_visit + 1;
                
                $update_sale = mysqli_query($con, "UPDATE info SET visitor = $new_visit");
            }
?>

<!-- ----------------- All Categories ------------------ -->
    <a href="browse-categories.php" id="see_all_link">See All Categories</a>

   <section>
       <div class="category-section clearfix">
           <ul class="all-category">
             <?php
                $query = "SELECT * FROM category";
                $result = mysqli_query($con, $query);
                if(!$result) {
                    echo "Query Failed !";
                }

                while($row = mysqli_fetch_array($result)) {
                    $user_id = $row['c_id'];
                    
                    $output = "<li>";
                    $output .= "<a href=\"category-product-list.php?id=".$user_id." \"> ";
                    $output .= "<img src=get-category-image.php?id=".$user_id.">";
                    $output .= "<p>".$row['c_name']."</p>";
                    $output .= "</a>";
                    $output .= "</li>";
                    
                    echo $output;
                }
               ?>
           </ul>
       </div> <!-- /.category-section -->
   </section>
   
<!-- -------------------- New Products -------------------- -->
  <a href="new-products.php" id="new_products">New Products</a>
    
    <section class="clearfix">
        <ul class="new-products">
           <?php
                $query = "SELECT * FROM product ORDER BY id DESC LIMIT 5";
                $result = mysqli_query($con, $query);
                if(!$result) {
                    echo "Query Failed !";
                }

                while($row = mysqli_fetch_array($result)) {
                    $user_id = $row['id'];
                    
                    $output = "<li>";
                    $output .= "<a href=\"product-single.php?id=".$row['id']."\">";
                    $output .= "<img src=get-product-image.php?id=".$user_id.">";
                    $output .= "<p>".$row['p_name']."</p>";
                    $output .= "</a>";
                    $output .= "<hr>";
                    
                    $quanity = $row['p_quantity'];
                    
                    if($row['p_discount'] > 0 )
                    {
                        $output .= "<strike>".$row['p_price']." &#2547;</strike>";
                        $output .= "<i>Discount: ".$row['p_discount']." %</i>";
                        $output .= "<br>";
                        $discount_amount = ($row['p_discount'] * $row['p_price'])/100;
                        $cr_amount = $row['p_price'] - $discount_amount;
                        $output .= "<span id=\"original-price\">".$cr_amount." &#2547;</span>";
                        if($quanity != "0")
                        {
                            $output .= "<span id=\"stock\">On Stock!</span>";
                            $output .= "<p id=\"see-details\"><a href=\"product-single.php?id=".$row['id']."\">Buy Now</a></p>";
                            $output .= "</li>";
                        }else {
                            $output .= "<span id=\"stock\" class=\"red\">Out Of Stock!</span>";
                            $output .= "<p id=\"see-details\"><a href=\"product-single.php?id=".$row['id']."\">Buy Now</a></p>";
                            $output .= "</li>";
                        }
                        
                    }else {
                        $output .= "<br>";
                        $output .= "<span id=\"original-price\">".$row['p_price']." &#2547;</span>";
                        if($quanity != "0")
                        {
                            $output .= "<span id=\"stock\">On Stock!</span>";
                            $output .= "<p id=\"see-details\"><a href=\"product-single.php?id=".$row['id']."\">Buy Now</a></p>";
                            $output .= "</li>";
                        }else {
                            $output .= "<span id=\"stock\" class=\"red\">Out Of Stock!</span>";
                            $output .= "<p id=\"see-details\"><a href=\"product-single.php?id=".$row['id']."\">Buy Now</a></p>";
                            $output .= "</li>";
                        }
                    }
                    
                    echo $output;
                }
            ?>       
            
        </ul>
    </section>


    
<!-- -------------------- TOP Products -------------------- -->
  <a href="top-selling-products.php" id="top_products">Top Selling Products</a>
    
    <section class="clearfix">
        <ul class="top-products">
            <?php
                $query = "SELECT * FROM product ORDER BY p_sale DESC LIMIT 5";
                $result = mysqli_query($con, $query);
                if(!$result) {
                    echo "Query Failed !";
                }

                while($row = mysqli_fetch_array($result)) {
                    $user_id = $row['id'];
                    
                    $output = "<li>";
                    $output .= "<a href=\"product-single.php?id=".$row['id']."\">";
                    $output .= "<img src=get-product-image.php?id=".$user_id.">";
                    $output .= "<p>".$row['p_name']."</p>";
                    $output .= "</a>";
                    $output .= "<hr>";
                    
                    $quanity = $row['p_quantity'];
                    
                    if($row['p_discount'] > 0 )
                    {
                        $output .= "<strike>".$row['p_price']." &#2547;</strike>";
                        $output .= "<i>Discount: ".$row['p_discount']." %</i>";
                        $output .= "<br>";
                        $discount_amount = ($row['p_discount'] * $row['p_price'])/100;
                        $cr_amount = $row['p_price'] - $discount_amount;
                        $output .= "<span id=\"original-price\">".$cr_amount." &#2547;</span>";
                        if($quanity != "0")
                        {
                            $output .= "<span id=\"stock\">On Stock!</span>";
                            $output .= "<p id=\"see-details\"><a href=\"product-single.php?id=".$row['id']."\">Buy Now</a></p>";
                            $output .= "</li>";
                        }else {
                            $output .= "<span id=\"stock\" class=\"red\">Out Of Stock!</span>";
                            $output .= "<p id=\"see-details\"><a href=\"product-single.php?id=".$row['id']."\">Buy Now</a></p>";
                            $output .= "</li>";
                        }
                        
                    }else {
                        $output .= "<br>";
                        $output .= "<span id=\"original-price\">".$row['p_price']." &#2547;</span>";
                        if($quanity != "0")
                        {
                            $output .= "<span id=\"stock\">On Stock!</span>";
                            $output .= "<p id=\"see-details\"><a href=\"product-single.php?id=".$row['id']."\">Buy Now</a></p>";
                            $output .= "</li>";
                        }else {
                            $output .= "<span id=\"stock\" class=\"red\">Out Of Stock!</span>";
                            $output .= "<p id=\"see-details\"><a href=\"product-single.php?id=".$row['id']."\">Buy Now</a></p>";
                            $output .= "</li>";
                        }
                    }
                    
                    echo $output;
                }
            ?>       
        </ul>
    </section>




<?php require_once("footer.php"); ?>
