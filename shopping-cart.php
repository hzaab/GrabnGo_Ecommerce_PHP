<?php session_start(); ?>
<?php require_once("header.php"); ?>
<?php require_once("database.php"); ?>


<?php
    if(isset($_GET['add'])) 
    {
        $quantity = mysqli_query($con, 'SELECT id,p_quantity FROM product WHERE id='. $_GET['add']) or die();
        
        if(empty($_SESSION['cart_'.$_GET['add']]) == true)
        {
            $_SESSION['cart_'.$_GET['add']] = '0';
        }
        
        while($quantity_row = mysqli_fetch_array($quantity))
        {
            if($quantity_row['p_quantity'] != $_SESSION['cart_'.$_GET['add']]) {
                $_SESSION['cart_'.$_GET['add']] += '1';
                $_SESSION['count'] = 0;
            }
        }
        
        header('Location: shopping-cart.php');
    }


    if(isset($_GET['remove']))
    {
        $_SESSION['cart_'.$_GET['remove']] --;
        
        header('Location: shopping-cart.php');
    }

    if(isset($_GET['delete']))
    {
        $_SESSION['cart_'.$_GET['delete']] = '0';
        
        header('Location: shopping-cart.php');
    }




    function cart ($con)
    {
        $count = 0;
        $total = 0;
        $output = "<section>";
        $output .= "<h1 id=\"carthead\">Shopping Cart </h1>";
        $output .= "<div class=\"shopping-cart clearfix\">";
        $output .= "<ul class=\"shopping-list\">";
        
        foreach($_SESSION as $name => $value)
        {
            if($value > 0) {
                if(substr($name, 0, 5) == 'cart_') {
                    
                    $id = substr($name, 5, (strlen($name)-5));
                    
                    $get = mysqli_query($con, 'SELECT * FROM product WHERE id='.$id);
                    
                    
                    while($get_row = mysqli_fetch_array($get))
                    {
                        $sub = $get_row['p_price'] * $value;
                        $tub = $get_row['p_price'] * $value;
                        
                       // $out = $get_row['p_name'] . ' X ' . $value. ' @ $ '. number_format($get_row['p_price'], 2) . ' =  $' . number_format($sub, 2); 
                       //  $out .= ' <a href="shopping-cart.php?remove='.$id.'">[-]</a> <a href="shopping-cart.php?add='.$id.'">[+]</a> <a href="shopping-cart.php?delete='.$id.'">[Remove]</a> <br>';
                        
                        //echo $out;
                        $count++;
                        $output .= "<li class=\"clearfix\">";
                        $output .= "<div class=\"sfirst\">";
                        $output .= "<h3>".$get_row['p_name']."</h3>";
                        $output .= "<img id=\"cart-image\" src=get-product-image.php?id=".$id.">";
                        $output .= "</div>";
                        $output .= "<div class=\"ssecond\">";
                        $output .= "<h4>Product Description</h4>";
                        $output .= "<p>".$get_row['p_desc']."</p>";
                        $output .= "</div>";
                        $output .= "<div class=\"sthird\">";
                        $output .= "<h4>Quantity</h4>";
                        $output .= "<p>Current Quantity : <strong> ".$value." </strong></p>";
                        $output .= "<br><p>Available Quantity : <strong> ".$get_row['p_quantity']." </strong></p>";
                        if($get_row['p_discount'] > 0)
                        {
                            $discount_amount = ($get_row['p_discount'] * $sub)/100;
                            $sub = $sub - $discount_amount;
                            $output .= "<br><p>Available Discount : <strong> ".$get_row['p_discount']." %</strong></p>";
                        }
                        else {
                            $discount_amount = 0;
                        }
                        $output .= "</div>";
                        $output .= "<div class=\"sfour\">";
                        $output .= "<h4>Total Cost</h4>";
                        $output .= "<p>Selected Quantity : <strong> ".$value." </strong></p>";
                        $output .= "<p> X </p>";
                        $output .= "<p>Product Price : <strong> ".$get_row['p_price']."  &#2547;</strong></p>";
                        $output .= "<br>";
                        $output .= "<p> = ".$tub." &#2547;</p>";
                        $output .= "<br>";
                        
                        if($discount_amount > 0)
                        {
                        $output .= "<p id=\"discst\">Discount Amount : ".$discount_amount." &#2547;</p>";
                        }
                        
                        $output .= "<p id=\"totalcst\">Total Cost : ".$sub." &#2547;</p>";
                        $output .= "</div>";
                        $output .= "<div class=\"sfive\">";
                        $output .= '<a class="sminus" href="shopping-cart.php?remove='.$id.'">[-]</a>';
                        $output .= '<a class="splus" href="shopping-cart.php?add='.$id.'">[+]</a>';
                        $output .= '<a class="sdelete" href="shopping-cart.php?delete='.$id.'">[Remove]</a>';
                        $output .= "</div>";
                        $output .= "</li>";
                        $output .= "";
                        
                        $total += $sub;
                        
                    }

                }
                
                
                
            }
        }
        
        
        if($total == 0)
        {
            $empty = "<div id=\"emptycart\"> ";
            $empty .= "<p> Your Cart Is Empty ! </p>";
            $empty .= "</div>";
            
            echo $empty;
        }
        else {
            $output .= "<p id=\"grant_total\"> Total : <span>".$total." &#2547;</span></p>";
            
            $output .= "<a href=\"checkout.php\" id=\"continue-to-checkout\">Checkout</a>";
        
            $output .= "</ul>";
            $output .= "</div>";
            $output .= "</section>";

                echo $output;
        }
        
        
        $_SESSION['count'] = $count;
    }


cart($con);





?>
   
   

<?php require_once("footer.php")?>