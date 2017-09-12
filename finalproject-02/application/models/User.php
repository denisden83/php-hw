<?php

namespace FP2\Models;

use PDO;

class User extends Model
{
    public $message;
    public $success;
    public $table;
    public $photos;

    public function registerNewUser(
        string $login,
        string $password1,
        string $password2,
        string $name,
        string $age,
        string $description,
        array $avatarFile
    ) {
        $query = 'SELECT COUNT(*) FROM users WHERE login = ?';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$login]);
        $count = $stmt->fetch(PDO::FETCH_NUM)[0];
        if ($count[0] !== '0') {
            $this->success = false;
            $this->message = 'Имя пользователя уже существует';
            return;
        }
        if ($password1 !== $password2) {
            $this->success = false;
            $this->message = 'Пароль не совпадает';
            return;
        }

        $extension = '';
        $imageSent = $this->checkImage($avatarFile, $extension);

        $query = 'INSERT INTO users (login, password, name, age, description)' .
            'VALUES(?, ?, ?, ?, ?)';
        $values = [
            strip_tags($login),
            $this->hash($password1),
            strip_tags($name),
            filter_var($age, FILTER_VALIDATE_INT),
            htmlspecialchars($description)
        ];
        $this->pdo->prepare($query)->execute($values);

        if ($imageSent) {
            $lastId = $this->pdo->lastInsertId();
            $filename = "$lastId.$extension";
            $destination = __DIR__ . '/../../photos/' . $filename;
            $tmp_name = $avatarFile['tmp_name'];
            $query = "UPDATE users SET photo='$filename?v=0' WHERE id=$lastId";
            $this->pdo->query($query);
            move_uploaded_file($tmp_name, $destination);
        }
        $this->success = true;
        $this->message = 'Регистрация прошла успешно';
    }

    private function checkImage(array $avatarFile, string &$extension): bool
    {
        if (is_numeric($avatarFile) || $avatarFile['name'] === '') {
            return false;
        }
        $acceptableExtensions = ['bmp', 'gif', 'jpg', 'jpeg', 'svg', 'png'];
        $maxFileSize = 5;
        $tmp_name = $avatarFile['tmp_name'];
        $extension = preg_replace('/.*\./', '', $avatarFile['name']);
        $extension = strtolower($extension);
        if (!in_array($extension, $acceptableExtensions)) {
            $this->success = false;
            $this->message = 'Неверное расширение файла';
            return false;
        }
        $type = mime_content_type($tmp_name);
        if (substr($type, 0, 5) !== 'image') {
            $this->success = false;
            $this->message = 'Это не картинка';
            return false;
        }
        if (filesize($tmp_name) > $maxFileSize * 1024 ** 2) {
            $this->success = false;
            $this->message = 'Размер файла больше ' . $maxFileSize . 'MB';
            return false;
        }
        return true;
    }

    private function hash(string $password): string
    {
        return password_hash(
            $password,
            PASSWORD_DEFAULT
        );
    }

    public function authorizeUser(string $login, string $password)
    {
        $query = "SELECT * FROM users WHERE login = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$login]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($record > 0) {
            if (password_verify($password, $record['password'])) {
                $this->success = true;
                $this->message = "Доступ открыт";
            } else {
                $this->success = false;
                $this->message = 'Пароль не совпадает';
            }
        } else {
            $this->success = false;
            $this->message = 'Логин не существует';
        }

//        $query = "SELECT * FROM users WHERE login = ? AND password = ?";
//        $stmt = $this->pdo->prepare($query);
//        $hash = $this->hash($password);
//        $stmt->execute([$login, $hash]);
//        $record = $stmt->fetch(PDO::FETCH_ASSOC);
//        if ($record === false) {
//            $this->success = false;
//            $this->message = 'Неверные имя пользователя и пароль';
//        } else {
//            $this->success = true;
//            $this->message = 'Доступ открыт';
//        }
    }

    public function loadAllUsers($order = null)
    {
        $query = "SELECT id, login, name, age, description, photo FROM users";
        if ($order) {
            $query .= " ORDER BY age $order";
        }
        $stmt = $this->pdo->query($query);
        $this->table = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($this->table as $key => $user) :
            if ($user['photo'] === null) {
                $this->table[$key]['photo'] = 'default-avatar.png?v=0';
            }
            if ($user['age'] >= 18) {
                $this->table[$key]['maturity'] = 'Совершеннолетний';
            } else {
                $this->table[$key]['maturity'] = 'Несовершеннолетний';
            }
            $this->table[$key]['description'] =
                nl2br($this->table[$key]['description']);
        endforeach;
    }

    public function loadAllPhotos()
    {
        $query = 'SELECT id, name, photo FROM users WHERE photo IS NOT NULL';
        $stmt = $this->pdo->query($query);
        $this->photos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNameAndPhoto(int $userId)
    {
        $query = "SELECT id, name, photo FROM users WHERE id='$userId'";
        $stmt = $this->pdo->query($query)->fetch(PDO::FETCH_ASSOC);
        return $stmt;
    }

    public function changePhoto(int $userId, array $avatarFile)
    {
        $extension = '';
        $this->checkImage($avatarFile, $extension);
        $filename = "$userId.$extension";
        $destination = __DIR__ . '/../../photos/' . $filename;
        $tmp_name = $avatarFile['tmp_name'];
        move_uploaded_file($tmp_name, $destination);

        $query = "SELECT photo FROM users WHERE id = $userId";
        $stmt = $this->pdo->query($query)->fetch(PDO::FETCH_ASSOC);
        $photo = $stmt['photo'];
        if ($photo === null) {
            $newPhoto = "$filename?v=0";
            $query = "UPDATE users SET photo='$newPhoto' WHERE id='$userId'";
            $this->pdo->query($query);
        } else {
            preg_match('/(.*)(\d+$)/', $photo, $matches);
//            $name = $matches[1];
            $version = $matches[2];
            $version++;
//            $newPhoto = $name . $version;
            $newPhoto = "$filename?v=" . $version;
            $query = "UPDATE users SET photo='$newPhoto' WHERE id='$userId'";
            $this->pdo->query($query);
        }
    }
}
