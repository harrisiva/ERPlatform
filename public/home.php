<?php 
    require "../templates/header.php";
?>


<body>
    <?php 
        echo '<h1> Hi! '. $_SESSION["username"] .' </h1>';
    ?>
</body>

<?php require "../templates/footer.php"; ?>