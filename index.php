<?php
session_start();
require_once 'function.php';
$connection = connect();
$admin = authorization($connection);
$articles = articles($connection);
$countPage = paginationCount($connection);
close($connection);
?>
<!doctype html>
<html lang="en">

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">

        <h2>Авторизируйтесь</h2>
        <form action="" method="post">
            <div class="form-group">
                <input class="mb-1" type="text" name="login" placeholder="Логин" required>
                <input class="mb-1" type="password" name="password" placeholder="Пароль" required>
                <button class="btn btn-primary">Отправить</button>
            </div>
        </form>

        <h2 class="mb-2">Все новости</h2>
        <div class="mb-1">
            <?php  foreach ($articles as $value) {?>
            <a href="/article.php?id=<?php echo $value['id']?>"><h1><?php echo $value['date'] . " - " . $value['title'];?></h1></a>
            <div><?php echo $value['preview'];?></div>
            <?php } ?>
        </div>

        <nav>
            <ul class="pagination">
                <?php for ($i=0; $i < $countPage; $i++) {
                    $j = $i+1;
                    echo "<li class='page-item'><a class='page-link' href='/index.php?page={$i}'>{$j}</a></li>";
                }?>
            </ul>
        </nav>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
