<?php
require_once('connect.php');

if (!isset($_SESSION['id'])) {
// НЕ АУТОРИЗОВАННЫЙ ПОЛЬЗОВАТЕЛЬ

    if (isset($_POST['do_login'])) {
        // кнопка нажата проверяем данные

        $loginErr = $passwordErr = "";
        $login = "";
        $errors = [];
        if (empty($_POST['login'])) {
            $loginErr = "login is required";
            $errors[] = $loginErr;
        } else {
            $login = $_POST['login']; // другие проверки
        }

        if (empty($_POST['password'])) {
            $passwordErr = "password is required";
            $errors[] = $passwordErr;
        } else {
            $password = $_POST['password']; // другие проверки
        }

        if (empty($errors)) {
            // проверяем существует ли уже такой login

            try {
                $query = "SELECT * FROM users WHERE login = :login";
                $stmt = $pdo->prepare($query);
                $stmt->execute(['login' => $_POST['login']]);
                $data = $stmt->fetch();

                if ($data > 0) {
                    // login существует
                    // проверяем пароль

                    if (!password_verify($_POST['password'], $data['password'])) {
                        // пароль не верный

                        $passwordErr = "password doesn't match";
                    } else {
                        // пароль верный ауторизуем, перезагр страничку

                        $_SESSION['id'] = $data['id'];
                        $_SESSION['login'] = $data['login'];
                        $rnd = time();
                        header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}?$rnd");
                        exit();
                    }
                } else {
                    // login не существует

                    $loginErr = "login doesn't exist";
                }
            } catch (PDOException $e) {
                echo "Ошибка выполнения запроса: " . $e->getMessage();
            }
        }
    }
} else {
    //АУТОРИЗОВАННЫЙ ПОЛЬЗОВАТЕЛЬ

    $passwordErr = "Вы авторизованы";
}
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
                <li class="active"><a href="index.php">Авторизация</a></li>
                <li><a href="reg.php">Регистрация</a></li>
                <li><a href="list.php">Список пользователей</a></li>
                <li><a href="filelist.php">Список файлов</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <div class="form-container">
        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']); ?>" method="post">
            <div class="form-group">
                <label for="login" class="col-sm-2 control-label">Логин</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="login" placeholder="Логин"
                           value="<?php echo $login . $_SESSION['login']; ?>" name="login">
                    <span style="color: red;"><?php echo $loginErr; ?></span>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" placeholder="Пароль"
                           name="password">
                    <span style="color: red;"><?php echo $passwordErr; ?></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="do_login">Войти</button>
                    <button class="btn btn-default"><a href="logout.php">Logout</a></button>
                    <br><br>
                    Нет аккаунта? <a href="reg.php">Зарегистрируйтесь</a>
                </div>
            </div>
        </form>
    </div>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
