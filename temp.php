<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $link = mysqli_connect('localhost', 'root', '', 'dulieu') or die ('Couldn\'t connect to the database: '.mysqli_connect_error());
    $link->close();
    ?>
</body>
</html>