<?php session_start(); ?>
<?php require_once("admin-header.php")?>
<?php require_once("admin-sidebar.php")?>
<?php require_once("database.php")?>

<?php
    if(!$_SESSION['user'])
    {
        header('Location: admin-login.php');
    }
    
    global $id;

    $id = $_REQUEST['id'];

    if(isset($_POST['submit'])) 
    {
        update_product();
    }

    function update_product() {
        
        if(!empty($_POST['name']) && !empty($_POST['desc']) && !empty($_POST['price']) &&  !empty($_POST['quantity']) && !empty($_POST['category']))
        {
            $p_name = $_POST['name'];
            $p_desc = $_POST['desc'];
            $p_price = $_POST['price'];
            $p_discount = $_POST['discount'];
            $p_quantity = $_POST['quantity'];
            $p_category = $_POST['category'];
            
            if(!empty($_FILES['image']['tmp_name']))
            {
                global $id;
                
                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                $image_name = $_FILES['image']['name'];
                $image_size = getimagesize($_FILES['image']['tmp_name']);
                
                if(!$insert = mysqli_query($con, "UPDATE product SET p_name ='$p_name', p_desc ='$p_desc', p_price ='$p_price', p_discount ='$p_discount', p_quantity ='$p_quantity',cat_name ='$p_category', p_image ='$image' WHERE id = $id ")) 
                    {
                        echo "<p class=\"failed\">Problem Uploading !</p>";
                    } else {
                        echo "<p class=\"success\">Product Updated!</p>";
                    }
            }else {
                global $id;
                if(!$insert = mysqli_query($con, "UPDATE product SET p_name ='$p_name', p_desc ='$p_desc', p_price ='$p_price', p_discount ='$p_discount', p_quantity ='$p_quantity', cat_name ='$p_category' WHERE id = $id")) 
                    {
                        echo "<p class=\"failed\">Problem Uploading !</p>";
                    } else {
                        echo "<p class=\"success\">Product Updated!</p>";
                    }
            }  

            

        } else {
            
            echo "<p class=\"failed\">Fill All The Information !</p>";
            
        }
    }
?>

<section>
    <div id="main-body">
        <h1 id="allp">Edit Product : </h1>
    
       <?php
            $query = "SELECT * FROM product WHERE id = $id";
            $result = mysqli_query($con, $query);
            if(!$result) {
                echo "Query Failed !";
            }
            while($row = mysqli_fetch_array($result)) {
        ?>
        
        <form action="#" method="post" id="pform" name="add-product-form" enctype="multipart/form-data">
            <p id="pname" class="formlabel">Product Name: </p>
            <input type="text" name="name" size="100" placeholder="Enter Product Name" value="<?php echo $row['p_name']; ?>">

            <p id="catdesc" class="formlabel">Product Description</p>
            <textarea name="desc" id="pid" cols="76" rows="15" wrap="soft" placeholder="Enter Product Description"><?php echo $row['p_desc']; ?></textarea>

            <p id="pprice" class="formlabel">Price: </p>
            <input type="text" name="price" size="50" placeholder="Enter Product Price" value="<?php echo $row['p_price']; ?>"><span>  &#2547;</span>

            <p id="pdis" class="formlabel">Discount:  </p>
            <input type="text" name="discount" size="50" placeholder="Discount Rate" value="<?php echo $row['p_discount']; ?>"><span>  %</span>

            <p id="pqt" class="formlabel">Quantity: </p>
            <input type="text" name="quantity" size="50" placeholder="No of Product" value="<?php echo $row['p_quantity']; ?>">
            
            <p id="pcat" class="formlabel">Select Category: </p>
             <select name="category">
                 <?php
                    $cquery = "SELECT * FROM category";
                    $cresult = mysqli_query($con, $cquery);
                    if($cresult) {
                        while($crow = mysqli_fetch_array($cresult)) {
                            if($row['cat_name'] == $crow['c_name'])
                            {
                                echo "<option selected='selected' value=\"".$crow['c_name']."\">".$crow['c_name']."</option>";
                            }
                            else {
                                echo "<option value=\"".$crow['c_name']."\">".$crow['c_name']."</option>";
                            }
                        }
                    } else {
                        echo "Query Faild !";
                    }
                 ?>
            </select>
            
            <p id="ppic" class="formlabel">Current Product Picture: </p>
            <?php echo "<img src=get-product-image.php?id=".$row['id'].">"; ?>

            <p id="ppic" class="formlabel">New Product Picture: </p>
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

            <input type="submit" name="submit" value="Update Product" id="psubmit">
        </form>
        
        <?php 
            }
        ?>

    </div> <!-- /#main-body -->
</section>

<?php require_once("admin-footer.php")?>