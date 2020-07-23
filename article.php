<?php
require_once 'function.php';
$connection = connect();
$article = selectArticle($connection);
close($connection);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<div class="container">
    <div>
        <h2><?php echo $article['date'] . " - " . $article['title'];?></h2>
        <div><img src="/img/<?php echo $article['image'];?>"></div>
        <div><?php echo $article['text'];?></div>
    </div>
</div>


</body>
</html>
