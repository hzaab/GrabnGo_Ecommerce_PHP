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
        edit_category();
    }

    function edit_category() {
        
        if(!empty($_POST['name']) && !empty($_POST['desc'] ))
        {
            $c_name = $_POST['name'];
            $c_desc = $_POST['desc'];
            
            if(!empty($_FILES['image']['tmp_name']))
            {
                global $id;

                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                $image_name = $_FILES['image']['name'];
                $image_size = getimagesize($_FILES['image']['tmp_name']);


                if(!$insert = mysqli_query($con, "UPDATE category SET c_name ='$c_name', c_desc ='$c_desc', c_image ='$image' WHERE c_id =$id" )) 
                {
                    echo "<p class=\"failed\">Problem Uploading !</p>";
                } else {
                    echo "<p class=\"success\">Category Updated !</p>";
                }
            } else {
                global $id;
                
                if(!$insert = mysqli_query($con, "UPDATE category SET c_name ='$c_name', c_desc ='$c_desc' WHERE c_id =$id" )) 
                {
                    echo "<p class=\"failed\">Problem Uploading !</p>";
                } else {
                    echo "<p class=\"success\">Category Updated !</p>";
                }
            }

        } else {

            echo "<p class=\"failed\">Fill All The Information !</p>";

        }
    }

?>



<section>
    <div id="main-body">
        <h1 id="allp">Add New Category : </h1>
        
        <?php
            $query = "SELECT * FROM category WHERE c_id = $id";
            $result = mysqli_query($con, $query);
            if(!$result) {
                echo "Query Failed !";
            }
            while($row = mysqli_fetch_array($result)) {
        ?>

        <form action="#" method="post" id="catform" name="catform" enctype="multipart/form-data">
           
            <p id="catname" class="formlabel">Category Name: </p>
            <input type="text" name="name" size="100" placeholder="Enter Category Name" value="<?php echo $row['c_name']; ?>">
            
            <p id="catdesc" class="formlabel">Category Description</p>
            <input type="text" name="desc" size="100" placeholder="Enter Short Description" value="<?php echo $row['c_desc']; ?>">
            
            <p id="catpic" class="formlabel">Current Category Picture: </p>
            <?php echo "<img src=get-category-image.php?id=".$row['c_id'].">"; ?>
            
            <p id="catpic" class="formlabel">New Category Picture: </p>
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
            
            <input type="submit" name="submit" value="Update Category" id="catsubmit">
        </form>
        
         <?php 
            }
         ?>


    </div> <!-- /#main-body -->
</section>

<?php require_once("admin-footer.php")?>