<?php session_start();?>
<?php include("./common/header.php")?>
<?php include("./common/Functions.php")?>
<?php 
$myPdo = new PDO("mysql:host=localhost;dbname=cst8257;port=3306;charset=utf8","PHPSCRIPT","1234");

?>

<div class="container text-left">

        <h2>Welcome to Algonquin College Online Course Registration</h2>
        <span class="mt-3">If you have never used this before, you have to <a href="newUser.php">sign up</a> first.<br><br>
        If you have already signed up, you can <a href="login.php">log in</a> now.</span>
        

</div>


<?php include("./common/footer.php")?>