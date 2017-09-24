<?php session_start(); ?>
<?php require_once("header.php")?>
<?php require_once("database.php")?>
    
<?php

if(isset($_POST['submit']) && !empty($_POST['submit']))
{
	SignIn($con);
}

function SignIn($con)
{
    
    if(!empty($_POST['user']) && !empty($_POST['pass'])) 
    {
        $username = $_POST['user'];
        $password = $_POST['pass'];

        $query = "SELECT * FROM user WHERE u_name='$username' AND u_pass='$password'";

        $result = mysqli_query($con, $query);

        if(!$result) {
            echo "database Query failed! ";
        }

        $row = mysqli_fetch_array($result);

        $db_user = $row['u_name'];
        $db_pass = $row['u_pass'];

        if(($username == $db_user) && ($password == $db_pass)) {
            echo "login Sucess !";
            $_SESSION['user'] = $username;
            header("Location:admin.php");
            exit;
        } else {
            echo "<p id=\"vallogin\">Login Failed !!!</p>";
        }

    } else {
            echo "<p id=\"vallogin\">fill all the information !</p>";
        }
}

?>
    

    <!-- ------------------ Login Section ---------------- -->
    <div class="login-card">
        <h1>Admin Log-in</h1><br>
        
      <form  method="post" action="admin-login.php">
        <input type="text" name="user" placeholder="Username">
        <input type="password" name="pass" placeholder="Password">
        <input type="submit" name="submit" class="login login-submit" value="login">
      </form>
    
 </div>
   
   
   
<?php require_once("footer.php")?>