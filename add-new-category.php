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
        add_new_category();
    }

    function add_new_category() {
        
        if(!empty($_POST['name']) && !empty($_POST['desc']) && !empty($_FILES['image']['tmp_name']) )
        {
            $c_name = $_POST['name'];
            $c_desc = $_POST['desc'];

            $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            $image_name = $_FILES['image']['name'];
            $image_size = getimagesize($_FILES['image']['tmp_name']);


            if(!$insert = mysqli_query($con, "INSERT INTO category  
            (c_id,c_name,c_desc,c_image) 
            VALUES (NULL,'$c_name','$c_desc','$image')" )) 
            {
                echo "<p class=\"failed\">Problem Uploading !</p>". mysql_error();
            } else {
                echo "<p class=\"success\">New Category Added !</p>";
                header("Location:admin-all-categories.php");
                exit;
            }

        } else {

            echo "<p class=\"failed\">Fill All The Information !</p>";

        }
    }

?>



<section>
    <div id="main-body">
        <h1 id="allp">Add New Category : </h1>

        <form action="#" method="post" id="catform" name="catform" enctype="multipart/form-data">
           
            <p id="catname" class="formlabel">Category Name: </p>
            <input type="text" name="name" size="100" placeholder="Enter Category Name">
            
            <p id="catdesc" class="formlabel">Category Description</p>
            <input type="text" name="desc" size="100" placeholder="Enter Short Description">
            
            <p id="catpic" class="formlabel">Category Picture: </p>
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
            
            <input type="submit" name="submit" value="Add New Category" id="catsubmit">
        </form>

    </div> <!-- /#main-body -->
</section>

<?php require_once("admin-footer.php")?>