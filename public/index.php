<?php 
    require "../templates/header.php";
    $name = $_POST["name"];
?>

<body>
    <?php echo '<h1> Hi '.$name.'!</h1>' ?>
</body>

<?php require "../templates/footer.php"; ?>