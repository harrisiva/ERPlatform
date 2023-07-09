<?php 
    require 'templates/header.php';
    // import the required packages for this file (with require)
?>

<body>
    <div class="container">
        <form action="/webapp/public/" method=post>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password">
            </div>

            <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
            </div>

            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

</body>


<?php require 'templates/footer.php';?>