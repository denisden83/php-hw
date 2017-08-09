<?php
require_once("connect.php");

try {
    if (empty($_GET)) {
        $query = "SELECT clients.client_id, name as client,
              count(order_id) as numberOfOrders, email, phone
              FROM clients INNER JOIN orders
              ON clients.client_id = orders.client_id
              GROUP BY clients.client_id, name, email, phone ORDER BY name";

        $result = $pdo->query($query);
        echo "<table border='1px solid black'>\n
              <tr><th>client id</th><th>client name</th><th>number of oders</th>
              <th>email</th><th>phone</th></tr>\n";
        while ($data = $result->fetch()) {
            $data['client_id'] = htmlspecialchars($data['client_id']);
            $data['client'] = htmlspecialchars($data['client']);
            $data['numberOfOrders'] = htmlspecialchars($data['numberOfOrders']);
            $data['email'] = htmlspecialchars($data['email']);
            $data['phone'] = htmlspecialchars($data['phone']);
            echo "<tr>";
            echo "<td>{$data['client_id']}</td>";
            echo "<th><a href='?client_id=" . urlencode($data['client_id']) .
                "&client_name=" . $data['client'] . "'>{$data['client']}</a></th>";
            echo "<td>{$data['numberOfOrders']}</td>";
            echo "<td>{$data['email']}</td>";
            echo "<td>{$data['phone']}</td>";
            echo "</tr>\n";
        }
        echo "</table>\n";
    } else {
        $query = "SELECT * FROM orders
                  WHERE client_id = :client_id
                  ORDER BY order_id DESC";
        $result = $pdo->prepare($query);
        $result -> execute(['client_id' => $_GET['client_id']]);

        echo "<button><a href='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>back</a></button>";

        echo "<table border='1px solid black'>\n";
        echo "<tr><th>client</th></th><th>order id</th><th>order time</th><th>comment</th>
              <th>payment</th><th>callback</th><th>street</th><th>home</th><th>block</th><th>apartment</th>
              <th>floor</th><th>client_id</th></tr>\n";
        while ($data = $result->fetch()) {
            $data['order_id'] = htmlspecialchars($data['order_id']);
            $data['ordertime'] = htmlspecialchars($data['ordertime']);
            $data['comment'] = htmlspecialchars($data['comment']);
            $data['payment'] = htmlspecialchars($data['payment']);
            $data['callback'] = htmlspecialchars($data['callback']);
            $data['street'] = htmlspecialchars($data['street']);
            $data['home'] = htmlspecialchars($data['home']);
            $data['block'] = htmlspecialchars($data['block']);
            $data['apart'] = htmlspecialchars($data['apart']);
            $data['floor'] = htmlspecialchars($data['floor']);

            echo "<tr>";
            echo "<td>{$_GET['client_name']}</td>";
            echo "<td>{$data['order_id']}</td>";
            echo "<td>{$data['ordertime']}</td>";
            echo "<td>{$data['comment']}</td>";
            echo "<td>{$data['payment']}</td>";
            echo "<td>{$data['callback']}</td>";
            echo "<td>{$data['street']}</td>";
            echo "<td>{$data['home']}</td>";
            echo "<td>{$data['block']}</td>";
            echo "<td>{$data['apart']}</td>";
            echo "<td>{$data['floor']}</td>";
            echo "<td>{$_GET['client_id']}</td>";
            echo "</tr>\n";
        }
        echo "</table>\n";
    }
} catch (PDOException $e) {
    echo "Ошибка выполнения запроса: " . $e->getMessage();
}
