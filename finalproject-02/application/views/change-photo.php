<h1>Изменение аватарки</h1>
<p>
    <a href="/">На главную</a>
</p>
<h2>Имя: <?= $data['name'] ?></h2>
<p>Старый аватар</p>
<img src="/photos/<?= $data['photo'] ?>" alt="аватар">
<form action="/file/change/<?= $data['id'] ?>/" method="post" enctype="multipart/form-data">
    <div class="field">
        <label for="">Новый аватар</label>
        <input name="avatar" type="file">
    </div>
    <div class="field">
        <input type="submit" value="Изменить">
    </div>
</form>