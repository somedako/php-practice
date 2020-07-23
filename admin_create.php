<?php
require_once "function.php";
if (isset($_POST['title']) && $_POST['title'] != '') {

    $title = $_POST['title'];
    $date = $_POST['date'];
    $preview = $_POST['preview'];
    $text = $_POST['text'];
    $connection = connect();

    move_uploaded_file($_FILES['image']['tmp_name'], 'img/' . $_FILES['image']['name']);
    $sql = $connection->query("INSERT INTO articles (title, date, preview, text, image) VALUES ('" . $title . "', '" . $date . "', '" . $preview . "', '" . $text . "', '" . $_FILES['image']['name'] . "')");
    if ($sql) {
        setcookie('bd_create_success', 1, time()+10);
        header('Location: admin.php');
    } else {
        echo "Ошибка";
    }
    close($connection);
}
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
        <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Заголовок:</label>
            <input class="form-control" type="text" name="title" id="title">
        </div>

        <div class="form-group">
            <label for="date">Дата</label>
            <input class="form-control" type="datetime-local" name="date" id="date">
        </div>

        <div class="form-group">
            <label for="preview">Анонс:</label>
            <input class="form-control" name="preview" type="text" id="preview">
        </div>

        <div class="form-group">
            <label for="text">Текст:</label>
            <textarea class="form-control" name="text" id="text"></textarea>
        </div>

        <div class="form-group">
            <input class="form-control-file" type="file" name="image">
        </div>

        <div>
            <input class="btn btn-success" type="submit" value="Создать новость">
        </div>

        </form>
</div>
</body>
</html>