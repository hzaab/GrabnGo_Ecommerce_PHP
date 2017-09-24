<?php session_start(); ?>
<?php require_once("header.php")?>
<?php require_once("slider.php")?>
<?php require_once("database.php")?>
  
      
<!-- -------------------- Category Products -------------------- -->
  <a href="#" id="top_products">Products of Category</a>
    
    <section class="clearfix">
        <ul class="top-products">
            <?php
                global $id;

                if(isset($_GET['id']))
                {
                     $id=$_GET['id'];
                }

                $query = "SELECT * FROM product WHERE cat_name = (SELECT c_name FROM category WHERE c_id = $id)";

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
                        $output .= "<i>Discount: ".$row['p_discount']." &#2547;</i>";
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
                        $output .= "<span id=\"original-price\">5.00 &#2547;</span>";
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