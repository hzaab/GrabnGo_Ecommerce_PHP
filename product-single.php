<?php session_start(); ?>
<?php require_once("header.php")?>
<?php require_once("slider.php")?>
<?php require_once("database.php")?>


<?php
    global $id;

    if(isset($_GET['id']))
    {
         $id=$_GET['id'];
    }

     $query = "SELECT * FROM product WHERE id = $id";
     $result = mysqli_query($con, $query);

    if(!$result) {
        echo "Query Failed !";
    }
?>

<?php
    
?>

<!-- ----------------Product Single Showcase ---------------- -->
    <section class="single-product clearfix">
       <?php
            while($row = mysqli_fetch_array($result)) {
                    $user_id = $row['id'];
                
                $output = "<div class=\"product-left\">";
                $output .= "<img src=get-product-image.php?id=".$user_id.">";
                $output .= "<p>".$row['p_name']."</p>";
                $output .= "</div>";
                $output .= "<div class=\"product-right\">";
                $output .= "<h1>".$row['p_name']."</h1>";
                $output .= "<p id=\"product-desc\">".$row['p_desc']."</p>";
                
                if($row['p_discount'] > 0)
                {
                    $output .= "<p id=\"old-price\"><strike>".$row['p_price']." &#2547;</strike> Discount: ".$row['p_discount']."%</p>";
                    $discount_amount = ($row['p_discount'] * $row['p_price'])/100;
                    $cr_amount = $row['p_price'] - $discount_amount;  
                    $output .= "<p id=\"new-price\">".$cr_amount." &#2547; <span id=\"quantityno\">Available Quantity: <i>".$row['p_quantity']."</i></span></p>";
                    
                    if($row['p_quantity'] > 0)
                    {
                        $output .= "<p id=\"stock-on\">On Stock</p>";
                        $output .= "<a href='shopping-cart.php?add=".$row['id']."' class=\"add-to-cart\">Add To Cart</a>";
                        $output .= "</div>";
                        $output .= "</section>";


                    } else {
                        $output .= "<p id=\"stock-off\">Out of Stock</p>";
                        $output .= "</div>";
                        $output .= "</section>";
                    }
                    
                } else {
                    $output .= "<p id=\"new-price\">$ ".$row['p_price']." <span id=\"quantityno\">Available Quantity: <i>".$row['p_quantity']."</i></span></p>";
                    
                    if($row['p_quantity'] > 0)
                    {
                        $output .= "<p id=\"stock-on\">On Stock</p>";
                        $output .= "<a href='shopping-cart.php?add=".$row['id']."' class=\"add-to-cart\">Add To Cart</a>";
                        $output .= "</div>";
                        $output .= "</section>";


                    } else {
                        $output .= "<p id=\"stock-off\">Out of Stock</p>";
                        $output .= "</div>";
                        $output .= "</section>";
                    }
                }
                
                
                
                echo $output;
                
            }
        ?>
  
      
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

    

<?php require_once("footer.php")?>