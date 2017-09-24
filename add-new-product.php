<?php session_start(); ?>
<?php require_once("admin-header.php")?>
<?php require_once("admin-sidebar.php")?>
<?php require_once("database.php")?>


<?php 
    
    if(!$_SESSION['user'])
    {
        header('Location: admin-login.php');
    }

    if(isset($_POST['submit'])) 
    {
        add_new_product();
    }

    function add_new_product() {
        
        if(!empty($_POST['name']) && !empty($_POST['desc']) && !empty($_POST['price']) &&  !empty($_POST['quantity']) && !empty($_POST['category']) && !empty($_FILES['image']['tmp_name']) )
        {
            $p_name = $_POST['name'];
            $p_desc = $_POST['desc'];
            $p_price = $_POST['price'];
            $p_discount = $_POST['discount'];
            $p_quantity = $_POST['quantity'];
            $p_category = $_POST['category'];
            
            
            $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            $image_name = $_FILES['image']['name'];
            $image_size = getimagesize($_FILES['image']['tmp_name']);


            if(!$insert = mysqli_query($con, "INSERT INTO product  
            (id,p_name,p_desc,p_price,p_discount,p_quantity,p_earning,p_sale,cat_name,p_image) 
            VALUES (NULL,'$p_name','$p_desc','$p_price','$p_discount','$p_quantity',0,0,'$p_category','$image')")) 
            {
                echo "<p class=\"failed\">Problem Uploading !</p>". mysql_error();
            } else {
                echo "<p class=\"success\">New Product Added !</p>";
                header("Location:admin-all-products.php");
                exit;
            }

        } else {
            
            echo "<p class=\"failed\">Fill All The Information !</p>";
            
        }
    }
?>



<section>
    <div id="main-body">
        <h1 id="allp">Add New Product : </h1>

        <form action="#" method="post" id="pform" name="add-product-form" enctype="multipart/form-data">
            <p id="pname" class="formlabel">Product Name: </p>
            <input type="text" name="name" size="100" placeholder="Enter Product Name">

            <p id="catdesc" class="formlabel">Product Description</p>
            <textarea name="desc" id="pid" cols="76" rows="15" wrap="soft" placeholder="Enter Product Description"></textarea>

            <p id="pprice" class="formlabel">Price: </p>
            <input type="text" name="price" size="50" placeholder="Enter Product Price"><span>  &#2547;</span>

            <p id="pdis" class="formlabel">Discount:  </p>
            <input type="text" name="discount" size="50" placeholder="Discount Rate"><span>  %</span>

            <p id="pqt" class="formlabel">Quantity: </p>
            <input type="text" name="quantity" size="50" placeholder="No of Product"><span> Piece / Kg / Liter</span>
            
            <p id="pcat" class="formlabel">Select Category: </p>
             <select name="category">
                 <?php
                    $query = "SELECT * FROM category";
                    $result = mysql_query($query);
                    if($result) {
                        while($row = mysql_fetch_array($result)) {
                            echo "<option value=\"".$row['c_name']."\">".$row['c_name']."</option>";
                        }
                    } else {
                        echo "Query Faild !".mysql_error();
                    }
                 ?>
            </select>

            <p id="ppic" class="formlabel">Product Picture: </p>
            <input type="file" name="image" placeholder="Select An Image" accept="image/*" onchange="loadFile(event)">
            <img id="output"/>
            <script>
              var loadFile = function(event) {
                var reader = new FileReader();
                reader.onload = function(){
                  var output = document.getElementById('output');
                  output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
              };
            </script>

            <input type="submit" name="submit" value="Add New Product" id="psubmit">
        </form>

    </div> <!-- /#main-body -->
</section>

<?php require_once("admin-footer.php")?>