<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['email'])) {
        exit('Не заполнено поле email');
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            exit('Не правильный формат поля email');
        }
    }
} else {
    exit('no post');
}
require_once("connect.php");

try {
    $query = "SELECT * FROM clients
              WHERE email = :email";
    $result = $pdo->prepare($query);
    $result->execute(['email' => $_POST['email']]);
    $data = $result->fetch();
//    if ($data['email'] != $_POST['email']) {
    if (!$data) {
        $query = "INSERT INTO clients
                  VALUES (NULL, :name, :email, :phone)";
        $result = $pdo->prepare($query);
        $result->execute(['name' => $_POST['name'],
                        'email' => $_POST['email'],
                        'phone' => $_POST['phone']
        ]);

        $client_id = $pdo->lastInsertId();
        $query = "INSERT INTO orders
                  VALUES (NULL, NOW(), :comment, :payment, :callback, :street, :home, :block,
                          :apart, :floor, :client_id)";
        $result = $pdo->prepare($query);
        $result->execute(['comment' => $_POST['comment'], 'payment' => $_POST['payment'],
                                'callback' => $_POST['callback'], 'street' => $_POST['street'],
                                'home' => $_POST['home'], 'block' => $_POST['block'],
                                'apart' => $_POST['apart'], 'floor' => $_POST['floor'],
                                'client_id' => $client_id
        ]);
    } else {
        $query = "INSERT INTO orders
                  VALUES (NULL, NOW(), :comment, :payment, :callback, :street, :home, :block,
                          :apart, :floor, :client_id)";
        $result = $pdo->prepare($query);
        $result->execute(['comment' => $_POST['comment'], 'payment' => $_POST['payment'],
            'callback' => $_POST['callback'], 'street' => $_POST['street'],
            'home' => $_POST['home'], 'block' => $_POST['block'],
            'apart' => $_POST['apart'], 'floor' => $_POST['floor'],
            'client_id' => $data['client_id']
        ]);
    }
    $query = "SELECT count(order_id) as numOfOders
              FROM orders INNER JOIN clients
              ON orders.client_id = clients.client_id
              WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':email' => $_POST['email']]);
    $data2 = $stmt->fetch();
    $numOfOrders = htmlspecialchars($data2['numOfOders']);

    $query = "SELECT *
              FROM orders INNER JOIN clients
              ON orders.client_id = clients.client_id
              WHERE email = :email
              ORDER BY order_id DESC
              LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':email' => $_POST['email']]);
    $data3 = $stmt->fetch();

    $order_id = htmlspecialchars($data3['order_id']);
    $street = htmlspecialchars($data3['street']);
    $home = htmlspecialchars($data3['home']);
    $block = htmlspecialchars($data3['block']);
    $apart = htmlspecialchars($data3['apart']);
    $floor = htmlspecialchars($data3['floor']);

    if ($numOfOrders == 1) {
        $thanks = "Спасибо! Это ваш первый заказ.";
    } else {
        $thanks = "Спасибо! Это ваш {$numOfOrders}-й заказ.";
    }

    $subject = "Burgers Ltd. Заказ номер N$order_id";
    $message = "Ваш заказ 'DarkBeefBurger' будет доставлен по адресу:\n<br /> 
    улица $street, дом $home, корпус $block, 
    квартира $apart, этаж $floor.\n<hr />
    $thanks";

    mail($_POST['email'], $subject, $message);
    echo "$subject\n<hr />", "$message";
    
} catch (PDOException $e) {
    echo "Ошибка выполнения запроса: " . $e->getMessage();
}
