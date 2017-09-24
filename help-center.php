<?php session_start(); ?>
<?php require_once("header.php")?>
<?php require_once("slider.php")?>
<?php require_once("database.php")?>


<?php 
    if(isset($_POST['submit'])) 
    {
        call_for_help();
    }

    function call_for_help() {
        
        if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['text']) )
        {
            $h_name = $_POST['name'];
            $h_email = $_POST['email'];
            $h_phone = $_POST['phone'];
            $h_text = $_POST['text'];

            $to = "admin@grabngo.com";
            $email = $h_email;
            $txt = $h_text;
            $phone = $h_phone;
            
            mail($to,$email,$txt,$phone);
            
            echo "<p id=\"msgsent\">Message Sent !</p>";

        } else {

            echo "<p id=\"msgfailed\">Fill All The Information !</p";

        }
    }

?>
    

    <!-- ------------------ Help Section ---------------- -->
    <section>
        <div id="checkout-wrapper">
           <h1>Need Some Help? </h1>
            <div id="checkform">
                <form method="post" action="help-center.php" name="helpform">
                    <p id="cname" class="clabel">Your Name :</p>
                    <input type="text" name="name" size="100" placeholder="Enter Your Name">
                    
                    <p id="cemail" class="clabel">Your Email :</p>
                    <input type="email" name="email" size="100" placeholder="Enter Your Email">
                    
                    <p id="cname" class="clabel">Your Phone :</p>
                    <input type="text" name="phone" size="100" placeholder="Enter Your Phone Number">
                    
                    <p id="cname" class="clabel">Your Message :</p>
                    <textarea name="text" id="tid" cols="76" rows="15" wrap="soft" placeholder="Enter Your Address"></textarea>
                    
                    <input type="submit" name="submit" id="checksubmit" value="     Send Us Email     ">
                </form>
            </div>
        </div>
    </section>
   
   

<?php require_once("footer.php")?>