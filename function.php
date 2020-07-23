<?php
function connect() {
    $connection = new PDO('mysql:host=localhost; dbname=test__db; charset=utf8', 'mysql', 'mysql');
    if (!$connection) {
        die("Connection failed");
    }
    return $connection;
}

function articles($connection) {
    $offset = 0;
    if (isset($_GET['page']) && trim($_GET['page']) != '') {
        $offset = trim($_GET['page']);
    }
    $sql = $connection->query("SELECT id, date, title, preview FROM articles  ORDER BY date DESC LIMIT 5 OFFSET ".$offset*5);
    return $sql;
}

function allArticles($connection) {
    $sql = $connection->query("SELECT * FROM articles");
    $sql = $sql->fetchAll();
    return $sql;
}


function authorization($connection) {
    $sql = $connection->query("SELECT * FROM admin");
    if ($_POST['login']) {
        foreach ($sql as $log) {
            if ($_POST['login'] == $log['login'] && $_POST['password'] == $log['password']) {
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['password'] = $_POST['password'];
                header('Location: admin.php');
            }
        }

        echo "Неверный логин и пароль";
    }
    return $sql;
}

function paginationCount($connection) {
    $sql = $connection->query("SELECT * FROM articles");
    $count = $sql->rowCount();
    return $count/5;
}

function selectArticle($connection) {
    $sql = $connection->prepare('SELECT * FROM articles  WHERE id=:id');
    $sql->execute([':id' => $_GET['id']]);

    if ($sql->rowCount() > 0) {
        $sql = $sql->fetch();
        return $sql;
    }

    return false;
}


function deleteArticle($connection, $id)
{
    $id = $_GET['id'];
    $sql = $connection->prepare('DELETE FROM articles WHERE id=:id');
    $arr = ['id' => $id];
    $sql->execute($arr);
    if ($sql) {
        return true;
    } else {
        return 'Error deleting record: '. $sql->errorInfo();
    }
}

function close($connection) {
    $connection = null;
}