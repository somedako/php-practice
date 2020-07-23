<?php
require_once "function.php";
$connection = connect();
$data = deleteArticle($connection, $_GET['id']);
close($connection);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <?php
            if ($data === true) {
                echo "Статья удаленна";
            } else {
                echo 'Error!'. $data;
            }

        ?>
    </div>

    <div class="col-lg-3" style="margin-top: 150px">
        <div class="list-group">
            <a class="list-group-item list-group-item-action" href="admin.php" style="margin-left: 65px">Назад</a>
        </div>
    </div>
</body>
</html>
