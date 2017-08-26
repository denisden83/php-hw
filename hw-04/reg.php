<?php
require_once('connect.php');


if (!isset($_SESSION['id'])) {
// НЕ АУТОРИЗОВАННЫЙ ПОЛЬЗОВАТЕЛЬ

    if (isset($_POST['do_signup'])) {
        // нажата кнопка проверяем данные
        $loginErr = $passwordErr = $password2Err = "";
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

        if (empty($_POST['password2'])) {
            $password2Err = "password is required";
            if (empty($passwordErr)) {
                $passwordErr = "repeat again";
            }
            $errors[] = $password2Err;
        } elseif ($_POST['password2'] !== $_POST['password']) {
            $password2Err = "password doesn't match";
            $passwordErr = "repeat again";
            $errors[] = $password2Err;
        } else {
            $password2 = $_POST['password2']; // другие проверки
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
                    $loginErr = "login is already registered";
                } else {
                    // регистрируем
                    $_POST['login'] = htmlspecialchars($_POST['login'], true);
                    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $query = "INSERT INTO users (id, login, password) VALUES (NULL, :login, :password)";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute(['login' => $_POST['login'], 'password' => $_POST['password']]);
                    $id = $pdo->lastInsertId();

                    $_SESSION['id'] = $id;
                    $_SESSION['login'] = $_POST['login'];
                    $rnd = time();
                    header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}?$rnd");
                    exit();
                }
            } catch (PDOException $e) {
                echo "Ошибка выполнения запроса: " . $e->getMessage();
            }
        }
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
                    <li><a href="index.php">Авторизация</a></li>
                    <li class="active"><a href="reg.php">Регистрация</a></li>
                    <li><a href="list.php">Список пользователей</a></li>
                    <li><a href="filelist.php">Список файлов</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">

        <div class="form-container">
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']); ?>"
                  method="post">
                <div class="form-group">
                    <label for="login" class="col-sm-2 control-label">Логин</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="login" placeholder="Логин"
                               value="<?php echo $login; ?>" name="login">
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
                    <label for="password2" class="col-sm-2 control-label">Пароль (Повтор)</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password2" placeholder="Пароль"
                               name="password2">
                        <span style="color: red;"><?php echo $password2Err; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" name="do_signup">Зарегистрироваться</button>
                        <br><br>
                        Зарегистрированы? <a href="index.php">Авторизируйтесь</a>
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

    <?php
} else {
//АУТОРИЗОВАННЫЙ ПОЛЬЗОВАТЕЛЬ
    if (isset($_POST['do_update'])) {
        // кнопка нажата делаем update

        $errors = $ageErr = $uploadErr = "";

        if (!empty($_POST['age'])) {
            if (!is_numeric($_POST['age'])) {
                $ageErr = "is not a number";
                $errors = $ageErr;
            }
        }

        $imgDir = "photos";
        $file = $_FILES['photoUpload'];
        $tmp = $file['tmp_name'];
        $info = @getimagesize($tmp);
        if (!empty($_FILES['photoUpload']['name'])) {
            if (!is_uploaded_file($tmp)) {
                $uploadErr = "Ошибка закачки #{$file['error']}";
                $errors = $uploadErr;
            }
            if (!preg_match('{image/(.*)}is', $info['mime'], $p)) {
                $uploadErr = "Недопустимый формат";
                $errors = $uploadErr;
            }
            if ($p[1] != 'jpg' && $p[1] != 'jpeg' && $p[1] != 'gif' && $p[1] != 'png') {
                $uploadErr = "Только формат jpg, gif, png";
                $errors = $uploadErr;
            }
            if ($file['size'] > 1000000) {
                $uploadErr = "Фаил больше 1Mb";
                $errors = $uploadErr;
            }
        }

        if (($_FILES['photoUpload']['error'] === 0) && empty($errors)) {
            // если отправлено фото то загружаем и его
           //echo "загружаем фото";

            $newFile = $_SESSION['id'] . "." . $p[1];
            $newFilePath = "$imgDir/" . $_SESSION['id'] . "." . $p[1];
            if (move_uploaded_file($tmp, $newFilePath)) {
                $_POST['photo'] = $newFile;
            }
        }
        if (empty($errors)) {
            // обновляем данные

            // обновляем age только если не пустая строка ""
            if (!empty($_POST['age'])) {
                $_POST['age'] = htmlspecialchars($_POST['age'], true);
                $query = "UPDATE users SET age=:age WHERE id=:id";
                $stmt = $pdo->prepare($query);
                $stmt->execute(['age' => $_POST['age'], 'id' => $_SESSION['id']]);
            }

            $_POST['login'] = htmlspecialchars($_POST['login'], true);
            $_POST['name'] = htmlspecialchars($_POST['name'], true);
            $_POST['description'] = htmlspecialchars($_POST['description'], true);
            $_POST['photo'] = htmlspecialchars($_POST['photo'], true);
            $query = "UPDATE users SET login=:login, name=:name, description=:description, photo=:photo
                  WHERE id=:id";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['login' => $_POST['login'], 'name' => $_POST['name'],
                'description' => $_POST['description'], 'photo' => $_POST['photo'],
                'id' => $_SESSION['id']]);
            if ($stmt !== false) {
                $_SESSION['login'] = $_POST['login'];
                $rnd = time();
                header("Location: http://{$_SERVER['SERVER_NAME']}{$_SERVER['SCRIPT_NAME']}?$rnd");
                exit();
            }
        }
    } else {
        // просто зашёл выводим данные


        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $_SESSION['id']]);
        $data = $stmt->fetch();
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
                    <li><a href="index.php">Авторизация</a></li>
                    <li class="active"><a href="reg.php">Регистрация</a></li>
                    <li><a href="list.php">Список пользователей</a></li>
                    <li><a href="filelist.php">Список файлов</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">

        <div class="form-container">
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']); ?>"
                  method="post" enctype="multipart/form-data">
                <h3>Ваш профиль</h3>
                <h4>Дополнить/Изменить данные</h4>
                <div class="form-group">
                    <label for="login" class="col-sm-2 control-label">Логин</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="login" placeholder="Логин"
                               value="<?php echo $data['login'] . $_POST['login']; ?>" name="login">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Имя</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" placeholder="Имя"
                               value="<?php echo $data['name'] . $_POST['name']; ?>" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="age" class="col-sm-2 control-label">Возраст</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="age" placeholder="Возраст"
                               value="<?php echo $data['age'] . $_POST['age']; ?>" name="age">
                        <span style="color: red;"><?php echo $ageErr; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">Описание</label>
                    <div class="col-sm-10">
                        <textarea name="description" id="description" cols="43" rows="4"
                                  class=""><?php echo $data['description'] . $_POST['description']; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="photo" class="col-sm-2 control-label">Фото</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="photo" placeholder="Фото"
                               value="<?php echo $data['photo'] . $_POST['photo']; ?>" name="photo">
                    </div>
                </div>
                <div class="form-group">
                    <label for="photoUpload" class="col-sm-2 control-label">Загрузить (1MB)</label>
                    <div class="col-sm-10">
                        <input type="file" class="" id="photoUpload" name="photoUpload">
                        <span style="color: red;"><?php echo $uploadErr ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" name="do_update">Обновить данные</button>
                        <button class="btn btn-default"><a href="logout.php">Logout</a></button>
                        <br><br>
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
<?php } ?>



