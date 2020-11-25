<?php include("./common/header.php")?>

<?php session_start();?>

<?php session_destroy();
header("Location:index.php");
?>
<?php include("./common/footer.php")?>