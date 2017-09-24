<?php session_start(); ?>
<?php require_once("header.php")?>
<?php require_once("slider.php")?>
<?php require_once("database.php")?>
   
   
<?php 
    if(isset($_POST['submit']))
    {
        checkout($con);
    }

    function checkout($con)
    {
        if(!empty($_POST['name']) && !empty($_POST['email']) && !empty('phone') && !empty($_POST['address']))
        {
        
            echo $sname = $_POST['name'];
            echo $email = $_POST['email'];
            echo $phone = $_POST['phone'];
            echo $address = $_POST['address'];
            $total = 0;
            
            foreach($_SESSION as $name => $value)
            {
                if($value > 0) {
                    if(substr($name, 0, 5) == 'cart_') {

                        $id = substr($name, 5, (strlen($name)-5));

                        $get = mysqli_query($con, 'SELECT * FROM product WHERE id='.$id) or die();

                        while($get_row = mysqli_fetch_array($get))
                        {
                            $sub = $get_row['p_price'] * $value;
                            $tub = $get_row['p_price'] * $value;
                            
                                if($get_row['p_discount'] > 0)
                                {
                                    $discount_amount = ($get_row['p_discount'] * $sub)/100;
                                    $sub = $sub - $discount_amount;
                                }
                                else {
                                    $discount_amount = 0;
                                }

                                echo $total += $sub; 
                            
                            
                            
                            //Updating Product Information
                            $new_quantity = $get_row['p_quantity'] - $value;
                            $earning = $get_row['p_earning'] + $tub;
                            $sale = $get_row['p_sale'] + $value;
                            
                            $update = mysqli_query($con, "UPDATE product SET p_quantity ='$new_quantity', p_earning ='$earning', p_sale ='$sale' WHERE id =$id");
                            
                            //Updating sales_info Table
                            $sid = 0;
                            $sale_products = mysqli_query($con, "INSERT INTO sales_info (id,s_id,p_id,quantity,cost) VALUES (NULL,'$sid','$id','$value', '$tub')");
                            
                        }
                        
                    }
                }
            }
            
            //Inserting Buyer Data
            $query = mysqli_query($con, "INSERT INTO sales  
            (s_id,s_name,s_email,s_phone,s_address,s_exp) 
            VALUES (NULL,'$sname','$email','$phone', '$address', $total)") or die();
            
            
            //total sal Update
            $old_sale = mysqli_query($con, "SELECT * FROM info");
            while ($old_sale_row = mysqli_fetch_array($old_sale))
            {
                $current_sale = $old_sale_row['sale'];
                $new_sale = $current_sale + $total;
                
                $update_sale = mysqli_query($con, "UPDATE info SET sale = $new_sale");
            }

            
            //Updating sales_info owner
            $last = mysqli_query($con, "SELECT s_id FROM sales ORDER BY s_id DESC LIMIT 1");
            $last_row = mysqli_fetch_array($last) or die();
            $last_id = $last_row['s_id'];
            echo '<br>'.$last_id.'<br>';
            
            foreach($_SESSION as $name => $value)
            {
                if($value > 0) {
                    if(substr($name, 0, 5) == 'cart_') {

                            $id = substr($name, 5, (strlen($name)-5));
                
                            $owner = mysqli_query($con, "UPDATE sales_info SET s_id ='$last_id' WHERE s_id =0 ");

                    }       
                }
            }
            
            header('Location: thank-you.php');             
                            
        }
        else {
            echo "Fill All THe Information !";
        }
                        
    }


    
?>
   
    <!-- ------------------ Checkout Section ---------------- -->
    <section>
        <div id="checkout-wrapper">
           <h1>Checkout : Please Fill all The Information</h1>
            <div id="checkform">
                <form action="checkout.php" method="post">
                    <p id="cname" class="clabel">Your Name :</p>
                    <input type="text" name="name" size="100" placeholder="Enter Your Name">
                    <p id="cemail" class="clabel">Your Email :</p>
                    <input type="email" name="email" size="100" placeholder="Enter Your Email">
                    <p id="cname" class="clabel">Your Phone :</p>
                    <input type="text" name="phone" size="100" placeholder="Enter Your Phone Number">
                    <p id="cname" class="clabel">Your Address :</p>
                    <textarea name="address" id="tid" cols="76" rows="15" wrap="soft" placeholder="Enter Your Address"></textarea>
                    <input type="submit" name="submit" id="checksubmit" value="Continue Checkout">

                </form>
                
                <div class="cmorelinks">
                    <a href="shopping-cart.php">Back To Shopping Cart</a>
                    <a href="new-products.php">Add More Products</a>
                </div>
                
            </div>
        </div>
    </section>
   
   

<?php require_once("footer.php")?>