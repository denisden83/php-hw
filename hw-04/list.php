<?php
require_once('connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Авторизация</a></li>
                <li><a href="reg.php">Регистрация</a></li>
                <li class="active"><a href="list.php">Список пользователей</a></li>
                <li><a href="filelist.php">Список файлов</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<?php
if (isset($_SESSION['id'])) {
    //АУТОРИЗОВАННЫЙ ПОЛЬЗОВАТЕЛЬ

    if (isset($_GET['id'])) {
        // удаляем user

        try {
            $query = "DELETE FROM users WHERE id = :id";
            $delete = $pdo->prepare($query);
            $delete->execute(['id' => $_GET['id']]);
            if (file_exists('photos/' . $_GET['photo'])) {
                unlink('photos/' . $_GET['photo']);
            }
        } catch (PDOException $e) {
            echo "Ошибка выполнения запроса: " . $e->getMessage();
        }
        if ($_SESSION['id'] == $_GET['id']) {
            echo '<meta http-equiv="Refresh" content="0; URL=logout.php"';
        }
    }
    // выводим данные
    try {
        $query = "SELECT * FROM users";
        $usr = $pdo->query($query);
        $users = $usr->fetchAll();
    } catch (PDOException $e) {
        echo "Ошибка выполнения запроса: " . $e->getMessage();
    }
    ?>
    <div class="container">
        <h2>Информация выводится из базы данных</h2>
        <button class="btn btn-default"><a href="logout.php">Logout</a></button>
        <table class="table table-bordered">
            <tr>
                <th>Пользователь(логин)</th>
                <th>Имя</th>
                <th>возраст</th>
                <th>описание</th>
                <th>Фотография</th>
                <th>Действия</th>
            </tr>
            <tr>
                <td>vasya99</td>
                <td>Вася</td>
                <td>14</td>
                <td>Эксперт в спорах в интернете</td>
                <td><img src="http://lorempixel.com/people/200/200/" alt=""></td>
                <td>
                    <a href="">Удалить пользователя</a>
                </td>
            </tr>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user['login'] ?></td>
                    <td><?php echo $user['name'] ?></td>
                    <td><?php echo $user['age'] ?></td>
                    <td><?php echo $user['description'] ?></td>
                    <td><img class="photo" src="<?php echo "photos/" . $user['photo'] ?>" alt=""></td>
                    <td>
                        <a href="<?php echo "?id=" . urlencode($user['id']) .
                            "&photo=" . urlencode($user['photo']) ?>">Удалить пользователя</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

    </div><!-- /.container -->
    <?php
} else {
    // НЕ АУТОРИЗОВАННЫЙ ПОЛЬЗОВАТЕЛЬ

    ?>
    <div class="container">
        <h1>Запретная зона, доступ только авторизированному пользователю</h1>
    </div><!-- /.container -->
    <?php
}
?>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
