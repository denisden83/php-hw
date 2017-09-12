<style>
    table {
        border-collapse: collapse;
    }
    td, th {
        border: 1px solid lime;
        padding: 4px;
        text-align: center;
    }
</style>
<p><a href="/">На главную</a></p>
<table>
    <tr>
        <th>ид</th>
        <th>логин</th>
        <th>имя</th>
        <th>возраст</th>
        <th>описание</th>
        <th>фото</th>
        <th>совершеннолетие</th>
    </tr>
    <?php foreach ($data as $user) { ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['login'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['age'] ?></td>
            <td><?= $user['description'] ?></td>
            <td>
                <a href="/file/change/<?= $user['id'] ?>/">
                    <img src="/photos/<?= $user['photo'] ?>" height="100" alt="photo">
                </a>
            </td>
            <td><?= $user['maturity'] ?></td>
        </tr>
    <?php } ?>
</table>