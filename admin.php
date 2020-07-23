<?php
session_start();
if (!$_SESSION['login'] || !$_SESSION['password']) {
    header('Location: index.php');
    die();
}

if ($_POST['unlogin']) {
    session_destroy();
    header('Location: index.php');
}

if (isset($_COOKIE['bd_create_success']) && $_COOKIE['bd_create_success']!='') {
        if ($_COOKIE['bd_create_success'] == 1) {
            echo "Новая статья успешна созданна";
        }
    }
require_once 'function.php';
$connection = connect();

$data = allArticles($connection);
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
        <h2>Админка</h2>
        <?php echo "С возввращением " . $_SESSION['login'] . "!" . "<br>"?>


        <div><a href="admin_create.php"><button class="btn btn-outline-primary mb-2">Добавить статью</button></a></div>

        <h2>Редактирование статей</h2>
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Дата</th>
                <th>Анонс</th>
                <th>Полный текст</th>
                <th>Изображение</th>
                <th>Обновить статью</th>
                <th>Удалить</th>
            </tr>


            <?php foreach($data as $value) { ?>
            <tr>
                <td><?php echo $value['id'];?></td>
                <td><?php echo $value['title'];?></td>
                <td><?php echo $value['date'];?></td>
                <td><?php echo $value['preview'];?></td>
                <td><?php echo mb_substr($value['text'], 0, 180, 'utf8');?></td>
                <td><img src="img/<?php echo $value['image'];?>" width="100"></td>
                <td><a href="admin_update.php?id=<?php echo $value['id']?>">update</a></td>
                <td><p class='check-delete' data="<?php echo $value['id']?>">del</p></td>
            </tr>
            <?php  } ?>
        </table>


        <form method="post">
            <input class="btn btn-outline-dark mt-2" type="submit" name="unlogin" value="Выйти из админки">
        </form>


        <script>
            window.onload= function(){
                let checkDelete = document.querySelectorAll('.check-delete');
                checkDelete.forEach(function(element){
                    element.onclick = checkDeleteFunction;
                })
                function checkDeleteFunction(event){
                    event.preventDefault();
                    let a = confirm('Вы уверенны?');
                    if (a == true) {
                        location.href = "admin_delete.php?id="+this.getAttribute('data');
                    }
                    return false;
                }
            }
        </script>

    </div>
</body>
</html>