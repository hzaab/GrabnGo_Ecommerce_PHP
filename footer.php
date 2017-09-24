
    <!-- ------------------- Footer --------------------- -->
    <footer>
        <div class="main-footer clearfix">
            <div class="footer1">
                <h1>Useful Links</h1>
                <ul class="footer-links">
                    <li><a href="browse-categories.php">Browse All Categories</a></li>
                    <li><a href="new-products.php">New Products</a></li>
                    <li><a href="top-selling-products.php">Top Selling Products</a></li>
                    <li><a href="about-us.php">About Us</a></li>
                    <li><a href="help-center.php">Help Center</a></li>
                    <li><a href="admin-login.php">Admin Login</a></li>
                </ul>
            </div>
            <div class="footer2">
                <h1>Our Address</h1>
                <p id="email">Email:<a href="#">  admin@grabngo.com</a></p>
                <p>Phone: +55465132</p>
                <p id="location">
                    Basundhora Shopping Complex <br>
                    9th floor, Shop: 77, Block: B <br>
                    Dhaka, Bangladesh.
                </p>
            </div>
            <div class="footer3">
                <img id="footer-logo" src="images/grabngo_logo.png" alt="footer-logo">
                <img id="cash-on-delivery" src="images/cash_on_delivery.png" alt="cash-on-delivary">
            </div>
        </div>
        
        
         <div id="fixed-cart">
             <a href="shopping-cart.php"><img src="images/cart_icon.png" alt="cart"> <span><?php if(isset($_SESSION['count'])) 
{
    echo $_SESSION['count'];
}
                 
if(empty($_SESSION['count']))
    {
        $_SESSION['count'] = 0;
        echo $_SESSION['count'];
    }

                 
?></span> </a>
 </div>
    </footer>
    
</body> 

</html>