<?php

require_once "function.php";
if (isset($_POST['title']) && $_POST['title'] != '') {

    $title = $_POST['title'];
    $date = $_POST['date'];
    $preview = $_POST['preview'];
    $text = $_POST['text'];
    $connection = connect();
    $arr = ['title' => $title,  'preview' => $preview, 'text' => $text, 'image' => $_FILES['image']['name'], 'id' => $_GET['id']];
    $arr1 = ['title' => $title,  'preview' => $preview, 'text' => $text, 'id' => $_GET['id']];

    if ($_FILES['image']['name']!='') {
        move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $_FILES['image']['name']);
        $sql = $connection->prepare("UPDATE articles set title =:title, date ='$date', preview =:preview, text =:text, image =:image WHERE id=:id");
        $sql->execute($arr);
    } else {
        $sql = $connection->prepare("UPDATE articles set title =:title, date ='$date', preview =:preview, text =:text WHERE id=:id");
        $sql->execute($arr1);
    }

    if ($sql) {
        setcookie('bd_create_success', 1, time() + 10);
        header('Location: /admin.php');
    } else {
        header('Location: /admin.php');
    }
    close($connection);
}

$connection = connect();
$sql = $connection->prepare ('SELECT * FROM articles WHERE id=:id');
$sql->execute([':id' => $_GET['id']]);
$sql = $sql->fetch();
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
    <div class="container"></div>
    <h2>Обновление поста с id<?php echo $_GET['id'] ?></h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Заголовок:</label>
            <input  class="form-control" type="text" name="title" id="title" value="<?php echo $sql['title'];?>">
        </div>

        <div class="form-group"
            <label for="date">Дата:<?php echo $sql['date'];?></label>
            <input  class="form-control" type="datetime-local" name="date" id="date" value="">
        </div>

        <div class="form-group">
            <label for="preview">Анонс:</label>
            <input  class="form-control" name="preview" type="text" id="preview" value="<?php echo $sql['preview'];?>">
        </div>

        <div class="form-group">
            <label for="text">Текст:</label>
            <textarea  class="form-control" name="text" id="text"><?php echo $sql['text'];?></textarea>
        </div>

        <div class="form-group">
            <img src="img/<?php echo $sql['image'];?>" alt="">
            <input class="form-control-file" type="file" name="image">
        </div>

        <div>
            <input type="submit" value="Обновить новость">
        </div>

    </form>
</body>
</html>